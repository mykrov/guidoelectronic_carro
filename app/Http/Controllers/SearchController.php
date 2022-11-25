<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Redirect;

class SearchController extends Controller
{

    // retorna la vista de resultados de busqueda
    public function search()
    {
        // obtiene variables para la vista
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
        //texto buscado
        $text = Input::get('text');
        //categoria buscada
        $category = Input::get('category');

        //busqueda dependiendo los criterios
        if($category == 'TODAS')
        {
            $where =[['descripcion','like',"%$text%"],['precio2','>',0],['estado','=','A'],['stock','>',0]];
        }else{
            $where =[['descripcion','like',"%$text%"],['idcategoria','=',"$category"],['precio2','>',0],['estado','=','A'],['stock','>',0]];
        }

        //resultados de la busqueda
        $productosLike = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where($where)
        ->orWhere([['idproducto','like',"%$text%"],['precio','>',0],['estado','=','A'],['stock','>',0]])
        ->paginate(15);

        $productosLike->appends(array(
            'text'=>$text,
            'category'=>$category,
        ));

        //retorna la vista

        return view('busqueda',['cates'=> $categorias,
        'familias'=>$familias,
        'productosLike'=>$productosLike,
        'buscado'=>$text,
        'imagen'=>$imgweb,
        'texto'=>$textos,
        'parametros' => $parametros
        ]);
    }

    // retorna la vista de busqueda con los items pertenecientes a una categoría
    public function categoria($code)
    {
        // obtiene las variables para la vista
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
        
        // busca los productos de la categoria solicitada
        $result = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([['idcategoria','=',"$code"],['estado','=','A'],['precio2','>',0],['stock','>',0]])
        ->paginate(15);

        // obtiene datos de la categoria buscada
        $codigo_buscado = DB::table('categoria')->where('idcategoria','=',"$code")->first();

        if ($codigo_buscado == null) {
            return redirect()->back()->with('message','Categoría No disponible.');
        } else {
            //retorna la vista de la busquedas
            return view('busqueda',['cates'=>$categorias,
            'familias'=>$familias,
            'productosLike'=>$result,
            'buscado'=>$codigo_buscado->nombre,
            'imagen'=> $imgweb,
            'texto'=>$textos,
            'parametros' => $parametros
            ]);
        }
        
        
        return view('busqueda',['cates'=>$categorias,
        'familias'=>$familias,
        'productosLike'=>$result,
        'buscado'=>$codigo_buscado->nombre,
        'imagen'=> $imgweb,
        'texto'=>$textos,
        'parametros' => $parametros
        ]);

    }

    //retorna la vista de busqueda con los productos de una famila dada
    public function familia($code)
    {
        //obtiene variables para la vista
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
        
        // resultado de los productos
        $result = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([['idfamilia','=',"$code"],['estado','=','A'],['precio2','>',0],['stock','>',0]])
        ->paginate(15);

        //información de la familia
        $codigo_buscado = DB::table('familia')->where('idfamilia','=',"$code")->first();
        //retorno de la vista con los datos
        return view('busqueda',['cates'=>$categorias,
        'familias'=>$familias,
        'productosLike'=>$result,
        'buscado'=>$codigo_buscado->nombre_familia,
        'imagen'=>$imgweb,
        'texto'=>$textos,
        'parametros' => $parametros
        ]);

    }

    // retorna la vista de busqueda en base a un producto determinado
    public function producto($code)
    {
        //busqueda de las variables para la vista
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
        // resultado del los productos
        $result = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([['idfamilia','=',"$code"],['estado','=','A'],['stock','>',0]])
        ->paginate(15);

        //información de la familia
        $codigo_buscado = DB::table('familia')->where('idfamilia','=',"$code")->first();
        // retorno de la vista con información
        return view('busqueda',['cates'=>$categorias,
        'familias'=>$familias,
        'productosLike'=>$result,
        'buscado'=>$codigo_buscado->nombre_familia,
        'imagen'=>$imgweb,
        'texto'=>$textos,
        'parametros' => $parametros
        ]);

    }

    // retorna JSON con datos de un producto por su código y tipo deprecio
    public function modal(Request $request)
    {
            //obtiene el tipo de precio de la session
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

        //busca el producto y lo retorna
        $producto = DB::table('producto')->where('idproducto','=',"$request->code")->first();
        return response()->json($producto);
    }

    // retorna la vista de información detallada de un producto
    public function single($code)
    {
        // busca las variables para la vista
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
        // busqueda de los productos de una categoría de tecnología
        $tecnoNew = DB::table('producto')
        ->orderBy('idproducto','DESC')
        ->where([['precio2','!=',0],['idcategoria','=','C0060'],['stock','>',0]])
        ->take(10)
        ->get();
        //información del producto solicitado
        $producto = DB::table('producto')->where('idproducto','=',"$code")->first();

        if ($producto == null) {
            return redirect()->back()->with('message','');
        } else {
            // retorna la vista con las variables
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
}
