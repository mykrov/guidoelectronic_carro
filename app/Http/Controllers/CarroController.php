<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Ventas;
use App\Compras;
use App\Mail\PedidoRealizado;
use App\Usuario;
use App\PagosKushki;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException; 
use GuzzleHttp\Exception\BadResponseException;


class CarroController extends Controller
{
    // precio por defecto
   Public $precioAc = 'precio2';
                   
   public function add(Request $request)
   {
        //verifica la existencia de una session con usuario para consultar tipo de precio
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
            $precioAc='precio2';
        }
        $precioAc = 'precio2';

        //consulta del iva
        $ivaconsulta = DB::table('parametros')->where('idparametro','=',1)->first();
        $ivaVal = $ivaconsulta->iva;
        $montoSinIva = round(3 - (3 * $ivaVal),2);

        \Session::put(['envio' => 3]);

        // consulta del item a agregar
        $producto = DB::table('producto')->where('idproducto','=',"$request->code")->first();
        $precio = $producto->$precioAc;
        $nombre = $producto->descripcion;
        $gr_iva = $producto->Graba_Iva;

        // crea un itemcarro
        $item = ['item' => $request->code,
                'cantidad' => $request->cantidad,
                'precio' => $precio,
                'nombre' => $nombre,
                'gr_iva' => $gr_iva,];
   
