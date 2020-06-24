<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Ventas;
use App\Compras;
use App\Mail\PedidoRealizado;
use App\Usuario;
use App\PagosKushki;
use Carbon\Carbon;

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


    public function GererarRequestPago(Ventas $venta,string $email )
    {
        $dataPTP = \App\DatosPTP::where('ambiente','=',1)->first();
        $secretKey = $dataPTP->secretKey;
        $login = $dataPTP->login;

        #Datos Harcodeados.
        $numPedido = $venta->idventas; //1582;
        $monto = $venta->total;
        $urlRetorno = "http://guido.test:8000/cuenta";
        $reference = $venta->idusuario."-".$numPedido;
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
        $amount =['currency'=>'USD','total'=>$monto];
        $payment = ['reference'=>$reference,'description'=>'Pedido Número '.$numPedido,'amount'=>$amount];
        $expiration = Carbon::now()->addDays(1)->toIso8601String();

        $peticion = ['auth'=>$auth,
        'payment'=>$payment,
        'expiration'=>$expiration,
        'returnUrl'=>$urlRetorno,
        'ipAddress'=>'181.198.213.18',
        'userAgent'=>'userAgent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Safari/537.36'
        ];

         //Cliente para peticion a la API PlaceToPay.
        $guzzle = new \GuzzleHttp\Client(['base_uri' => $dataPTP->endpoint]);
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
                    \Mail::to($email)
                    ->cc(['rikardomoncada12@gmail.com'])
                    ->send(new PedidoRealizado($venta,$array));
                    \Session::forget('carro');
                    //return response()->json('pedido_guardado');
                } catch (\Throwable $e) {
                    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                }

                return redirect($ft->processUrl);

            } else {
                return response( $response4->getBody()->getContents());
            }
        } catch (\Throwable $th) {
            return response(['error'=>$th->getMessage()]);
        }
    }

    public function GeneraPago()
    {
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
                $Usuario2 = DB::table('usuario')->where('idusuario','=',"$id")->first();
                try {
                    $hoy = date("d/m/Y");
                    $iva_g = 'N';
                    $venta = new Ventas();
                    
                    if ($iva > 0.0) {
                    $iva_g = 'S';
                    } 
                    $venta->iddetalle_ventas = 0; 
                    $venta->subtotal= $subtotal;
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
                    $venta->tipoPago = "PlaceToPay";
                    $venta->estadoPago = "Procesando";
                    
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
                    return $this->GererarRequestPago($venta,$Usuario2->correo);

                } catch (\Throwable $th) {
                    echo 'Excepción capturada: ',  $th->getMessage(), "\n";
                }

            } else {
                return response()->json('menor_30');
            }
            
        } else {
            return response()->json('carro_vacio');
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
                # codigo para actualizar pedido pagado.
                $ven = \App\Ventas::where('token','=',$requestId)->first();
                if ($ven != null) {
                    $ven->estadoPago = "APROBADO";
                    $ven->save();
                } 
                
            } else {

                #codigo para otros estados.
            }
            return response()->json(['status'=>'ok','message'=>'saved']);
        } else {
            return response()->json(['status'=>'error','message'=>'requestId no found']);
        }
    }


    public function ConsultaPagoInterno()
    {   
        $dataPTP = \App\DatosPTP::where('ambiente','=',1)->first();
        $secretKey = $dataPTP->secretKey;
        $login = $dataPTP->login;

        #Datos Harcodeados.
        $numPedido = 174872;
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
                return ($this->ActualizarEstado($numPedido,$statusIn->status,$statusIn->date,$statusIn->message));
                //return response()->json($ft);
            } else {
                return response( $response4->getBody());
            }
        } catch (\Throwable $th) {
            return response(['error'=>$th->getMessage()]);
        }
    }
}
