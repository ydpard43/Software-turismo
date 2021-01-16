<?php

namespace App\Http\Controllers;
use App\Models\Turista;
use DB;
use Illuminate\Http\Request;

class login extends Controller
{
    public function store()
    {

	 $user=request('name');
	 $pass=request('password');
	 $pass=rtrim(strtr(base64_encode($pass), '+/', '-_'), '=');
	 $consult = DB::table('turista')->where('alias', $user)->first();
     var_dump($pass);
	 var_dump($consult->contrasena);
	 if($consult){
	 if ($pass==($consult->contrasena)) {
	 	session(['id' => $consult->id_turista]);
	 	session(['nombre' => $consult->prnombre]);
	 	session(['apellido' => $consult->prapellido]);
	 	session(['alias'=>$consult->alias]);
	 	return redirect('/');
	 	
	 } } else { 
	 	echo "usuario erroneo";
	 }
    }
        public function viewpass()
    {
      $email=request('email');
Return Turista::select('turista.password')
        ->where('correoturista.idcorreoadministrador', $email)
        ->first();
        	//return back()->with('reestablecer','1');
    }
    public function cerrar()
{
		session()->forget('id');
	 	session()->forget('nombre');
	 	session()->forget('apellido');
	 	session()->forget('alias');
	 	return view('/iniciar');

}

}



