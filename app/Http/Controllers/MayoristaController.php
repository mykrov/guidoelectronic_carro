<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Usuario;
use Validator;
use App\Provincias;
use App\Cantones;
use PHPUnit\Util\Json;
use App\Mail\RegistroUsuario;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;
use App\Mail\RecuperarPass;
use Illuminate\Support\Facades\Mail;

class MayoristaController extends Controller
{
    public function RegistroIndex()
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

        return view('mayoristareg',['cates'=>$categorias,'familias'=>$familias,'imagen'=>$imgweb,'texto'=>$textos,'parametros'=>$parametro,'provincias'=>$provincias]);
        
    }

    public function GuardarRegistro(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'file_id' => 'required|image|mimes:jpeg,jpg|max:2048',
            'papeleta_id' => 'required|image|mimes:jpeg,jpg|max:2048',
            'recibo_id' => 'required|image|mimes:jpeg,jpg|max:2048',
            'email' => 'required',
            'num_id' => 'required',
            'tlf1' => 'required'
        ]);

        if($validation->passes()){
            $nombre = $request->name;
            $apellido = $request->lastname;
            $ruc = $request->num_id;
            $imageID = $request->file('file_id');
            $imageRecibo = $request->file('recibo_id');
            $imagePapeleta = $request->file('papeleta_id');

            $new_name = 'Cedula-'. $ruc . '.' . $imageID->getClientOriginalExtension();
            $new_name2 = 'Recibo-'. $ruc . '.' . $imageRecibo->getClientOriginalExtension();
            $new_name3 = 'Papeleta-'. $ruc . '.' . $imageRecibo->getClientOriginalExtension();
            $imageID->move(storage_path('mayoristas'), $new_name);
            $imagePapeleta->move(storage_path('mayoristas'), $new_name2);
            $imageRecibo->move(storage_path('mayoristas'), $new_name3);

            $datos = [
                'email'=>$request->email,
                'nombre'=> $request->name,
                'apellido'=> $request->lastname,
                'ruc'=> $request->num_id,
                'tlf1'=>$request->tlf1,
                'tlf2'=>$request->tlf2,
                'dir' =>$request->dir1,
                'dir2'=>$request->dir2,
                'repre'=>$request->nombrerepre,
                'idrepre'=>$request->num_id_repre

            ];
    
            try {
                Mail::send('email.mayoristare', ['datos'=>$datos], function ($mail) use ($new_name,$new_name2,$new_name3) {
                    $mail->from('mrangel@birobid.com', 'Petición de Mayorista');
                    $mail->to('salvatorex89@gmail.com');
                    $mail->subject('Petición de Usuario Mayorista');
                    $mail->attach(storage_path('mayoristas').'\\'.$new_name);
                    $mail->attach(storage_path('mayoristas').'\\'.$new_name2);
                    $mail->attach(storage_path('mayoristas').'\\'.$new_name3);
                });
            } catch (\Exception $e) {
                return response()->json(["error"=>["Error envio mail:"=>$e->getMessage()]]);
            }

            return response()->json(['estado'=>'enviado']);
        }
        else{
            return response()->json([
            'message'   => $validation->errors()->all(),
            'uploaded_image' => '',
            'class_name'  => 'alert-danger'
            ]);
        }
    }  
}
