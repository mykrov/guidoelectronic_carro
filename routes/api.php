<?php

use Illuminate\Http\Request;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

//use Symfony\Component\Routing\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('pedidos','ApiController@getPedidos')->name('getPedidos');
    Route::get('usuarios/{fecha}','ApiController@getUsuarios')->name('getUsuarios');
    Route::post('categoria','ApiController@addCategoria')->name('addCategoria');
	Route::post('marca','ApiController@addMarca')->name('addMarca');
	Route::post('familia','ApiController@addFamilia')->name('addFamilia');
	Route::post('usuarios','ApiController@addUsuarios')->name('addUsuarios');
	Route::post('productos','ApiController@addProductos')->name('addProductos');
	Route::post('tipocliente','ApiController@clientePrecio')->name('clienteprecio');
	Route::post('provincias','Provincias@PostProvincias')->name('postprovincias');
	Route::post('cantones','Cantones@PostCantones')->name('postcantones');
	Route::post('stock','ApiController@stockProducto')->name('stock');
	Route::post('usersaved','ApiController@sincUser')->name('sink');

});

Route::put('productos','ApiController@updateProductos')->name('updateProductos');
Route::post('actualizarcab','ApiController@updatePedidos')->name('updatePedidos');

//login de API para obtener Token
Route::post('login', 'AuthenticateController@login');

//Activar solo items que tienen imagen en el directorio /public/assets/productos
Route::any('imgenes','Apicontroller@disableItemNoImage')->name('imagesno');

//pagos PlaceTo^Pay
Route::post('ptpnotify','PagosController@Notificacion');

//Consulta de Pagos con estado 
Route::get('consultapagos','PagosController@ProcesoDiario');









