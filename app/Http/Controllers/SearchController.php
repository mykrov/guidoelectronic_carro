<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{

    public function search()
    {
        $categorias = DB::table('categoria')->where('estado','=','A')->get();
        $familias = DB::table('familia')->get();
        $textos = DB::table('texto')->get();
        $parametros = DB::table('parametros')->first();
        $imagenes = DB::table('seccion_imagen')
        ->join('imagen','id_imagen','=','idimagen')->get();
        
        $imgweb = array();


        foreach($imagenes as $item){
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        
        $text = Input::get('text');
        $category = Input::get('category');

        if($category == 'TODAS')
        {
            $where =[['descripcion','like',"%$text%"],['precio2','!=',0],['estado','=','A']];
        }else{
            $where =[['descripcion','like',"%$text%"],['idcategoria','=',"$category"],['precio2','!=',0],['estado','=','A']];
        }

        $productosLike = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where($where)
        ->paginate(15)
        ->setpath('');

        $productosLike->appends(array(
            'text'=>$text,
            'category'=>$category,
        ));

        return view('busqueda',['cates'=> $categorias,
        'familias'=>$familias,
        'productosLike'=>$productosLike,
        'buscado'=>$text,
        'imagen'=>$imgweb,
        'texto'=>$textos,
        'parametros' => $parametros
        ]);
    }

    public function categoria($code)
    {
        $categorias = DB::table('categoria')->where('estado','=','A')->get();
        $familias = DB::table('familia')->get();
        $textos = DB::table('texto')->get();
        $parametros = DB::table('parametros')->first();
        $imagenes = DB::table('seccion_imagen')
        ->join('imagen','id_imagen','=','idimagen')->get();
        
        $imgweb = array();

        foreach($imagenes as $item){
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        
        $result = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([['idcategoria','=',"$code"],['estado','=','A'],['precio2','>',0]])
        ->paginate(15)
        ->setpath('');

        $codigo_buscado = DB::table('categoria')->where('idcategoria','=',"$code")->first();
        
        return view('busqueda',['cates'=>$categorias,
        'familias'=>$familias,
        'productosLike'=>$result,
        'buscado'=>$codigo_buscado->nombre,
        'imagen'=> $imgweb,
        'texto'=>$textos,
        'parametros' => $parametros
        ]);

    }

    public function familia($code)
    {
        $categorias = DB::table('categoria')->where('estado','=','A')->get();
        $familias = DB::table('familia')->get();
        $textos = DB::table('texto')->get();
        $parametros = DB::table('parametros')->first();
        $imagenes = DB::table('seccion_imagen')
        ->join('imagen','id_imagen','=','idimagen')->get();
        
        $imgweb = array();

        foreach($imagenes as $item){
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        
        $result = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([['idfamilia','=',"$code"],['estado','=','A'],['precio2','>',0]])
        ->paginate(15)
        ->setpath('');

        $codigo_buscado = DB::table('familia')->where('idfamilia','=',"$code")->first();
        
        return view('busqueda',['cates'=>$categorias,
        'familias'=>$familias,
        'productosLike'=>$result,
        'buscado'=>$codigo_buscado->nombre_familia,
        'imagen'=>$imgweb,
        'texto'=>$textos,
        'parametros' => $parametros
        ]);

    }


    public function producto($code)
    {
        $categorias = DB::table('categoria')->where('estado','=','A')->get();
        $familias = DB::table('familia')->get();
        $textos = DB::table('texto')->get();
        $parametros = DB::table('parametros')->first();
        $imagenes = DB::table('seccion_imagen')
        ->join('imagen','id_imagen','=','idimagen')->get();
        
        $imgweb = array();

        foreach($imagenes as $item){
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        $result = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([['idfamilia','=',"$code"],['estado','=','A']])
        ->paginate(15)
        ->setpath('');

        $codigo_buscado = DB::table('familia')->where('idfamilia','=',"$code")->first();
        
        return view('busqueda',['cates'=>$categorias,
        'familias'=>$familias,
        'productosLike'=>$result,
        'buscado'=>$codigo_buscado->nombre_familia,
        'imagen'=>$imgweb,
        'texto'=>$textos,
        'parametros' => $parametros
        ]);

    }

    public function modal(Request $request)
    {
        
            if (\Session::has('usuario-tipo')) {
                $tipo = \Session::get('usuario-tipo');

                if ($tipo == 'CTB') {
                    $precioAc = 'precio2';
                }elseif ($tipo == 'CTC') {
                    $precioAc = 'precio3';
                }elseif ($tipo == 'CTD') {
                    $precioAc = 'precio4';
                }elseif ($tipo == 'CTE') {
                    $precioAc = 'precio5';
                } elseif($tipo == 'CTA') {
                    $precioAc='precio';
                }
            }else{
                $precioAc='precio2';
            }
        

        $producto = DB::table('producto')->where('idproducto','=',"$request->code")->first();
        return response()->json($producto);
    }

    public function single($code)
    {

        $categorias = DB::table('categoria')->where('estado','=','A')->get();
        $familias = DB::table('familia')->get();
        $textos = DB::table('texto')->get();
        $parametros = DB::table('parametros')->first();
        $imagenes = DB::table('seccion_imagen')
        ->join('imagen','id_imagen','=','idimagen')->get();
        
        $imgweb = array();

        foreach($imagenes as $item){
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        
        $tecnoNew = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([['precio2','!=',0],['idcategoria','=','C0060']])
        ->take(10)
        ->get();

        $producto = DB::table('producto')->where('idproducto','=',"$code")->first();
        return view('singleproduct',['tenoNew'=>$tecnoNew,
        'cates'=>$categorias,
        'familias'=>$familias,
        'producto'=>$producto,
        'imagen'=>$imgweb,
        'texto'=>$textos,
        'parametros' => $parametros
        ]);
    }
}
