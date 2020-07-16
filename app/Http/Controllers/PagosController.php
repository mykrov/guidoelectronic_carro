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
    public function Notificacion(Request $r)
    {   
        $statusIn = $r->status;
        $message = $statusIn['message'];
        $reason = $statusIn['reason'];
        $estado = $statusIn['status'];
        $date = $statusIn['date'];
        
        $requestId = $r->requestId;
        $reference = $r->reference;
        $signature = $r->signature;

        //SecretKey desde Base.
        $dataPTP = \App\DatosPTP::where('ambiente','=',1)->first();
        $secretKey = $dataPTP->secretKey;

        $str = $requestId. $estado . $date . $secretKey;

        //Verificar Firma de PTP
        if (sha1($str) === $signature) {
            return ($this->ActualizarEstado($requestId,$estado,$date,$message,$signature));
        }else{
            return response()->json(['status'=>'error','message'=>'invalid signature']);
        }
    }


    public function GererarRequestPago(Ventas $venta, Usuario $user, Request $req )
    {
        $dataPTP = \App\DatosPTP::where('ambiente','=',env('APP_PAGO_ENV',1))->first();
        $secretKey = $dataPTP->secretKey;
        $login = $dataPTP->login;
       
        $numPedido = $venta->idventas;
        $monto = $venta->total;
        $urlRetorno = route('cuenta');
        $reference = $venta->idusuario."-".$numPedido;
        $seed = Carbon::now()->toIso8601String();
       
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $idType = "CI";

        if (strlen(trim($user->RUC)) == 13) {
            $idType = 'RUC';
        }
        
        $nonceBase64 = base64_encode($nonce);
        $tranKey = base64_encode(sha1($nonce. $seed . $secretKey, true));
        $direccion = ['street'=>$user->direccion,'city'=>$user->ciudad,'country'=>'EC'];
        $buyer = ['documentType'=>$idType,
        'document'=>$user->RUC,
        'name'=>$user->nombre,
        'surname'=>$user->apellido,
        'email'=>$user->correo,
        'address'=>$direccion
        ];
        $auth = ['login'=>$login,'tranKey'=>$tranKey,'nonce'=>$nonceBase64,'seed'=>$seed];
        
        $taxes = [['kind'=>'valueAddedTax','amount'=>$venta->iva,'base'=>$venta->subtotal]];
        $amount =['currency'=>'USD','total'=>$monto,'taxes'=>$taxes];

        $payment = ['reference'=>$reference,'description'=>'Pedido Número '.$numPedido,'amount'=>$amount];
        $expiration = Carbon::now()->addMinutes(40)->toIso8601String();

        $peticion = ['auth'=>$auth,
        'buyer'=>$buyer, 
        'payment'=>$payment,
        'expiration'=>$expiration,
        'returnUrl'=>$urlRetorno,
        'ipAddress'=>$req->ip(),
        'userAgent'=>$req->header('User-Agent')
        ];

        //return response()->json($peticion);

         //Cliente para peticion a la API PlaceToPay.
        $guzzle = new \GuzzleHttp\Client(['base_uri'=>$dataPTP->endpoint]);
        $url2 = "api/session";
        $headers2 = [
            'Content-type'=>'application/json',
            'Accept'=>'application/json'
        ];

        //Establecer opciones de la Petición.
        $request = new \GuzzleHttp\Psr7\Request('POST', $url2, $headers2);

        try { 
            $response4 = $guzzle->send($request, ['body'=>json_encode($peticion)]);
            if ($response4->getStatusCode() == 200) {
                $ft = json_decode($response4->getBody());

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

                $venta->token = $ft->requestId;
                $venta->save();

                //Envio de Email del pedido.
                try {
                    $array = \Session::get('carro');
                    \Mail::to($user->correo)
                    ->cc(['rikardomoncada12@gmail.com'])
                    ->send(new PedidoRealizado($venta,$array));
                    \Session::forget('carro');
                    //return response()->json('pedido_guardado');
                } catch (\Throwable $e) {
                    echo 'Excepción en GererarRequestPago: ',  $e->getMessage(), "\n";
                }

                return redirect($ft->processUrl);

            } else {
                \Session::forget('carro');
                $venta->estadoPago = 'ConflictoPTP';
                $venta->save();
                return Redirect::back()->withErrors(['error'=>$response4->getBody()->getContents()]);
                //return response( );
            }
        } catch (\Throwable $th) {
            \Session::forget('carro');
            $venta->estadoPago = "ConflictoPTP";
            $venta->save();
            return Redirect::back()->withErrors(['error'=>'El servicio de PlaceToPay presenta conflicto actualmente, le invitamos a intentar el pago mas tarde.']);
        }
    }

    public function GeneraPago(Request $r)
    {
        // $seed = Carbon::now()->toIso8601String();
        // $expiration = Carbon::now()->addMinutes(30)->toIso8601String();
        // return response()->json(['seed'=>$seed,'expiration'=>$expiration]);

        $pagoPendiente = \App\Ventas::where('estadoPago','=','PENDIENTE')->count();

        if ($pagoPendiente > 0) {

            $pagoPData = \App\Ventas::where('estadoPago','=','PENDIENTE')->first();

            return Redirect::back()->withErrors(['error'=>'Estimado Cliente: Actualmente posee un proceso de pago con estado PENDIENTE : Referencia: '.$pagoPData->idusuario.'-'.$pagoPData->idventas .', debe esperar el resultado para realizar otro pago.']);

        } else {
                
            //Carro en Session de Usuario
            $precioAc = 'precio2';
            $ivaconsulta = DB::table('parametros')->where('idparametro','=',1)->first();
            $ivaVal = $ivaconsulta->iva;
        
            if (!is_null(\Session::get('carro'))) {
                $subtotal = 0.0;
                $total = 0.0;
                $iva = 0.0;
                foreach(\Session::get('carro') as $itemC){
                    $itemSub = round(floatval($itemC['precio'])*floatval($itemC['cantidad']),2); 
                    $subtotal += $itemSub;
                    if($itemC['gr_iva'] == 'S'){
                        $iva += round((floatval($itemC['precio'])*floatval($itemC['cantidad']))*$ivaVal,2);
                    }
                }
                $total = round($iva+$subtotal,2);

                if ($total >= $ivaconsulta->min_pedido) {
                
                    $id = \Session::get('usuario-id');
                    $userT= \App\Usuario::where('idusuario','=',"$id")->first();
                    $Usuario2 = DB::table('usuario')->where('idusuario','=',"$id")->first();
                    
                    //Validacion Nombre, Apellido, E-mail
                    $nombreUser = $Usuario2->nombre;
                    $apellidoUser = $Usuario2->apellido;
                    $emailUser = $Usuario2->correo;

                    if(ctype_alpha($nombreUser) and ctype_alpha($apellidoUser) and filter_var($emailUser, FILTER_VALIDATE_EMAIL)){

                        try {
                            $hoy = date("d/m/Y");
                            $iva_g = 'N';
                            $venta = new Ventas();
                            
                            if ($iva > 0.0) {
                            $iva_g = 'S';
                            } 
                            $venta->iddetalle_ventas = 0; 
                            $venta->subtotal= round($subtotal,2);
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
                                
                                $compra = new Compras();
                                $compra->cantidad = $value['cantidad'];
                                $compra->precio = round(floatval($value['precio']),2);
                                $compra->subtotal = round(floatval($value['cantidad']),2)*round(floatval($value['precio']),2);
                                
                                if ($value['gr_iva']== 'S') {
                                    $compra->iva = ($compra->subtotal)*$ivaVal;
                                } else {
                                    $compra->iva = 0;
                                }
                                $compra->costo_envio = 0;
                                $compra->envio_gratuito = 0;
                                $compra->iddetalle_venta = 0;
                                $compra->idproducto = $value['item'];
                                $compra->valor_neto = round(($compra->subtotal + $compra->iva),2);
                                $compra->graba_iva = $value['gr_iva'];
                                $compra->idusua = \Session::get('usuario-id');
                                $compra->estado = 'PAG';
                                $compra->idventa = $venta->idventas;
                                $compra->save();
                            }
                            return $this->GererarRequestPago($venta,$userT,$r);

                        } catch (\Throwable $th) {
                            echo 'Excepción en GenerarPago: ',  $th->getMessage(), "\n";
                        }

                    }else{
                        return Redirect::back()->withErrors(['error'=>'Datos del Cliente Incorrectos: Verificar Nombre, Apellido y Correo.']);
                    }

                } else {
                    return Redirect::back()->withErrors(['error'=>'El monto minimo de compra es: $'.$ivaconsulta->min_pedido]);
                }
                
            } else {
                return Redirect::back()->withErrors(['error'=>'El Carro no tiene Articulos']);
            }
        }
        
     

    }

    public function ConsultaPago(string $reqId,string $login,string $tranKey,string $nonce,string $seed,string $endpoint)
    {                
        $auth = ['login'=>$login,'tranKey'=>$tranKey,'nonce'=>$nonce,'seed'=>$seed];
        $peticion = ['auth'=>$auth];

        $guzzle = new \GuzzleHttp\Client(['base_uri' => $endpoint]);
        $url2= 'api/session/'.$reqId;
        $headers2 = [
            'Content-type'=>'application/json',
            'Accept'=>'application/json'
        ];

        $request = new \GuzzleHttp\Psr7\Request('POST', $url2, $headers2);

        try { 
            $response4 = $guzzle->send($request, ['body'=>json_encode($peticion)]);
            if ($response4->getStatusCode() == 200) {
                $ft = json_decode($response4->getBody());
                $statusIn = $ft->status;
                return ($this->ActualizarEstado($reqId,$statusIn->status,$statusIn->date,$statusIn->message));
                //return response()->json($ft);
            } else {
                return response( $response4->getBody());
            }
        } catch (\Throwable $th) {
            return response(['error'=>$th->getMessage()]);
        }
    }


    public function ActualizarEstado(string $requestId,string $estado,string $date,string $message,string $signature = '',string $reason = '')
    {
        $trans = \App\TransaccionesPTP::where('requestId','=',$requestId)->first();
        //Actualizar estado de esa transaccion.
        if ($trans != null) {
            $trans->signature = $signature;
            $trans->status = $estado;
            $trans->reason = $reason;
            $trans->save();

            if ($estado == 'APPROVED') {
                # codigo para actualizar pedido aprovado.
                $ven = \App\Ventas::where('token','=',$requestId)->first();
                if ($ven != null) {
                    $ven->estadoPago = "APROBADO";
                    $ven->save();
                } 
            } elseif($estado == 'REJECTED'){
                $ven = \App\Ventas::where('token','=',$requestId)->first();
                if ($ven != null) {
                    $ven->estadoPago = "RECHAZADO";
                    $ven->save();
                }
            }elseif($estado == 'FAILED'){
                $ven = \App\Ventas::where('token','=',$requestId)->first();
                if ($ven != null) {
                    $ven->estadoPago = "RECHAZADO";
                    $ven->save();
                }
            }elseif($estado == 'REFUNDED'){
                $ven = \App\Ventas::where('token','=',$requestId)->first();
                if ($ven != null) {
                    $ven->estadoPago = "REEMBOLSO";
                    $ven->save();
                }
            }else{
                $ven = \App\Ventas::where('token','=',$requestId)->first();
                if ($ven != null) {
                    $ven->estadoPago = "PENDIENTE";
                    $ven->save();
                }
            }
            \Log::info('ActualizarEstado,Transaccion número '.$requestId.' PENDIENTE fue Actualizada a '.$estado);
        } else {
            \Log::info('ActualizarEstado,Transaccion número '.$requestId.' no encontrada en BD.');
        }
    }


    public function ConsultaPagoInterno($pago)
    {   
        $dataPTP = \App\DatosPTP::where('ambiente','=',env('APP_PAGO_ENV',1))->first();
        $secretKey = $dataPTP->secretKey;
        $login = $dataPTP->login;
        $numPedido = $pago;
        $seed = Carbon::now()->toIso8601String();
       
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }
        
        $nonceBase64 = base64_encode($nonce);
        $tranKey = base64_encode(sha1($nonce. $seed . $secretKey, true));
        $auth = ['login'=>$login,'tranKey'=>$tranKey,'nonce'=>$nonceBase64,'seed'=>$seed];      
        $peticion = ['auth'=>$auth];

        $guzzle = new \GuzzleHttp\Client(['base_uri' => $dataPTP->endpoint]);
        $url2= 'api/session/'.$numPedido;
        $headers2 = [
            'Content-type'=>'application/json',
            'Accept'=>'application/json'
        ];

        $request = new \GuzzleHttp\Psr7\Request('POST', $url2, $headers2);

        try { 
            $response4 = $guzzle->send($request, ['body'=>json_encode($peticion)]);
            if ($response4->getStatusCode() == 200) {
                $ft = json_decode($response4->getBody());
                $statusIn = $ft->status;
                $this->ActualizarEstado($numPedido,$statusIn->status,$statusIn->date,$statusIn->message);
                
            } else {
                \Log::info('ConsultaPagointerno error: '.$response4->getBody());
            }
        } catch (\Throwable $th) {
            \Log::info('ConsultaPagointerno error: '.$th);
        }
    }

    public function ProcesoDiario(){
        $pagos = Ventas::where('estadoPago','=','PENDIENTE')->get();
        if($pagos->isNotEmpty()){
            \Log::info('Se encontraron pagos con estado PENDIENTE.');
            foreach ($pagos as $key => $value) {
                $this->ConsultaPagoInterno($value->token);
            }
        }else{
            \Log::info('Sin Pagos PENDIENTES por consultar. '.Carbon::now()->toIso8601String());
        }
    }
}
