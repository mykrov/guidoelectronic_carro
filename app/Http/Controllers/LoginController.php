<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Usuario;
use App\Provincias;
use App\Cantones;
use PHPUnit\Util\Json;
use App\Mail\RegistroUsuario;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;
use App\Mail\RecuperarPass;


class LoginController extends Controller
{
    // retorna la vista de login de la web
    public function index()
    {
        //obtiene las variables de la vista
        $provincias = DB::select(DB::raw('SELECT * FROM provincia where codigo in (select provincia from canton)'));

        $categorias = DB::table('categoria')->where('estado', '=', 'A')->get();
        $familias = DB::table('familia')->get();
        $textos = DB::table('texto')->get();
        $parametro = DB::table('parametros')->where('idparametro', '=', 1)->first();
        $imagenes = DB::table('seccion_imagen')
            ->join('imagen', 'id_imagen', '=', 'idimagen')->get();

        $imgweb = array();

        foreach ($imagenes as $item) {
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        //retorna la vista
        return view('login', ['cates' => $categorias, 'familias' => $familias, 'imagen' => $imgweb, 'texto' => $textos, 'parametros' => $parametro, 'provincias' => $provincias]);
    }

    // procesa el login de un usuario
    public function login()
    {
        // obtiene las variables de la petición
        $email = Input::get('email');
        $pass = Input::get('password');
        // consulta el usuario
        $consulta = DB::table('usuario')->where([['correo', '=', "$email"], ['contrasenia', '=', "$pass"], ['activacion', '=', 'habilitar']])->get();
        $contador = $consulta->count();

        if ($contador > 0) {
            // si existe, borra datos de la session y los establece con el usuario 
            // que se loguea
            \Session::forget('usuario-nombre');
            \Session::put('usuario-nombre', $consulta[0]->correo);
            \Session::forget('usuario-id');
            \Session::put('usuario-id', $consulta[0]->idusuario);
            \Session::forget('usuario-tipo');
            \Session::put('usuario-tipo', 'CTB' /*$consulta[0]->idtipo*/);
            \Session::forget('identificacion');
            \Session::put('identificacion', $consulta[0]->numero_identificacion);
            // retorna la respuesta    
            return response()->json([
                'logueado'
            ]);
        } else {

            return response()->json([
                'no_logueado'
            ]);
        }
    }

    // borra los datos de la session para desloguear al usuario
    // y retorna a la pagina principal
    public function logout()
    {
        \Session::forget('usuario-nombre');
        \Session::forget('usuario-id');
        \Session::forget('usuario-tipo');
        \Session::forget('carro');
        return redirect('/');
    }

    // registra un usuario en la plataforma
    public function register(Request $request)
    {

        //valida los campos
        if (
            $request->num_id != null
            && $request->email != null
            && $request->name != null
            && $request->lastname != null
            && $request->password != null
            && $request->dir1 != null
            && $request->pais != null
            && $request->ciudad != null
            && $request->canton != null
            && $request->tlf1 != null
        ) {

            //verificar en caso de ser RUC
            if (strlen($request->num_id) == 13) {

                $numeR = $request->num_id;
                // valida usando libreria
                $validar = new \App\ValidarIdentificacion();
                if ($validar->validarRucSociedadPrivada($numeR) || $validar->validarRucPersonaNatural($numeR) || $validar->validarRucSociedadPublica($numeR)) {
                } else {
                    return response()->json("ruc_invalido");
                }
            }

            // verificar que no exista un ruc igual
            $consulta = DB::table('usuario')->where([['numero_identificacion', '=', "$request->num_id"]])->get();

            if ($consulta->count() > 0) {

                return response()->json("ruc_registrado");
            } else {

                // crear usuario y lo guarda
                $usuario = new Usuario();
                $hoy = date("d-m-Y");

                $usuario->activacion = "inhabilitado";
                $usuario->nombre = strtoupper($request->name);
                $usuario->apellido = strtoupper($request->lastname);
                $usuario->correo = $request->email;
                $usuario->contrasenia = $request->password;
                $usuario->identificacion = $request->id_type;
                $usuario->numero_identificacion = $request->num_id;
                $usuario->direccion = $request->dir1;
                $usuario->referencia = $request->dir2;
                $usuario->pais = $request->pais;
                $usuario->ciudad = $request->ciudad;
                $usuario->codigo_postal = $request->cod_pos;
                $usuario->celular1 = $request->tlf1;
                $usuario->celular2 = $request->tlf2;
                $usuario->imagen = "no";
                $usuario->img_servicios = "no";
                $usuario->img_representante = "no";
                $usuario->img_cedula = "no";
                $usuario->empresa = $request->nombre_empre;
                $usuario->ruc = $request->ruc_empre;
                $usuario->idtipo = "CTA";
                $usuario->ingreso = $hoy;
                $usuario->canton = $request->canton;
                $usuario->sincronizado = 'N';
                $usuario->save();

                // envio de email al usuario
                \Mail::to($usuario->correo)->send(new RegistroUsuario($usuario));
                return response()->json("registrado");
            }
        } else {
            return response()->json("campos_vacios");
        }
    }

    //activa un usuario por su identificación
    public function activar($ruc)
    {
        $user1 = DB::table('usuario')->where('numero_identificacion', '=', "$ruc")->first();
        $user = Usuario::find($user1->idusuario);
        $user->activacion = 'habilitar';
        $user->save();
        return redirect('/login');
    }

    // Test no implementado para consultar datos de un cliente por el numero de identificación
    public function consultarADM(Request $num)
    {
        if ($num->identi != null) {
            $user1 = DB::table('usuario')->where('numero_identificacion', '=', "$num->identi")->count();
            if ($user1 == 1) {
                $user2 = DB::table('usuario')->where('numero_identificacion', '=', "$num->identi")->first();

                if ($user2->contrasenia == "" or $user2->contrasenia == null) {
                    return response()->json(["res" => "encontrado", "dato" => $user2->nombre]);
                } else {

                    return response()->json(["res" => "encontrado-condatos", "dato" => $user2->correo]);
                }
            } else {
                return response()->json(["res" => "no-encontrado", "dato" => "0"]);
            }
        } else {
            return response()->json("parametro-vacio");
        }
    }



    // configura datos de un usario
    public function setearDatos(Request $r)
    {
        //optiene los campos de request
        $ruc = $r->ruc;
        $email = $r->email;
        $pass = $r->contrasena;

        //verifica ruc
        $user1 = DB::table('usuario')->where('numero_identificacion', '=', "$ruc")->count();
        //verifica email
        $chekEmail = DB::table('usuario')->where('correo', '=', "$email")->count();

        //verifica y envia email
        if ($chekEmail == 0) {
            if ($user1 == 1) {
                $user2 = \App\Usuario::where('numero_identificacion', "$ruc")->first();
                $user2->contrasenia = $pass;
                $user2->correo = $email;
                $user2->activacion = "inhabilitado";
                $user2->save();
                \Mail::to($email)->send(new RegistroUsuario($user2));
                return response()->json(["res" => "actualizado", "dato" => "$email"]);
            } else {
                return response()->json(["res" => "no-actualizado", "dato" => "no"]);
            }
        } else {
            return response()->json(["res" => "email-utilizado", "dato" => "no"]);
        }
    }


    // envia email para recuperar contraseña de cuenta relacionada a email
    public function recuperaPass(Request $r)
    {
        $email = $r->email;        
        if ($email != null) {
            //verifica que exista el usuario con ese email
            $user1 = DB::table('usuario')->where('correo', '=', "$email")->count();
            if ($user1 == 1) {
                //busca data del usuario y envia correo con el id encriptado
                $user2 = DB::table('usuario')->where('correo', '=', "$email")->first();
                $userInstance = \App\Usuario::where('correo', "$email")->first();
                $idEn = Crypt::encryptString($user2->idusuario);
                $desencriptado = Crypt::decryptString($idEn);
                $link = url('/') . "/resetpass/" . $idEn;
                \Mail::to($email)->send(new RecuperarPass($link, $userInstance));

                return response()->json(['res' => "process-open"]);
            } else {
                return response()->json(['res' => "no-finded"]);
            }
        } else {
            return response()->json("email-nulo");
        }
    }

    //retorna la vista de reseteo de contraseña
    public function resetIndex($id)
    {
        // desencripta el id del usuario
        $desencryp = Crypt::decryptString($id);
        //busca el usuario
        $user = DB::table('usuario')->where('idusuario', '=', "$desencryp")->first();
        //obtiene las variables para la vista
        $categorias = DB::table('categoria')->where('estado', '=', 'A')->get();
        $familias = DB::table('familia')->get();
        $ruc = $user->numero_identificacion;
        $textos = DB::table('texto')->get();
        $parametro = DB::table('parametros')->where('idparametro', '=', 1)->first();
        $imagenes = DB::table('seccion_imagen')
            ->join('imagen', 'id_imagen', '=', 'idimagen')->get();

        $imgweb = array();

        foreach ($imagenes as $item) {
            $imgweb[$item->nombre_seccion] = $item->nombre;
        }
        // retorna la vista
        return view('resetPassword', ['cates' => $categorias, 'familias' => $familias, 'usuario' => $user, 'ruc' => $ruc, 'texto' => $textos, 'imagen' => $imgweb, 'parametros' => $parametro]);
    }

    //resetea la contraseña
    public function resetProcess(Request $r)
    {
        //busca  usuario setea contaseña y guarda
        $user = \App\Usuario::where('numero_identificacion', "$r->ruc")->first();
        $user->contrasenia = $r->pass;
        $user->save();
        return response()->json(["res" => "actualizado"]);
    }
}
