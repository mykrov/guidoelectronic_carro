<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Canton;

class Cantones extends Controller
{
	// recibe lista de cantones para almacenarlos 
    public function PostCantones(Request $request){
   		$cantones = [];

   		foreach ($request->cantones as $key => $value) {
	   		//verifica el si existe un registro del mismo código 
	        $verify = DB::table('canton')->where('codigo','=',$value['codigo'])->count();	      

	        if ($verify == 0) {
	            try {
					//crea y graba canton
	                $canton = new Canton();
	                $canton->codigo = $value["codigo"];
	                $canton->provincia = $value["provincia"];
	                $canton->nombre = $value["nombre"];
	                $canton->estado = "A";
	             	$canton->CODIGOSAP = $value["CODIGOSAP"];
	                $canton->save();
	                array_push($cantones,['cantones'=>$value['codigo'],'status'=>'OK']);
	            } catch (\Throwable $th) {
	                return response()->json($th);
	            }  
	        } else {
	            array_push($cantones,['cantones'=>$value['codigo'],'status'=>'NoSaved']);
	        }  
       }
	   // retorna los resultados
       return response()->json($cantones);
   }

   // obtiene la lista de cantones dependiendo la provincia
   public function getCantones(Request $request){

   	$provincia = $request->provincia;
   	$cantones = DB::table('canton')->where('provincia','=',	$provincia)->get();
   	return response()->json($cantones);

   }
}
