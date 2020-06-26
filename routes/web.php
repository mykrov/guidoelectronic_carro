<?php

Route::get('/','IndexController@index')->name('index');
Route::get('/nosotros','IndexController@nosotros')->name('nosotros');
Route::get('/contacto','IndexController@contacto')->name('contacto');
Route::get('/cuenta','IndexController@cuenta')->name('cuenta');
Route::post('/detallePed','IndexController@detPedidos')->name('detalleped');
Route::get('/guiacompra','IndexController@howbuy')->name('guiacompra');
Route::get('/tarifas','IndexController@tarifas')->name('tarifas');
Route::get('/politicas','IndexController@politicas')->name('politicas');
//Rutas de Login
Route::get('/login','LoginController@index')->name('login');
Route::post('/login','LoginController@login')->name('login-process');
Route::any('/logout','LoginController@logout')->name('logout');
Route::post('/register','LoginController@register')->name('register');
Route::get('/activar/{ruc}','LoginController@activar')->name('activar_usuario');
Route::post('/consultar','LoginController@consultarADM')->name('consultarADM');
Route::post('/setdata','LoginController@setearDatos')->name('seteo-data');
Route::post('/recuperar','LoginController@recuperaPass')->name('recuperar');
Route::get('/resetpass/{id}','LoginController@resetIndex')->name('reset-index');
Route::post('/reset','LoginController@resetProcess')->name('reset');
//Rutas de Busquedas
Route::any('/search','SearchController@search')->name('search');
Route::get('categoria/{code}','SearchController@categoria')->name('categoria-search');
Route::get('familia/{code}','SearchController@familia')->name('familia-search');
//Route::get('producto/{code}','SearchController@producto')->name('producto-search');
Route::post('/modal','SearchController@modal')->name('modal');
Route::get('single/{code}','SearchController@single')->name('single-product');
//Operaciones en el carro
Route::post('/carro-add','CarroController@add')->name('carro-add');
Route::post('/vaciar-carro','CarroController@empty_car')->name('carro-empty');
Route::post('/eliminar-item','CarroController@delete_item')->name('delete-item');
Route::get('/checkout','CarroController@checkout')->name('checkout');
Route::get('/carro','Checkout@carro')->name('carro');
Route::post('/change-cant','CarroController@change_cant')->name('change-cant');
Route::post('/realizar-compra','CarroController@pedido')->name('pedido');

//Administracion
Route::get('/admin1','Administracion@index')->name('admin');
Route::post('/upload','Administracion@upload')->name('file-upload');
Route::get('/colors','Administracion@colores')->name('colores');
Route::get('/textos','Administracion@textos')->name('textos');
Route::post('/text-save','Administracion@savetext')->name('text-save');
Route::post('/login-admin','Administracion@loginProccess')->name('loginAdmin');
Route::any('/salir','Administracion@salir')->name('salir');

Route::get('getCantones','Cantones@getCantones')->name('getcantones');


//Pagos PlaceToPay
Route::get('/pagoptp','PagosController@GeneraPago')->name('pagoptp');
Route::get('/pagocon','PagosController@ConsultaPagoInterno')->name('consultapago');



