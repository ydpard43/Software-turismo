<?php

namespace App\Http\Controllers;
use App\Models\Turista;
use App\Models\Correo;
use Image;
use Illuminate\Http\Request;

class regis extends Controller
{
 //	$prueba=Rol::orderBy('id_rol','DESC')->get();
   //   return ''.$prueba['0']->id_rol;

        public function store(){
$img_user= $_FILES["img"]["name"];
$ruta=$_FILES["img"]["tmp_name"];
$destino="img/".$img_user;
copy($ruta,$destino);
       $prn=request('primern');
       $sgn=request('segundon');
       $pra=request('primera');
      $sga=request('segunda');
      $pas=request('password');
      $email=request('email');
      $sex='1';
      $img=$destino;
     $est='1';

     Turista::create([
     	'prnombre'=> $prn,
     	'sgnombre'=> $sgn,
      'prapellido'=> $pra,
     	'sgapellido'=> $sga,
     	'alias'=> request('nomu'),
     	'contrasena'=> rtrim(strtr(base64_encode($pas), '+/', '-_'), '='),
     	'sexo'=> $sex,
     	'imagen'=> $img,
     	'estado'=> $est
     ]);
     $user=Turista::all();
     $last=$user->last();
     $last=$last->id_turista;
     Correo::create([
      'fk_id_turista' => $last,
      'id_correoturista' => $email,
      'estado' =>$est

     ]);

    return back()->with('status','Usuario correctamente registrado');
    }

}
