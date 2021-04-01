<?php

use Illuminate\Support\Facades\Route;
use App\Mail\correos;
use Illuminate\Support\Facades\Mail;
 
Route::view('/crear','crear')->name('crear');
Route::view('/actuap','actuap')->name('actuap');
Route::view('/listp','listp')->name('listp');
Route::view('/reepass','reepass')->name('reepass');
Route::view('/regist','regist')->name('regist');
Route::view('/poiss','poiss')->name('poiss');
Route::view('/actuapass','actuapass')->name('actualizar');
Route::view('/mun','mun')->name('mun');
Route::view('/map','map')->name('map');
Route::view('/ecu','ecu')->name('ecu');
Route::view('/rutat','rutat')->name('rutat');
Route::view('/guardarr','guardarr')->name('guardarr');
Route::view('/guardarrp2','guardarrp2')->name('guardarrp2');


Route::get('/perfil','App\Http\Controllers\actua@verp')->name('perfil');
Route::get('/nuevar','App\Http\Controllers\ruta@nuevap1')->name('nuevar');
Route::get('/posicion','App\Http\Controllers\ruta@localizacion')->name('posicion');
Route::get('/','App\Http\Controllers\ruta@verr')->name('home');

Route::view('/iniciar','iniciar')->name('iniciar');

Route::get('verp/{id}','App\Http\Controllers\poi@ind')->name('ver');
Route::get('detalle/{id}','App\Http\Controllers\ruta@detalle')->name('detalle');
Route::post('iniciar','App\Http\Controllers\login@store');

Route::get('salir','App\Http\Controllers\login@cerrar')->name('salir');

Route::post('regist','App\Http\Controllers\regis@store');
Route::post('actuap','App\Http\Controllers\actua@store');
Route::post('actuat','App\Http\Controllers\ruta@actuat');
Route::post('actuareco','App\Http\Controllers\ruta@actuareco');
Route::post('reset','App\Http\Controllers\ruta@reset');
Route::post('ap','App\Http\Controllers\actua@actuap')->name('ap');
Route::post('actuapass','App\Http\Controllers\actua@actuapc');
Route::post('pass','App\Http\Controllers\actua@pass')->name('pass');
Route::post('reepass','App\Http\Controllers\login@viewpass');
Route::post('insertpoi','App\Http\Controllers\poi@opin')->name('insertpoi');
Route::post('aopoi','App\Http\Controllers\poi@opatc')->name('aopoi');
Route::post('nuevar','App\Http\Controllers\ruta@nuevap2');
Route::post('mun','App\Http\Controllers\ruta@nuevap3');
Route::post('map','App\Http\Controllers\ruta@nuevap3b');
Route::post('ecu','App\Http\Controllers\ruta@nuevap4');
Route::post('rutat','App\Http\Controllers\ruta@nuevap5');
Route::post('/verr','App\Http\Controllers\ruta@verr2')->name('verr');
Route::post('/guardarr','App\Http\Controllers\ruta@nuevap6');
Route::post('/guardarrp2','App\Http\Controllers\ruta@nuevap7');
Route::get('/pois','App\Http\Controllers\poi@consult')->name('pois');
Route::post('correo','App\Http\Controllers\login@reestablecer');
Route::post('cambiar','App\Http\Controllers\login@cambiar');
Route::post('variables','App\Http\Controllers\ruta@variables');
Route::post('factores','App\Http\Controllers\ruta@factores');
Route::post('sites','App\Http\Controllers\ruta@sites');
Route::put('eliminar','App\Http\Controllers\ruta@eliminar');
Route::put('actualiza','App\Http\Controllers\ruta@actualiza');
Route::get('/rutas','App\Http\Controllers\ruta@consult')->name('rutas');
//Route::view('/nuevar','nuevar')->name('nueva');
//Route::get('/verr','App\Http\Controllers\ruta@verr')->name('verr'); 