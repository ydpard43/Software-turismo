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
Route::view('/iniciar','iniciar')->name('iniciar');
Route::get('verp{id}','App\Http\Controllers\poi@ind')->name('ver');
Route::post('iniciar','App\Http\Controllers\login@store');
Route::get('salir','App\Http\Controllers\login@cerrar')->name('salir');
Route::post('regist','App\Http\Controllers\regis@store');
Route::post('actuap','App\Http\Controllers\actua@store');
Route::post('reepass','App\Http\Controllers\login@viewpass');
Route::post('insertpoi','App\Http\Controllers\poi@opin')->name('insertpoi');
Route::post('aopoi','App\Http\Controllers\poi@opatc')->name('aopoi');


Route::get('/pois','App\Http\Controllers\poi@consult')->name('pois');
