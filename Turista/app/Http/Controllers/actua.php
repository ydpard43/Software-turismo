<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class actua extends Controller
{
 public function verp()
 {
 	if(session()->has('id')){
 		$consult= DB::table('turista')->where('id_turista', session('id'))->first();
 		$consult2= DB::table('correoturista')->select('id_correoturista')->where('fk_id_turista',session('id'))->get();
 			return view('verpp')->with('turista',$consult)->with('correo',$consult2);
 		}else{
 			echo "Que hace por aca";
 		}
 }
 public function actuap()
 {
 	$prn=request('primern');
    $sgn=request('segundon');
    $pra=request('primera');
    $sga=request('segunda');
    $email=request('email');
    $alias=request('nomu');
    $sexo=request('sexo');
 	$consult= DB::table('turista')
 				->where('id_turista',session('id'))
 				->update(['alias'=>$alias,
 					'prnombre'=>$prn,
 					'sgnombre'=>$sgn,
 					'prapellido'=>$pra,
 					'sgapellido'=>$sga,
 					'sexo'=>$sexo,
 					'imagen'=>'df.jpg'
 				]);
 				return back()->with('status','Usuario actualizado correctamente');
 }
  public function actuapc()
 {
 	echo "contraseña";
 }
}