        // verifica si ya hay un carro con item para agregar el actual
        // caso contrario crea el objeto y luego agrega el item
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
        // retorna la el estado del proceso
        return response()->json('agregado');
   }

    //Vaciar Carro y borra el estado
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

    // calculo del valor de envio dependiendio dekl valor seteado en base
    public function valor_envio(Request $r)
    {
        $montoor = $r['valor'];
        $monto = $montoor;

        if (\Session::has('envio')) {
            \Session::put('envio',$monto);

        }

        $envioactual = \Session::get('envio');
        //return response()->json($envioactual);
        $products = session()->pull('carro', []);
            
        foreach ($products as $clave => $valor){
            if(array_search('ENV01', $valor)){
                unset($products[$clave]);
            }
        }

        $itemEnvio =[ 'item' => 'ENV01',
                    'cantidad'  =>1,
                    'precio' => $monto,
                    'nombre' => 'Envio',
                    'gr_iva' => 'N'];

        session()->put('carro', $products);
        // se agrega al carro
        \Session::push('carro',$itemEnvio);
        return response()->json('cambio_valor');
    }

   //cambiar catidad de un item
   public function change_cant(Request $request)
   {
        $products = session()->pull('carro', []);
        $code = $request->code;
        $cantida = $request->cantidad;
        //valida la cantidad
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

   // Retorna la vista del Checkout de la compra
   public function checkout()
   {
        // optiene los registros necesarios para la vista.
        $provincias =DB::select(DB::raw('SELECT * FROM provincia where codigo in (select provincia from canton)'));
        $categorias = DB::table('categoria')->where('estado','=','A')->get();
        $familias = DB::table('familia')->get();

        $textos = DB::table('texto')->get();
        $parametro = DB::table('parametros')->where('idparametro','=',1)->first();
        $imagenes = DB::table('seccion_imagen')
        ->join('imagen','id_imagen','=','idimagen')->get();
        
        $imgweb = array();

        foreach($imagenes as $item){
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        
        //verifica que si hay session de usuario
        if (\Session::get('usuario-nombre') == null) {
            return view('login',['cates'=>$categorias,'familias'=>$familias,'texto'=>$textos,'imagen'=>$imgweb,'parametros'=>$parametro,'provincias'=>$provincias]);
        } else {

            //setea los productos
            $products = session()->pull('carro', []);
            
            foreach ($products as $clave => $valor){
                if(array_search('ENV01', $valor)){
                    unset($products[$clave]);
                }
            }

            //configura el envio
            $envioactual = \Session::get('envio');
            $montoEnvios = $envioactual;

            $itemEnvio =[ 'item' => 'ENV01',
                    'cantidad'  =>1,
                    'precio' => $montoEnvios,
                    'nombre' => 'Envio',
                    'gr_iva' => 'N'];

            //configura la session
            session()->put('carro', $products);
            \Session::push('carro',$itemEnvio);

            $id = \Session::get('usuario-id');
            $Usuario2 = DB::table('usuario')->where('idusuario','=',"$id")->first();
            return view('checkout',['cates'=>$categorias,'familias'=>$familias,'user'=>$Usuario2,'texto'=>$textos,'imagen'=>$imgweb,'parametros'=>$parametro,'provincias'=>$provincias]);
        }
   }


   //Proceso de Pago y Guardado del pedido.
   public function pedido(Request $request)
   {
        //seteo del prescio y consulta iva
        $precioAc = 'precio2';
        $ivaconsulta = DB::table('parametros')->where('idparametro','=',1)->first();
        $ivaVal = $ivaconsulta->iva;
        //verifica que exista carro en la session
        if (!is_null(\Session::get('carro'))) {
            $subtotal = 0.0;
            $total = 0.0;
            $iva = 0.0;
            // calculo del subtotal e iva de los productos
            foreach(\Session::get('carro') as $itemC){
                $itemSub = round(floatval($itemC['precio'])*floatval($itemC['cantidad']),2); 
                $subtotal += $itemSub;
                if($itemC['gr_iva'] == 'S'){
                    $iva += round((floatval($itemC['precio'])*floatval($itemC['cantidad']))*$ivaVal,2);
                }
            }
            $total = $iva+$subtotal;

            // se evalua si el total del pedido es mayor o igual al minimo establecido para pedidos
            // en la base de datos.
            if ($total >=$ivaconsulta->min_pedido) {
                //obtiene valores desde la session
                $id = \Session::get('usuario-id');
                $Usuario2 = DB::table('usuario')->where('idusuario','=',"$id")->first();
                try {
                    //crea venta y la guarda
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
                    $venta->tipoPago = "EFE/BAN/CE";
                    $venta->estadoPago = "Por Acordar";
                    $venta->save();

                    foreach (\Session::get('carro') as $key => $value) {
                        
                        // graba la compra
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

                        //obtiene los items para mandar el email con los detalles
                        $array = \Session::get('carro');
                        \Mail::to($Usuario2->correo)
                        ->cc(['contabilidad@guidolectronic.com'])
                        ->send(new PedidoRealizado($venta,$array));
                        // limpia el carro de la session
                        \Session::forget('carro');
                        return response()->json('pedido_guardado');

                    
                    } catch (\Throwable $e) {
                        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                    }

                } catch (\Throwable $th) {
                    echo 'Excepción capturada: ',  $th->getMessage(), "\n";
                }

            } else {
                return response()->json('menor_30');
            }
            
        } else {
            return response()->json('carro_vacio');
        }
        //Datos provenientes del servidor de Kushki cuando verifica la tarjeta.
        // $tokenKushki = $request->kushkiToken;
        // $clienteks = $request->client; //dato adicional agregado al form
        // $total_ks = $request->total; //dato adicional agregado al form
        // //Clave Privada del Comercio
        // $privateID = '20000000104308550000';
        
        // $ivaconsulta = DB::table('parametros')->where('idparametro','=',1)->first();
        // $ivaVal = $ivaconsulta->iva;
        // if (!is_null(\Session::get('carro'))) {
        //     $subtotal = 0.0;
        //     $total = 0.0;
        //     $iva = 0.0;
        //     $ice = 0.0;
        //     foreach(\Session::get('carro') as $itemC){
        //         $itemSub = round(floatval($itemC['precio'])*floatval($itemC['cantidad']),2); 
        //         $subtotal += $itemSub;
        //         if($itemC['gr_iva'] == 'S'){
        //             $iva += round((floatval($itemC['precio'])*floatval($itemC['cantidad']))*$ivaVal,2);
        //         }
        //     }
        //     $total = $iva+$subtotal;

        //     if ($total >=$ivaconsulta->min_pedido) {

        //         $id = \Session::get('usuario-id');
        //         $Usuario2 = DB::table('usuario')->where('idusuario','=',"$id")->first();
                 //Cliente para peticion a la API Kushki
                // $guzzle = new \GuzzleHttp\Client();
                // $url2 = "https://api-uat.kushkipagos.com/card/v1/charges";
               
                // $myBody = ['token'=>$tokenKushki,
                // 'amount'=>['subtotalIva'=>0,
                //             'subtotalIva0'=>$total,
                //             'iva'=>0,
                //             'currency'=>'USD'],
                // 'metadata'=>['clienteID'=>$id],
                // 'fullResponse'=>true];
               
                // $headers2 = [
                //     'private-merchant-id' => $privateID,
                //     'Content-type' => 'application/json'
                // ];
                //armado de la peticion
                // $request = new \GuzzleHttp\Psr7\Request('POST', $url2, $headers2);

        //         try{
        //             $response4 = $guzzle->send($request, ['body' => json_encode($myBody)]);
        //             if($response4->getStatusCode() == 201){
        //                 try {
        //                     $hoy = date("d/m/Y");
        //                     $iva_g = 'N';
        //                     $venta = new Ventas();
                            
        //                     if ($iva > 0.0) {
        //                        $iva_g = 'S';
        //                     } 
        //                     $venta->iddetalle_ventas = 0; 
        //                     $venta->subtotal= $subtotal;
        //                     $venta->iva = $iva;
        //                     $venta->costo_envio = 0;
        //                     $venta->envio_gratuito = 0; 
        //                     $venta->total = $total;
        //                     $venta->fecha = $hoy;
        //                     $venta->estado = 'A';
        //                     $venta->Graba_Iva = $iva_g;
        //                     $venta->token = md5(uniqid(rand(), true));
        //                     $venta->idusuario = \Session::get('usuario-id');
        //                     $venta->ruc = $Usuario2->numero_identificacion;
                                
        //                     $venta->save();
            
        //                     foreach (\Session::get('carro') as $key => $value) {
                                
        //                         $compra = new Compras();
        //                         $compra->cantidad = $value['cantidad'];
        //                         $compra->precio = round(floatval($value['precio']),2);
        //                         $compra->subtotal = round(floatval($value['cantidad']),2)*round(floatval($value['precio']),2);
                                
        //                         if ($value['gr_iva']== 'S') {
        //                             $compra->iva = ($compra->subtotal)*$ivaVal;
        //                         } else {
        //                             $compra->iva = 0;
        //                         }
        //                         $compra->costo_envio = 0;
        //                         $compra->envio_gratuito = 0;
        //                         $compra->iddetalle_venta = 0;
        //                         $compra->idproducto = $value['item'];
        //                         $compra->valor_neto = round(($compra->subtotal + $compra->iva),2);
        //                         $compra->graba_iva = $value['gr_iva'];
        //                         $compra->idusua = \Session::get('usuario-id');
        //                         $compra->estado = 'PAG';
        //                         $compra->idventa = $venta->idventas;
        //                         $compra->save();
        //                     }

        //                     $pKushki = new PagosKushki();
        //                     $pKushki->fecha = date("Y-m-d H:i:s");
        //                     $pKushki->cc_token = $tokenKushki;
        //                     $pKushki->usuario = \Session::get('usuario-id');
        //                     $pKushki->monto = $venta->total;
        //                     $pKushki->estado = 'Aprobado';
        //                     $pKushki->id_enta = $venta->idventas;
        //                     $pKushki->save();

        
        //                     try {
        
        //                         $array = \Session::get('carro');
        //                         \Mail::to($Usuario2->correo)->send(new PedidoRealizado($venta,$array));
        //                         \Session::forget('carro');
        //                         return redirect()->back()->with(['alert'=>'Pedido Realizado con exito!','tipo'=>'success']);
        
        //                     } catch (\Throwable $e) {
        //                         echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        //                     }
        
        //                 } catch (\Throwable $th) {
        //                     echo 'Excepción capturada: ',  $th->getMessage(), "\n";
        //                     //reversar cobro y pedido
        //                 }
                   
        //             }  
        //         }catch(\GuzzleHttp\Exception\ClientException $e){
        //             $response55 = $e->getResponse();
        //             $responseBodyAsString = $response55->getBody()->getContents();
        //             return redirect()->back()->with(['alert'=>'Problema al procesar el pago.','tipo'=>'error']);
        //         }
                
        //         //return response()->json($response->getStatusCode());

        //         //$answer = $response->getBody()->getContents();
                
        //         // if($response->getStatusCode() == '400 Bad Request'){
        //         //     return response()->json('rechazada');
        //         // }elseif($response->getStatusCode() == 201){
        //         //     if($answer = $response->getBody()->getContents()){
        //         //         $decode = json_decode($answer);
        //         //         return response()->json(['ticket'=>$decode->ticketNumber,'estado'=>$decode->details->transactionStatus]);
        //         //     }else{
        //         //         return response()->json('badRequets');
        //         //     }
        //         // }
                
        //     } else {
        //         return redirect()->back()->with(['alert'=>'El pedido es menor de 30$!','tipo'=>'error']);
        //     }
            
        // } else {
            
        //     return redirect()->back()->with(['alert'=>'El carro de compra parece no tener productos','tipo'=>'error']);
        // }
       
   }
}
