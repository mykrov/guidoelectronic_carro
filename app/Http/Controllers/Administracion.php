<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Validator;
use App\Imagen;
use App\Texto;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class Administracion extends Controller
{
    //retorna la vista de admin con las variables necesarias
    public function index(Request $r)
    {
        // verifica que exista la session administrador
        if (\Session::get('administrator') == null) {
            return view('loginAdmin');
        } else {
            //busca las imageness
            $imagenes = DB::table('seccion_imagen')
                ->join('imagen', 'id_imagen', '=', 'idimagen')->get();

            $imgweb = array();

            foreach ($imagenes as $item) {
                $imgweb[$item->nombre_seccion] = $item->nombre;
            }
            // retorna la vista con las variables
            return view('admin', ['imagenes' => $imagenes]);
        }
    }

    // maneja la actualización de las imagenes del sitio
    public function upload(Request $r)
    {
        // verifica la session del administrador
        if (\Session::get('administrator') == null) {
            return view('loginAdmin');
        } else {

            //valida el archivo
            $validation = Validator::make(
                $r->all(),
                [
                    'select_file' => 'require|image|mimes:jpg,jpeg,png,gif,ico,|max:500'
                ]
            );

            if ($validation->passes()) {
                //se obtiene la imagen y seccion del AJAX
                $image = $r->file('imagen');
                $seccion = $r->seccion;
                //se busca a que directorio pertenece
                $secc = \App\Seccion_imagen::where('nombre_seccion', "$seccion")->first();
                $id = $secc->id_imagen;
                $dir = DB::table('imagen')->where('idimagen', '=', "$id")->first();
                //se cambia a un nombre random
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                //ubicación del directorio destino
                $destino = public_path('/assets/themebasic/images/' . $dir->directorio);
                //guardado
                $image->move($destino, $new_name);
                //nuevo registro de imagen en BD.
                $imgInstance = new Imagen();
                $imgInstance->directorio = $dir->directorio;
                $imgInstance->nombre = $new_name;
                $imgInstance->estado = 'A';
                $imgInstance->save();
                //se actualiza la seccion con nueva imagen
                $secc->id_imagen = $imgInstance->idimagen;
                $secc->save();
                //retorna exito
                return response()->json('exito');
            } else {
                return response()->json($validation->error()->all());
            }
        }
    }

    //vista no implementada
    public function colores(Request $r)
    {
        if (\Session::get('administrator') == null) {
            return view('loginAdmin');
        } else {
            return view();
        }
    }

    // retorna vista con los textos de la empresa almacenados en la base
    public function textos(Request $r)
    {
        if (\Session::get('administrator') == null) {
            return view('loginAdmin');
        } else {
            $textos = DB::table('texto')->orderBy('nombre', 'ASC')->get();
            return view('textos', ['textos' => $textos]);
        }
    }

    //actualiza los textos que se muestran en la web
    public function savetext(Request $r)
    {
        // obtiene todos los textos
        $x = $r->all();
        // recorre los textos
        foreach ($x as $key => $value) {
            //busca el texto que coincide con la seccion
            $temp = \App\Texto::where('seccion', "$key")->first();
            $cambio = 0;

            //cuando el tipo de seccion es text
            if ($temp->tipo == "text") {
                //evalua si está nulo o vacio
                if ($value == "" || $value == null) {
                    $value = " ";
                }
                // graba el cambio
                $temp->contenido = $value;
                $temp->save();
                $cambio++;
            } else {
                // se actualiza la columna parrafo
                if ($value == "" || $value == null) {
                    $value = " ";
                }
                $temp->parrafo = $value;
                $temp->save();
                $cambio++;
            }
        }
        return response()->json("exito");
    }

    // retorna la vista para el login de la administración
    public function login(Request $r)
    {
        return view('loginAdmin');
    }

    // procesa el login de la administración y retorna JSON
    public function loginProccess(Request $r)
    {
        // obtiene los campos del request
        $email = Input::get('u');
        $pass = Input::get('p');
        // consulta si existe usuario
        $user1 = \App\User::where('email', '=', $email)->first();

        if ($user1 === null) {
            return response()->json('no-existe');
        } else {
            // chequea el password con el hash almacenado, y setea la 
            // session de administrador en caso de ser exitoso.
            $hashEncontrado = $user1->password;
            if (Hash::check($pass, $hashEncontrado)) {
                \Session::forget('administrator');
                \Session::put('administrator', $user1->email);
                //retorna el resultado
                return response()->json('logueado');
            } else {
                return response()->json('no-logueado');
            }
        }
    }

    // borra la session del administrador y redirecciona al inicio
    public function salir()
    {
        \Session::forget('administrator');
        return redirect('/');
    }
}
