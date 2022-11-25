<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Provincia;

class Provincias extends Controller
{
	//registra la provincias 
	public function PostProvincias(Request $request)
	{
		//array para retornar
		$provincias = [];

		foreach ($request->provincias as $key => $value) {

			// verifica la existencia de una provincia con el mismo codigo
			$verify = DB::table('provincia')->where('codigo', '=', $value['codigo'])->count();


			if ($verify == 0) {
				try {
					// crea la instancia y la almacena
					$provi = new Provincia();
					$provi->codigo = $value["codigo"];
					$provi->nombre = $value["nombre"];
					$provi->estado = "A";
					$provi->codigosap = $value["codigosap"];

					$provi->save();
					// agrega al array
					array_push($provincias, ['provincia' => $value['codigo'], 'status' => 'OK']);
				} catch (\Throwable $th) {
					return response()->json($th);
				}
			} else {
				array_push($provincias, ['provincia' => $value['codigo'], 'status' => 'NoSaved']);
			}
		}
		//retorna el array
		return response()->json($provincias);
	}
}
