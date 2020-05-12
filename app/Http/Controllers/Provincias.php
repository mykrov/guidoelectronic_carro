<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Provincia;	

class Provincias extends Controller
{
   public function PostProvincias(Request $request){
   		$provincias = [];

   		foreach ($request->provincias as $key => $value) {

	   		//return response()->json(count($request->provincias));
	   		//return response()->json($value['codigo']);

	        $verify = DB::table('provincia')->where('codigo','=',$value['codigo'])->count();
	      

	        if ($verify == 0) {
	            try {
	                $provi = new Provincia();
	                $provi->codigo = $value["codigo"];
	                $provi->nombre = $value["nombre"];
	                $provi->estado = "A";
	             	$provi->codigosap = $value["codigosap"];
	             	
	                $provi->save();
	                array_push($provincias,['provincia'=>$value['codigo'],'status'=>'OK']);
	            } catch (\Throwable $th) {
	                return response()->json($th);
	            }  
	        } else {
	            array_push($provincias,['provincia'=>$value['codigo'],'status'=>'NoSaved']);
	        }  
       }
       return response()->json($provincias);
   }
}
