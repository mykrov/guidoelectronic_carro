<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Log\LogManager;
use App\Ventas;
use App\Compras;
use App\Mail\PedidoRealizado;
use App\Usuario;
use App\PagosKushki;
use Carbon\Carbon;
use Redirect;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

class PagosController extends Controller
{
    // Enpoint donde PlaceToPay(PTP ó PtP de forma resumida) 
    //  enviará la notificación de un proceso
    public function Notificacion(Request $r)
    {
        //obtiene los valores del request
        $statusIn = $r->status;
        $message = $statusIn['message'];
        $reason = $statusIn['reason'];
        $estado = $statusIn['status'];
        $date = $statusIn['date'];

        $requestId = $r->requestId;
        $reference = $r->reference;
        $signature = $r->signature;

        //SecretKey desde Base.
        $dataPTP = \App\DatosPTP::where('ambiente', '=', 1)->first();
        $secretKey = $dataPTP->secretKey;

        $str = $requestId . $estado . $date . $secretKey;

        //Verificar Firma de PTP que viene en el request
        if (sha1($str) === $signature) {
            // si es valida se llama actualizar el estado del pago
            return ($this->ActualizarEstado($requestId, $estado, $date, $message, $signature));
        } else {
            return response()->json(['status' => 'error', 'message' => 'invalid signature']);
        }
    }


