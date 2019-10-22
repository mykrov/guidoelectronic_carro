<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Ventas;
use App\Compras;
use App\Mail\PedidoRealizado;
use App\Usuario;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException; 
use GuzzleHttp\Exception\BadResponseException;


class CarroController extends Controller
{
                   
   public function add(Request $request)
   {
        if (\Session::has('usuario-tipo')) {
            $tipo = \Session::get('usuario-tipo');

            if (trim($tipo) == 'CTB') {
                $precioAc = 'precio2';
            }elseif (trim($tipo) == 'CTC') {
                $precioAc = 'precio3';
            }elseif (trim($tipo) == 'CTD') {
                $precioAc = 'precio4';
            }elseif (trim($tipo) == 'CTE') {
                $precioAc = 'precio5';
            } elseif(trim($tipo) == 'CTA') {
                $precioAc='precio';
            }
        }else{
            $precioAc='precio';
        }

       $producto = DB::table('producto')->where('idproducto','=',"$request->code")->first();
       $precio = $producto->$precioAc;
       $nombre = $producto->descripcion;
       $gr_iva = $producto->Graba_Iva;

       $item = ['item' => $request->code,
        'cantidad' => $request->cantidad,
        'precio' => $precio,
        'nombre' => $nombre,
        'gr_iva' => $gr_iva,];

        if(\Session::has('carro')){

            $products = session()->pull('carro', []);
            
            foreach ($products as $clave => $valor){
                if(array_search($request->code, $valor)){
                    unset($products[$clave]);
                }
            }
            session()->put('carro', $products);
            \Session::push('carro',$item);  

        }else{
            
            \Session::put('carro',[]);
            \Session::push('carro',$item);
        }

        return response()->json('agregado');
   }

    //Vaciar Carro
   public function empty_car()
   {
      
        \Session::forget('carro');
        session()->pull('carro', []);
        return response()->json('limpiado');
   }

   //Borrar Item del carro
   public function delete_item(Request $request)
   {
        $products = session()->pull('carro', []);
        $code = $request->code;

        foreach ($products as $clave => $valor){
            if(array_search($code, $valor)){
                unset($products[$clave]);
            }
        }
        session()->put('carro', $products);
        return response()->json($products);
   }

   //cambiar catidad de un item
   public function change_cant(Request $request)
   {
        $products = session()->pull('carro', []);
        $code = $request->code;
        $cantida = $request->cantidad;
        
        if($cantida < 1){
            $cantida = 1;
        }

        foreach ($products as $clave => $valor){
            if(array_search($code, $valor)){
                $products[$clave]['cantidad'] = $cantida;
            }
        }

        session()->put('carro', $products);
        return response()->json($products);
   }

   public function checkout()
   {
        $categorias = DB::table('categoria')->where('estado','=','A')->get();
        $familias = DB::table('familia')->get();

        $textos = DB::table('texto')->get();

        $imagenes = DB::table('seccion_imagen')
        ->join('imagen','id_imagen','=','idimagen')->get();
        
        $imgweb = array();

        foreach($imagenes as $item){
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        
        
        if (\Session::get('usuario-nombre') == null) {
            return view('login',['cates'=>$categorias,'familias'=>$familias,'texto'=>$textos,'imagen'=>$imgweb]);
        } else {
            $id = \Session::get('usuario-id');
            $Usuario2 = DB::table('usuario')->where('idusuario','=',"$id")->first();
            return view('checkout',['cates'=>$categorias,'familias'=>$familias,'user'=>$Usuario2,'texto'=>$textos,'imagen'=>$imgweb]);
        }
   }


   //Proceso de Pago y Guardado del pedido.
   public function pedido(Request $request)
   {
        //Datos provenientes del servidor de Kushki cuando verifica la tarjeta.
        $tokenKushki = $request->kushkiToken;
        $clienteks = $request->client; //dato adicional agregado al form
        $total_ks = $request->total; //dato adicional agregado al form
        //Clave Privada del Comercio
        $privateID = '20000000104308550000';
        
        $ivaconsulta = DB::table('parametros')->where('idparametro','=',1)->first();
        $ivaVal = $ivaconsulta->iva;
        if (!is_null(\Session::get('carro'))) {
            $subtotal = 0.0;
            $total = 0.0;
            $iva = 0.0;
            $ice = 0.0;
            foreach(\Session::get('carro') as $itemC){
                $itemSub = round(floatval($itemC['precio'])*floatval($itemC['cantidad']),2); 
                $subtotal += $itemSub;
                if($itemC['gr_iva'] == 'S'){
                    $iva += round((floatval($itemC['precio'])*floatval($itemC['cantidad']))*$ivaVal,2);
                }
            }
            $total = $iva+$subtotal;

            if ($total >=$ivaconsulta->min_pedido) {

                $id = \Session::get('usuario-id');
                $Usuario2 = DB::table('usuario')->where('idusuario','=',"$id")->first();
                //Cliente para peticion a la API Kushki
                $guzzle = new \GuzzleHttp\Client();
                $url2 = "https://api-uat.kushkipagos.com/card/v1/charges";
               
                $myBody = ['token'=>$tokenKushki,
                'amount'=>['subtotalIva'=>0,
                            'subtotalIva0'=>$total,
                            'iva'=>0,
                            'currency'=>'USD'],
                'metadata'=>['clienteID'=>$id],
                'fullResponse'=>true];
               
                $headers2 = [
                    'private-merchant-id' => $privateID,
                    'Content-type' => 'application/json'
                ];
                //armado de la peticion
                $request = new \GuzzleHttp\Psr7\Request('POST', $url2, $headers2);

                try{
                    $response4 = $guzzle->send($request, ['body' => json_encode($myBody)]);
                    if($response4->getStatusCode() == 201){
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
        
                            try {
        
                                $array = \Session::get('carro');
                                \Mail::to($Usuario2->correo)->send(new PedidoRealizado($venta,$array));
                                \Session::forget('carro');
                                return redirect()->back()->with('alert', 'Pedido Realizado!');
        
                            } catch (\Throwable $e) {
                                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                            }
        
                        } catch (\Throwable $th) {
                            echo 'Excepción capturada: ',  $th->getMessage(), "\n";
                            //reversar cobro y pedido
                        }
                   
                    }  
                }catch(\GuzzleHttp\Exception\ClientException $e){
                    $response55 = $e->getResponse();
                    $responseBodyAsString = $response55->getBody()->getContents();
                    return redirect()->back()->with('alert', 'Problema al procesar el pago.');
                }
                
                //return response()->json($response->getStatusCode());

                //$answer = $response->getBody()->getContents();
                
                // if($response->getStatusCode() == '400 Bad Request'){
                //     return response()->json('rechazada');
                // }elseif($response->getStatusCode() == 201){
                //     if($answer = $response->getBody()->getContents()){
                //         $decode = json_decode($answer);
                //         return response()->json(['ticket'=>$decode->ticketNumber,'estado'=>$decode->details->transactionStatus]);
                //     }else{
                //         return response()->json('badRequets');
                //     }
                // }
                
            } else {
                return redirect()->back()->with('alert', 'El pedido es menor de 30$!');
            }
            
        } else {
            
            return redirect()->back()->with('alert', 'El carro de compra parece no tener productos');
        }
       
   }
}
