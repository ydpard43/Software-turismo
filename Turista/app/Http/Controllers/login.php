<?php

namespace App\Http\Controllers;
use App\Models\Turista;
use DB;
use Illuminate\Http\Request;
use App\Mail\correos;
use Illuminate\Support\Facades\Mail;

class login extends Controller
{
    public function store()
    {

	 $user=request('name');
	 $pass=request('password');
	 $pass=rtrim(strtr(base64_encode($pass), '+/', '-_'), '=');
	 $consult = DB::table('turista')->where('alias', $user)->first();
	 if($consult){
	 if ($pass==($consult->contrasena)) {
	 	session(['id' => $consult->id_turista]);
	 	session(['nombre' => $consult->prnombre]);
	 	session(['apellido' => $consult->prapellido]);
	 	session(['alias'=>$consult->alias]);
	 	return redirect('/');
	 	
	 }else{
	 	return back()->with('status','Datos no validos');
	 }
	  } else { 
	 	return redirect('/');
	 }
    }
        public function viewpass()
    {
      $email=request('email');
$consult=DB::table('correoturista')
        ->where('id_correoturista', $email)
        ->get();
        return $consult;
    }
    public function cerrar()
{
		session()->forget('id');
	 	session()->forget('nombre');
	 	session()->forget('apellido');
	 	session()->forget('alias');
	 	return view('/iniciar');

}
public function reestablecer()
{
	  $correo= new correos(request('codigo'));
 Mail::to(request('email'))->send($correo);
  return request('codigo');
}

public function cambiar()
{
	      $email=request('email');
$consult=DB::table('correoturista')
        ->where('id_correoturista', $email)
        ->get();
if ($consult) {
	$pass=rtrim(strtr(base64_encode(request('pass')), '+/', '-_'), '=');
	 	$consult2= DB::table('turista')
 				->where('id_turista',$consult[0]->fk_id_turista)
 				->update(['contrasena'=>$pass]);
 				if ($consult2) {
 					return 'Actualizado';
 				}
}

}

}



