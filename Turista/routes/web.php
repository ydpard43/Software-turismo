<?php

use Illuminate\Support\Facades\Route;

Route::view('/','home')->name('home');
Route::view('/crear','crear')->name('crear');
Route::view('/listr','listr')->name('listr');
Route::view('/verr','verr')->name('verr');
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
//Route::view('/nuevar','nuevar')->name('nueva');

Route::get('/perfil','App\Http\Controllers\actua@verp')->name('perfil');
Route::get('/nuevar','App\Http\Controllers\ruta@nuevap1')->name('nuevar');
Route::view('/iniciar','iniciar')->name('iniciar');

Route::get('verp/{id}','App\Http\Controllers\poi@ind')->name('ver');
Route::post('iniciar','App\Http\Controllers\login@store');

Route::get('salir','App\Http\Controllers\login@cerrar')->name('salir');

Route::post('regist','App\Http\Controllers\regis@store');
Route::post('actuap','App\Http\Controllers\actua@store');
Route::post('ap','App\Http\Controllers\actua@actuap')->name('ap');
Route::post('pass','App\Http\Controllers\actua@pass')->name('pass');
Route::post('reepass','App\Http\Controllers\login@viewpass');
Route::post('insertpoi','App\Http\Controllers\poi@opin')->name('insertpoi');
Route::post('aopoi','App\Http\Controllers\poi@opatc')->name('aopoi');
Route::post('nuevar','App\Http\Controllers\ruta@nuevap2');
Route::post('mun','App\Http\Controllers\ruta@nuevap3');
Route::post('map','App\Http\Controllers\ruta@nuevap3b');
Route::post('ecu','App\Http\Controllers\ruta@nuevap4');
Route::post('rutat','App\Http\Controllers\ruta@nuevap5');

Route::get('/pois','App\Http\Controllers\poi@consult')->name('pois');
