<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Models\Producto;
use App\config;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
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
        ->take(10)
        ->get();

        $tecnoNew = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([[ $precioAc,'!=',0],['idcategoria','=','C0004']])
        ->take(10)
        ->get();

        $descarNew = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([[ $precioAc,'!=',0],['idcategoria','=','C0027']])
        ->take(10)
        ->get();

        $papeNew = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([[ $precioAc,'!=',0],['idcategoria','=','C0017']])
        ->take(10)
        ->get();

        $utilNew = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([[ $precioAc,'!=',0],['idcategoria','=','C0035']])
        ->take(10)
        ->get();

        //\Session::flush();

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

    public function nosotros ()
    {
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
                                

        return view('nosotros',['cates'=> $categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro]);

    }

    public function contacto()
    {
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
             
        return view('contacto',['cates'=> $categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro]);

    }

    public function cuenta ()
    {
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
                                

        if (\Session::get('usuario-id') == null) {
            return view('login',['cates'=> $categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro,'provincias'=>$provincias]);
        } else {
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

            //$cabeceras = DB::table("ventas")->where(['idusuario','=',"$idUser"]);

            return view('cuenta',['dataus'=>$datauser,'cuenta','cates'=> $categorias,'familias'=>$familias,'detalles'=>$pedidos,'cabeceras'=>$cabeceras,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro,'provincias'=>$provincias]);
        }
        
    }

    public function detPedidos(Request $request)
    {
        $venta = $request->venta;
        //$detalle = DB::table('compras')->where('idventa','=',"$venta")->get();

        $pedidos = DB::table('ventas')
        ->join('compras', 'ventas.idventas', '=', 'compras.idventa')
        ->join('producto','compras.idproducto','=','producto.idproducto')
        ->select('ventas.idventas as ventaId',
        'compras.cantidad as DetCantidad','compras.precio as DetPrecio','compras.subtotal as DetSubtotal','compras.graba_iva as DetGrabaIva',
        'compras.valor_neto as DetNeto','compras.idventa as DetIdVenta','compras.idproducto as DetProducto','producto.idproducto as ProId',
        'producto.descripcion as ProNombre')
        ->where('ventas.idventas', '=', "$venta")
        ->get();
        return response()->json($pedidos);
    }
    
    public function howbuy(Request $request){
        
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
                             
        return view('guiacompra',['cates'=> $categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro]);
    }

    public function tarifas(Request $request){

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

        return view('tarifas',['tarifas'=>$tarifas,'cates'=> $categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro]);

    }
}
