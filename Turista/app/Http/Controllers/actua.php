<?php

namespace App\Http\Controllers;
use App\Models\Turista;
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
  if (empty($prn) || empty($sgn) || empty($pra) || empty($sga) || empty($email)) {
       return back()->with('status','Por favor rellene todos los campos');
      }
    $ver_alias=Turista::select('alias')
                      ->where('alias',$alias)
                      ->whereNotIn('id_turista',[session('id')])
                      ->get();
    if (count($ver_alias)>0) {
     return back()->with('status','El nombre de usuario no esta disponible');
    }
    $ver_correo=Turista::select('correo')
                        ->where('correo',$email)
                        ->whereNotIn('id_turista',[session('id')])
                        ->get();
     if (count($ver_correo)>0) {
     return back()->with('status','El correo no esta disponible');
    }
 
 	$consult= Turista::where('id_turista',session('id'))
 				             ->update(['alias'=>$alias,
 					                      'prnombre'=>$prn,
 					                      'sgnombre'=>$sgn,
 					                      'prapellido'=>$pra,
 					                      'sgapellido'=>$sga,
 					                      'sexo'=>$sexo,
 					                      'imagen'=>$img,
 					                      'correo'=>$email
 				]);
                     if ($consult) {
                       return back()->with('status','Usuario actualizado correctamente');
                     }
 				
 }
  public function actuapc()
 {
 	$p=request('pass');
 	$p2=request('pass2');
 	$consult= DB::table('turista')->where('id_turista', session('id'))->first();
      $minuscula=preg_match('`[a-z]`',$pas2);
    $mayuscula=preg_match('`[A-Z]`',$pas2);
    $numeros=preg_match('`[0-9]`',$pas2);
    if (!($mayuscula) && !($numeros) && !($minuscula)) {
      return back()->with('status','La contraseña debe contener minimo una mayuscula, una minuscula y un numero');
    }
    if (strlen($pas)<8) {
     return back()->with('status','Error la contraseña debe contener minimo 8 caracteres');
    }
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
