<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Checkout extends Controller
{
    public function index()
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

        $productosNuevos = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where('precio2','!=',0)
        ->take(10)
        ->get();
        
        //\Session::flush();

        return view('layout',['cates'=> $categorias,'familias'=>$familias,'proNuevos'=>$productosNuevos,'texto'=>$textos,'imagen'=>$imgweb,'parametros'=>$parametro]);
    }

    public function carro()
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

        $productosNuevos = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where('precio2','!=',0)
        ->take(10)
        ->get();
        
        //\Session::flush();

        return view('carro',['cates'=> $categorias,'familias'=>$familias,'proNuevos'=>$productosNuevos,'texto'=>$textos,'imagen'=>$imgweb,'monto_min'=>$parametro->min_pedido,'parametros'=>$parametro]);
    }
}
