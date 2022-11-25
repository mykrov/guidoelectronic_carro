<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Models\Producto;
use App\config;
Use Cache;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    // retorna la vista de layout con las dependencias y actualiza las visitas
    public function index()
    {
        //instancia de las visitas
        $visita = \App\Parametros::find(1);
       
        // actualiza las visitas
        if(Cache::has('visita') == false){
            Cache::add('contador',1);
             $visita->visitas++;
             $visita->save();
        }

        // busca las dependencias de la vistas 
        $precioAc = 'precio2';
        $categorias = DB::table('categoria')->where('estado','=','A')->get();
        $familias = DB::table('familia')->get();
        $parametros = DB::table('parametros')->first();
        $imagenes = DB::table('seccion_imagen')
        ->join('imagen','id_imagen','=','idimagen')->get();
        
        $imgweb = array();

        foreach($imagenes as $item){
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }

        $textos = DB::table('texto')->get();
 
        $productosNuevos = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where( $precioAc,'!=',0)
        ->where('stock','>',0)
        ->where('estado','=','A')
        ->take(10)
        ->get();

        $tecnoNew = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([[ $precioAc,'>',0],['idcategoria','=','C0004'],['stock','>',0],['estado','=','A']])
        ->take(10)
        ->get();

        $descarNew = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([[ $precioAc,'!=',0],['idcategoria','=','C0027'],['stock','>',0],['estado','=','A']])
        ->take(10)
        ->get();

        $papeNew = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([[ $precioAc,'!=',0],['idcategoria','=','C0017'],['stock','>',0],['estado','=','A']])
        ->take(10)
        ->get();

        $utilNew = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([[ $precioAc,'!=',0],['idcategoria','=','C0035'],['stock','>',0],['estado','=','A']])
        ->take(10)
        ->get();

        
        // retorna la vista con las variables
        return view('layout',['cates'=> $categorias,
        'familias'=>$familias,
        'proNuevos'=>$productosNuevos,
        'tenoNew'=>$tecnoNew,
        'descarNew'=>$descarNew,
        'papeNew'=>$papeNew,
        'utilNew'=>$utilNew,
        'imagen'=>$imgweb,
        'texto'=>$textos,
        'parametros'=>$parametros
        ]);
    }

    // retorna la vista de nosotros
    public function nosotros ()
    {
        // busca las dependencias para la vista
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
        // retorna la vista con las variables           
        return view('nosotros',['cates'=> $categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro]);

    }

    // retorna la vista de contacto
    public function contacto()
    {
        //busca las dependencias de la vista
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
        //retorna la vista con sus variables            
        return view('contacto',['cates'=> $categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro]);

    }

    // retorna la vista de cuenta del usuario si esta logueado
    // de caso contario retorna al login
    public function cuenta ()
    {
        // busca las dependencias de la vista
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
                                
        // verifica si hay un usuario logueado
        if (\Session::get('usuario-id') == null) {
            return view('login',['cates'=> $categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro,'provincias'=>$provincias]);
        } else {
            // busca los datos y compras del usuario
            $idUser = \Session::get('usuario-id');

            $datauser = DB::table('usuario')->where('idusuario','=',"$idUser")->first();
            
            $pedidos = DB::table('ventas')
            ->join('compras', 'ventas.idventas', '=', 'compras.idventa')
            ->join('producto','compras.idproducto','=','producto.idproducto')
            ->select('ventas.idventas as ventaId','ventas.subtotal as ventasubtotal','ventas.total as ventaTotal','ventas.iva as ventaIva','ventas.fecha as ventaFecha',
            'compras.cantidad as DetCantidad','compras.precio as DetPrecio','compras.subtotal as DetSubtotal','compras.graba_iva as DetGrabaIva',
            'compras.valor_neto as DetNeto','compras.idventa as DetIdVenta','compras.idproducto as DetProducto','producto.idproducto as ProId',
            'producto.descripcion as ProNombre')
            ->where('ventas.idusuario', '=', "$idUser")
            ->get();

            $cabeceras = DB::table('ventas')->where('idusuario','=',"$idUser")->orderBy('idventas','DESC')->get();

            //retorna la vista
            return view('cuenta',['dataus'=>$datauser,'cuenta','cates'=> $categorias,'familias'=>$familias,'detalles'=>$pedidos,'cabeceras'=>$cabeceras,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro,'provincias'=>$provincias]);
        }
        
    }

    // retorna JSON de detalles de pedidos
    public function detPedidos(Request $request)
    {
        // consulta los datos
        $venta = $request->venta;      

        $pedidos = DB::table('ventas')
        ->join('compras', 'ventas.idventas', '=', 'compras.idventa')
        ->join('producto','compras.idproducto','=','producto.idproducto')
        ->select('ventas.idventas as ventaId',
        'compras.cantidad as DetCantidad','compras.precio as DetPrecio','compras.subtotal as DetSubtotal','compras.graba_iva as DetGrabaIva',
        'compras.valor_neto as DetNeto','compras.idventa as DetIdVenta','compras.idproducto as DetProducto','producto.idproducto as ProId',
        'producto.descripcion as ProNombre')
        ->where('ventas.idventas', '=', "$venta")
        ->get();
        //retorna los datos
        return response()->json($pedidos);
    }
    
    // retorna la vista de como comprar
    public function howbuy(Request $request){
        //obtiene las variables de la vista
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
        //retorna la vista                             
        return view('guiacompra',['cates'=> $categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro]);
    }


    // retorna la vista de politicas de la empresa
    public function politicas()
    {
        //obtiene las variables para la vista
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
        // retorna la vista                             
        return view('politicas',['cates'=> $categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro]);

    }

    //retorna la vista de tarifas de envio
    public function tarifas(Request $request){
        //obtiene las variables de la vista
        $categorias = DB::table('categoria')->where('estado','=','A')->get();
        $familias = DB::table('familia')->get();
        $textos = DB::table('texto')->get();
        $parametro = DB::table('parametros')->where('idparametro','=',1)->first();
        $imagenes = DB::table('seccion_imagen')
        ->join('imagen','id_imagen','=','idimagen')->get();

        $tarifas = DB::table('tarifas_envio')->get();
        
        $imgweb = array();

        foreach($imagenes as $item){
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        // retorna la vista
        return view('tarifas',['tarifas'=>$tarifas,'cates'=> $categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro]);

    }
    //Vista de Test no implementada
    public function indexAfrodita(Request $request){
        return view('tarifas');
    }
}
