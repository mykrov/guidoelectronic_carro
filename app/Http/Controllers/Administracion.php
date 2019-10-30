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
    public function index(Request $r){

        if (\Session::get('administrator') == null) {
            return view('loginAdmin');
        }else{
            $imagenes = DB::table('seccion_imagen')
            ->join('imagen','id_imagen','=','idimagen')->get();
            
            $imgweb = array();
    
            foreach($imagenes as $item){
                $imgweb[$item->nombre_seccion] = $item->nombre;
            }
                    
            return view('admin',['imagenes'=>$imagenes]);
        }

       
    }

    public function upload(Request $r){

        if (\Session::get('administrator') == null) {
            return view('loginAdmin');
        }else{

            $validation = Validator::make($r->all(),
            [
                'select_file' => 'require|image|mimes:jpg,jpeg,png,gif,ico,|max:500'
            ]);
    
            if($validation->passes()){
                //se obtiene la imagen y seccion del AJAX
                $image = $r->file('imagen');
                $seccion = $r->seccion;
                //se busca a que directorio pertenece
                $secc = \App\Seccion_imagen::where('nombre_seccion',"$seccion")->first();
                $id = $secc->id_imagen;
                $dir = DB::table('imagen')->where('idimagen','=',"$id")->first();
                //se cambia a un nombre random
                $new_name = rand().'.'.$image->getClientOriginalExtension();
                //ubicacion del directorio de destino
                $destino = public_path('/assets/themebasic/images/'.$dir->directorio);
                //guardado
                $image->move($destino,$new_name);
                //nuevo registro de imagen en BD.
                $imgInstance = new Imagen();
                $imgInstance->directorio = $dir->directorio;
                $imgInstance->nombre = $new_name;
                $imgInstance->estado = 'A';
                $imgInstance->save();
                //se actualiza la seccion con nueva imagen
                $secc->id_imagen = $imgInstance->idimagen;
                $secc->save();
    
    
                return response()->json('exito');
    
            }else{
                return response()->json($validation->error()->all());
            }

        }

       

    }

    public function colores(Request $r)
    {
        if (\Session::get('administrator') == null) {
            return view('loginAdmin');
        }else{
            return view();
        }
        

    }

    public function textos(Request $r)
    {
        if (\Session::get('administrator') == null) {
            return view('loginAdmin');
        }else{
             $textos = DB::table('texto')->orderBy('nombre', 'ASC')->get();
            return view('textos',['textos'=>$textos]);
        }
    }

    public function savetext(Request $r)
    {
        $x = $r->all();
        foreach ($x as $key => $value) {
           
            $temp = \App\Texto::where('seccion',"$key")->first();
            $cambio = 0;
            if ($temp->tipo == "text") {
                if($value == "" || $value == null){
                    $value = " ";
                }
                $temp->contenido = $value;
                $temp->save();
                $cambio++;   
            } else {
                if($value == "" || $value == null){
                    $value = " ";
                }
                $temp->parrafo = $value;
                $temp->save();
                $cambio++;
            }
        }
        return response()->json("exito");
    }

    public function login(Request $r){
        return view('loginAdmin');
    }

    public function loginProccess(Request $r){
        
        $email = Input::get('u');
        $pass = Input::get('p');
        
        //return Hash::make($pass);
       
        $user1 = \App\User::where('email', '=', 'salvatorex89@gmail.com')->first();

        if ($user1 === null) {
            return response()->json('no-existe');
        }else{
            //return response()->json($pass);
            $hashEncontrado = $user1->password;
            if (Hash::check($pass, $hashEncontrado)) {
                \Session::forget('administrator');
                \Session::put('administrator',$user1->email);
                return response()->json('logueado');
            } else {
                return response()->json('no-logueado');
            }
        }

       
    
    }

    public function salir()
    {
        \Session::forget('administrator');
   
        return redirect('/');
    }
}


