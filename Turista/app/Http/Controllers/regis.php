<?php

namespace App\Http\Controllers;
use App\Models\Turista;
use App\Models\Correo;
use Image;
use Illuminate\Http\Request;

class regis extends Controller
{
  public function store(){
       $prn=request('primern');
       $sgn=request('segundon');
       $pra=request('primera');
      $sga=request('segunda');
      $pas=request('password');
      $email=request('email');
      $sex=request('sexo');
      if (request('sexo')=='-1') {
      return back()->with('status','Seleccione un genero');
      }else if (empty($prn) || empty($sgn) || empty($pra) || empty($sga) || empty($pas) || empty($email)) {
       return back()->with('status','Por favor rellene todos los campos');
      }
     Turista::create([
     	'prnombre'=> $prn,
     	'sgnombre'=> $sgn,
      'prapellido'=> $pra,
     	'sgapellido'=> $sga,
     	'alias'=> request('nomu'),
     	'contrasena'=> rtrim(strtr(base64_encode($pas), '+/', '-_'), '='),
     	'sexo'=> $sex,
     	'imagen'=> 'df.jpg',
     	'estado'=> $est,
      'correo'=> $email
     ]);
    return back()->with('statu','Usuario correctamente registrado');
    }

}
