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
      $pra=request('primera');
      $pas=request('password');
      $email=request('email');
      $sex=request('sexo');
      $alias=request('nomu');
      if ($sex=='-1') {
      return back()->with('status','Seleccione un genero');
      }else if (empty($prn) || empty($pra) || empty($pas) || empty($email) || empty($alias)) {
       return back()->with('status','Por favor rellene todos los campos');
      }
      $ver_alias=Turista::select('alias')
                        ->where('alias',$alias)
                        ->get();
    if (count($ver_alias)>0) {
     return back()->with('status','El nombre de usuario no esta disponible');
    }
      $ver_correo=Turista::select('correo')
                        ->where('correo',$email)
                        ->get();
     if (count($ver_correo)>0) {
     return back()->with('status','El correo no esta disponible');
    }
      if (strlen($pas)<8) {
     return back()->with('status','Error la contraseña debe contener minimo 8 caracteres');
    }
    $minuscula=preg_match('`[a-z]`',$pas);
    $mayuscula=preg_match('`[A-Z]`',$pas);
    $numeros=preg_match('`[0-9]`',$pas);
    if ($mayuscula && $numeros && $minuscula) {
      $consult=Turista::create([
      'prnombre'=> $prn,
      'prapellido'=> $pra,
      'alias'=> $alias,
      'contrasena'=> rtrim(strtr(base64_encode($pas), '+/', '-_'), '='),
      'sexo'=> $sex,
      'imagen'=> 'df.jpg',
      'estado'=> 'true',
      'correo'=> $email
     ]);
     if ($consult) {
     return back()->with('statu','Usuario correctamente registrado');
    }
  }else{
      return back()->with('status','La contraseña debe contener minimo una mayuscula, una minuscula y un numero');
    }}
  

     
    
    }