    // procedimiento para generar una petición de pago para PtP
    public function GererarRequestPago(Ventas $venta, Usuario $user, Request $req)
    {
        // busca los datos del establecimiento dados por PtP
        $dataPTP = \App\DatosPTP::where('ambiente', '=', env('APP_PAGO_ENV', 1))->first();
        // busca el secredKey y el login
        $secretKey = $dataPTP->secretKey;
        $login = $dataPTP->login;
        // numero de pedido interno como referencia
        $numPedido = $venta->idventas;
        $monto = $venta->total;
        // Dirección del sitio a la que retorna luego del proceso de pago
        $urlRetorno = route('cuenta');
        // comentario adicional del pedido : id del usuario y número de pedido
        $reference = $venta->idusuario . "-" . $numPedido;
        // seed es la fecha actual en formato ISO 8601 de tipo string
        $seed = Carbon::now()->toIso8601String();

        // genera una variable nonce
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        // tipo de identificación
        $idType = "CI";

        if (strlen(trim($user->RUC)) == 13) {
            $idType = 'RUC';
        }

        //crea las variables y objetos necesarios para la solicitud del pago
        //de acuerdo a la documentación propia de PlaceToPay
        $nonceBase64 = base64_encode($nonce);
        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));
        $direccion = ['street' => $user->direccion, 'city' => $user->ciudad, 'country' => 'EC'];
        $buyer = [
            'documentType' => $idType,
            'document' => $user->RUC,
            'name' => $user->nombre,
            'surname' => $user->apellido,
            'email' => $user->correo,
            'address' => $direccion
        ];
        $auth = ['login' => $login, 'tranKey' => $tranKey, 'nonce' => $nonceBase64, 'seed' => $seed];

        $taxes = [['kind' => 'valueAddedTax', 'amount' => $venta->iva, 'base' => $venta->subtotal]];
        $amount = ['currency' => 'USD', 'total' => $monto, 'taxes' => $taxes];

        $payment = ['reference' => $reference, 'description' => 'Pedido Número ' . $numPedido, 'amount' => $amount];
        $expiration = Carbon::now()->addMinutes(40)->toIso8601String();

        // crea una petición con las variables/objetos generados
        $peticion = [
            'auth' => $auth,
            'buyer' => $buyer,
            'payment' => $payment,
            'expiration' => $expiration,
            'returnUrl' => $urlRetorno,
            'ipAddress' => $req->ip(),
            'userAgent' => $req->header('User-Agent')
        ];

        //Cliente para petición a la API PlaceToPay.
        $guzzle = new \GuzzleHttp\Client(['base_uri' => $dataPTP->endpoint]);
        $url2 = "api/session";
        $headers2 = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json'
        ];

        //Establecer opciones de la Petición.
        $request = new \GuzzleHttp\Psr7\Request('POST', $url2, $headers2);

        try {
            // obtiene la respuesta de la petición
            $response4 = $guzzle->send($request, ['body' => json_encode($peticion)]);
            if ($response4->getStatusCode() == 200) {
                //decodifica el Json de respuesta
                $ft = json_decode($response4->getBody());
                // crea un objeto transacción para almacenarlo 
                // en la base y hacer seguimiento
                $transaccion = new \App\TransaccionesPTP();

                $transaccion->requestId = $ft->requestId;
                $transaccion->reference = $reference;
                $transaccion->signature = '';
                $transaccion->date = Carbon::now();
                $transaccion->status = "";
                $transaccion->reason = "";
                $transaccion->processUrl = $ft->processUrl;
                $transaccion->monto = $monto;
                $transaccion->save();

                //enlaza la venta con el identificador de transacción de PtP
                $venta->token = $ft->requestId;
                $venta->save();

                //Envio de Email del pedido.
                try {
                    $array = \Session::get('carro');
                    \Mail::to($user->correo)
                        ->cc(['rikardomoncada12@gmail.com'])
                        ->send(new PedidoRealizado($venta, $array));
                    //borra contenido del carro
                    \Session::forget('carro');
                    //return response()->json('pedido_guardado');
                } catch (\Throwable $e) {
                    echo 'Excepción en GererarRequestPago: ',  $e->getMessage(), "\n";
                }
                // retorna a la URL establecida
                return redirect($ft->processUrl);
            } else {
                //borra contenido del carro
                \Session::forget('carro');
                //establece la venta con conflicto
                $venta->estadoPago = 'ConflictoPTP';
                $venta->save();
                return Redirect::back()->withErrors(['error' => $response4->getBody()->getContents()]);
                //return response( );
            }
        } catch (\Throwable $th) {
              //borra contenido del carro
            \Session::forget('carro');
            $venta->estadoPago = "ConflictoPTP";
            $venta->save();
            return Redirect::back()->withErrors(['error' => 'El servicio de PlaceToPay presenta conflicto actualmente, le invitamos a intentar el pago mas tarde.']);
        }
    }

    // Realiza una petición de pago sobre una venta que no tenga procesos de pagos abiertos
    public function GeneraPago(Request $r)
    {
        // $seed = Carbon::now()->toIso8601String();
        // $expiration = Carbon::now()->addMinutes(30)->toIso8601String();
        // return response()->json(['seed'=>$seed,'expiration'=>$expiration]);

        // busca ventas con estados de pago Pendiente
        $pagoPendiente = \App\Ventas::where('estadoPago', '=', 'PENDIENTE')->count();

        if ($pagoPendiente > 0) {

            $pagoPData = \App\Ventas::where('estadoPago', '=', 'PENDIENTE')->first();
            // indica que hay ventas con pagos pendiente y no puede ejecutar otro
            return Redirect::back()->withErrors(['error' => 'Estimado Cliente: Actualmente posee un proceso de pago con estado PENDIENTE : Referencia: ' . $pagoPData->idusuario . '-' . $pagoPData->idventas . ', debe esperar el resultado para realizar otro pago.']);
        } else {

            // Carro en Session de Usuario
            $precioAc = 'precio2';
            $ivaconsulta = DB::table('parametros')->where('idparametro', '=', 1)->first();
            $ivaVal = $ivaconsulta->iva;

            // verifica un carro de compra disponible en la session
            if (!is_null(\Session::get('carro'))) {
                $subtotal = 0.0;
                $total = 0.0;
                $iva = 0.0;
                // calcula los valores de la venta
                foreach (\Session::get('carro') as $itemC) {
                    $itemSub = round(floatval($itemC['precio']) * floatval($itemC['cantidad']), 2);
                    $subtotal += $itemSub;
                    if ($itemC['gr_iva'] == 'S') {
                        $iva += round((floatval($itemC['precio']) * floatval($itemC['cantidad'])) * $ivaVal, 2);
                    }
                }
                $total = round($iva + $subtotal, 2);

                // evalua si cumple con el mínimo de un pedido
                if ($total >= $ivaconsulta->min_pedido) {

                    //busca datos del usuario
                    $id = \Session::get('usuario-id');
                    $userT = \App\Usuario::where('idusuario', '=', "$id")->first();
                    $Usuario2 = DB::table('usuario')->where('idusuario', '=', "$id")->first();

                    //Validacion Nombre, Apellido, E-mail
                    $nombreUser = $Usuario2->nombre;
                    $apellidoUser = $Usuario2->apellido;
                    $emailUser = $Usuario2->correo;

                    if (ctype_alpha($nombreUser) and ctype_alpha($apellidoUser) and filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {

                        try {
                            $hoy = date("d/m/Y");
                            $iva_g = 'N';
                            $venta = new Ventas();

                            if ($iva > 0.0) {
                                $iva_g = 'S';
                            }

                            //crea la venta 
                            $venta->iddetalle_ventas = 0;
                            $venta->subtotal = round($subtotal, 2);
                            $venta->iva = $iva;
                            $venta->costo_envio = 0;
                            $venta->envio_gratuito = 0;
                            $venta->total = $total;
                            $venta->fecha = $hoy;
                            $venta->estado = 'A';
                            $venta->Graba_Iva = $iva_g;
                            $venta->token = md5(uniqid(rand(), true));
                            $venta->idusuario = \Session::get('usuario-id');
                            $venta->ruc = $Usuario2->numero_identificacion;
                            $venta->tipoPago = "Placetopay";
                            $venta->estadoPago = "PENDIENTE";

                            $venta->save();

                            foreach (\Session::get('carro') as $key => $value) {
                                // crea la compra
                                $compra = new Compras();
                                $compra->cantidad = $value['cantidad'];
                                $compra->precio = round(floatval($value['precio']), 2);
                                $compra->subtotal = round(floatval($value['cantidad']), 2) * round(floatval($value['precio']), 2);

                                if ($value['gr_iva'] == 'S') {
                                    $compra->iva = ($compra->subtotal) * $ivaVal;
                                } else {
                                    $compra->iva = 0;
                                }
                                $compra->costo_envio = 0;
                                $compra->envio_gratuito = 0;
                                $compra->iddetalle_venta = 0;
                                $compra->idproducto = $value['item'];
                                $compra->valor_neto = round(($compra->subtotal + $compra->iva), 2);
                                $compra->graba_iva = $value['gr_iva'];
                                $compra->idusua = \Session::get('usuario-id');
                                $compra->estado = 'PAG';
                                $compra->idventa = $venta->idventas;
                                $compra->save();
                            }
                            // llama al metodo para pagar con PTP
                            return $this->GererarRequestPago($venta, $userT, $r);
                        } catch (\Throwable $th) {
                            echo 'Excepción en GenerarPago: ',  $th->getMessage(), "\n";
                        }
                    } else {
                        return Redirect::back()->withErrors(['error' => 'Datos del Cliente Incorrectos: Verificar Nombre, Apellido y Correo.']);
                    }
                } else {
                    return Redirect::back()->withErrors(['error' => 'El monto minimo de compra es: $' . $ivaconsulta->min_pedido]);
                }
            } else {
                return Redirect::back()->withErrors(['error' => 'El Carro no tiene Articulos']);
            }
        }
    }

    // metodo para consultar el estado de un pago
    public function ConsultaPago(string $reqId, string $login, string $tranKey, string $nonce, string $seed, string $endpoint)
    {
        // crea los objetos para la petición
        $auth = ['login' => $login, 'tranKey' => $tranKey, 'nonce' => $nonce, 'seed' => $seed];
        $peticion = ['auth' => $auth];
        
        $guzzle = new \GuzzleHttp\Client(['base_uri' => $endpoint]);
        $url2 = 'api/session/' . $reqId;
        $headers2 = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json'
        ];
        // crea la petición
        $request = new \GuzzleHttp\Psr7\Request('POST', $url2, $headers2);

        try {
            // espera el response
            $response4 = $guzzle->send($request, ['body' => json_encode($peticion)]);
            if ($response4->getStatusCode() == 200) {
                //obtiene los datos del reponse
                $ft = json_decode($response4->getBody());
                $statusIn = $ft->status;
                // actualiza el estado de acuerdo a la respuesta
                return ($this->ActualizarEstado($reqId, $statusIn->status, $statusIn->date, $statusIn->message));
                
            } else {
                return response($response4->getBody());
            }
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }


    // función para actualizar los estados de pago de las ventas
    public function ActualizarEstado(string $requestId, string $estado, string $date, string $message, string $signature = '', string $reason = '')
    {
        $trans = \App\TransaccionesPTP::where('requestId', '=', $requestId)->first();
        //Actualizar estado de esa transaccion.
        if ($trans != null) {
            $trans->signature = $signature;
            $trans->status = $estado;
            $trans->reason = $reason;
            $trans->save();
            // los estado vienen de la peticion de PlaceToPay
            if ($estado == 'APPROVED') {
                # codigo para actualizar pedido aprovado.
                $ven = \App\Ventas::where('token', '=', $requestId)->first();
                if ($ven != null) {
                    $ven->estadoPago = "APROBADO";
                    $ven->save();
                }
            } elseif ($estado == 'REJECTED') {
                $ven = \App\Ventas::where('token', '=', $requestId)->first();
                if ($ven != null) {
                    $ven->estadoPago = "RECHAZADO";
                    $ven->save();
                }
            } elseif ($estado == 'FAILED') {
                $ven = \App\Ventas::where('token', '=', $requestId)->first();
                if ($ven != null) {
                    $ven->estadoPago = "RECHAZADO";
                    $ven->save();
                }
            } elseif ($estado == 'REFUNDED') {
                $ven = \App\Ventas::where('token', '=', $requestId)->first();
                if ($ven != null) {
                    $ven->estadoPago = "REEMBOLSO";
                    $ven->save();
                }
            } else {
                $ven = \App\Ventas::where('token', '=', $requestId)->first();
                if ($ven != null) {
                    $ven->estadoPago = "PENDIENTE";
                    $ven->save();
                }
            }
            \Log::info('ActualizarEstado,Transaccion número ' . $requestId . ' PENDIENTE fue Actualizada a ' . $estado);
        } else {
            \Log::info('ActualizarEstado,Transaccion número ' . $requestId . ' no encontrada en BD.');
        }
    }


    // consulta el estado de pago contra Place to Pay
    // las variables son las proporcionadas por PlaceToPay 
    // para el establecimiento
    public function ConsultaPagoInterno($pago)
    {
        // consulta los datos de la empresa relacionados con place to pay y el 
        // ambiente que se esta manejando
        $dataPTP = \App\DatosPTP::where('ambiente', '=', env('APP_PAGO_ENV', 2))->first();
        $secretKey = $dataPTP->secretKey;
        $login = $dataPTP->login;
        $numPedido = $pago;
        $seed = Carbon::now()->toIso8601String();

        // genera los datos necesarios segun la documentacion de place to pay
        // https://docs-gateway.placetopay.com/
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);
        // campo transaction Key
        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));
        //campo auth 
        $auth = ['login' => $login, 'tranKey' => $tranKey, 'nonce' => $nonceBase64, 'seed' => $seed];
        $peticion = ['auth' => $auth];
        //crea peticion con Guzzle
        $guzzle = new \GuzzleHttp\Client(['base_uri' => $dataPTP->endpoint]);
        $url2 = 'api/session/' . $numPedido;
        //agrega cabecera
        $headers2 = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $request = new \GuzzleHttp\Psr7\Request('POST', $url2, $headers2);

        try {
            // obtiene el response de la peticion
            $response4 = $guzzle->send($request, ['body' => json_encode($peticion)]);
            if ($response4->getStatusCode() == 200) {
                // busca el estado
                $ft = json_decode($response4->getBody());
                $statusIn = $ft->status;
                // manda actualizar el estado
                $this->ActualizarEstado($numPedido, $statusIn->status, $statusIn->date, $statusIn->message);
            } else {
                \Log::info('ConsultaPagointerno error: ' . $response4->getBody());
            }
        } catch (\Throwable $th) {
            \Log::info('ConsultaPagointerno error: ' . $th);
        }
    }

    // funcion para verificar ventas con estado pendiente para
    // buscar informacion sobre el estado de su pago, se puede configurar 
    // un trabajo CRON para que se realice a diario.
    public function ProcesoDiario()
    {
        // busca las ventas pendientes
        $pagos = Ventas::where('estadoPago', '=', 'PENDIENTE')->get();
        if ($pagos->isNotEmpty()) {
            \Log::info('Se encontraron pagos con estado PENDIENTE.');
            // recorre las ventas para buscar los estados en place to pay
            foreach ($pagos as $key => $value) {
                $this->ConsultaPagoInterno($value->token);
            }
        } else {
            \Log::info('Sin Pagos PENDIENTES por consultar. ' . Carbon::now()->toIso8601String());
        }
    }

    // funcion no implementada de Test
    public function StringTest(Request $r)
    {
        //return response()->json( $r['string']);
        $result = preg_match("/^[A-Za-zÑñáéíóúÁÉÍÓÚ]+$/i", $r['string']);
        if ($result == true) {
            return response()->json("valido");
        } else {
            return response()->json("Invalido");
        }
    }
}
