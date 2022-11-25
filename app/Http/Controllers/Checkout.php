<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Checkout extends Controller
{

    // fucnion para retornar la vista de layout con
    // su conjunto de  variables
    public function index()
    {
        //obtiene las varibles para la vista
        $categorias = DB::table('categoria')->where('estado','=','A')->get();
        $familias = DB::table('familia')->get();
        $textos = DB::table('texto')->get();
        $parametro = DB::table('parametros')->where('idparametro','=',1)->first();
        $imagenes = DB::table('seccion_imagen')
        ->join('imagen','id_imagen','=','idimagen')->get();
        // obtiene las imagenes
        $imgweb = array();

        foreach($imagenes as $item){
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        //productos nuevos
        $productosNuevos = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where('precio2','!=',0)
        ->take(10)
        ->get();        
        
        // rtorna la vista
        return view('layout',['cates'=> $categorias,'familias'=>$familias,'proNuevos'=>$productosNuevos,'texto'=>$textos,'imagen'=>$imgweb,'parametros'=>$parametro]);
    }

    // fucion para rstornar la vista de carro
    public function carro()
    {
        // obtiene las variables necesarias
        $categorias = DB::table('categoria')->where('estado','=','A')->get();
        $familias = DB::table('familia')->get();
        $textos = DB::table('texto')->get();
        $parametro = DB::table('parametros')->where('idparametro','=',1)->first();
        $imagenes = DB::table('seccion_imagen')
        ->join('imagen','id_imagen','=','idimagen')->get();
        // obtiene las imagenes
        $imgweb = array();

        foreach($imagenes as $item){
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        // obtiene los productos
        $productosNuevos = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where('precio2','!=',0)
        ->take(10)
        ->get();
        
        // retorna la vistas
        return view('carro',['cates'=> $categorias,'familias'=>$familias,'proNuevos'=>$productosNuevos,'texto'=>$textos,'imagen'=>$imgweb,'monto_min'=>$parametro->min_pedido,'parametros'=>$parametro]);
    }
}
