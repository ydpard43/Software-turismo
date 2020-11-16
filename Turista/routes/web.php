<?php

use Illuminate\Support\Facades\Route;

Route::view('/','home')->name('home');
Route::view('/crear','crear')->name('crear');
Route::view('/listr','listr')->name('listr');
Route::view('/verr','verr')->name('verr');
Route::view('/listp','listp')->name('listp');
Route::view('/verp','verp')->name('verp');
Route::view('/regist','regist')->name('regist');
Route::view('/iniciar','iniciar')->name('iniciar');

Route::post('iniciar','App\Http\Controllers\login@store');

