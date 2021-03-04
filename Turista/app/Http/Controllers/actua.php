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
 			return view('verpp')->with('turista',$consult);
 		}else{
 			return back();
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
    $img_user= $_FILES["img"]["name"];
$ruta=$_FILES["img"]["tmp_name"];
$destino="img/".$img_user;
if (!empty($ruta)) {
	copy($ruta,$destino);
	$img=$img_user;
}else{
  $img='df.jpg';
}

 
 	$consult= DB::table('turista')
 				->where('id_turista',session('id'))
 				->update(['alias'=>$alias,
 					'prnombre'=>$prn,
 					'sgnombre'=>$sgn,
 					'prapellido'=>$pra,
 					'sgapellido'=>$sga,
 					'sexo'=>$sexo,
 					'imagen'=>$img,
 					'correo'=>$email
 				]);
 				return back()->with('status','Usuario actualizado correctamente');
 }
  public function actuapc()
 {
 	$p=request('pass');
 	$p2=request('pass2');
 	$consult= DB::table('turista')->where('id_turista', session('id'))->first();
 	$pass=rtrim(strtr(base64_encode($p), '+/', '-_'), '=');
 	$pass2=rtrim(strtr(base64_encode($p2), '+/', '-_'), '=');
 	if ($consult->contrasena==$pass) {
 		$consult= DB::table('turista')
 				->where('id_turista',session('id'))
 				->update(['contrasena'=>$pass2
 				]);
 				return back()->with('status','Usuario actualizado correctamente');
 	}else{
 		return back()->with('status','La contraseña actual no es valida');
 	}
 }
}
