<?php

namespace App\Http\Controllers;
use App\Models\Turista;
use DB;
use Illuminate\Http\Request;

class login extends Controller
{
    public function store()
    {
     request()->validate([
		'name' =>'required|min:1',
		'password' =>'required|min:1'
     ]);
	 $user=request('name');
	 $pass=request('password');
	 $pass=rtrim(strtr(base64_encode($pass), '+/', '-_'), '=');
	 $consult = DB::table('turista')->where('alias', $user)->first();
	 if ($pass==($consult->contrasena)) {
	 	session(['id' => $consult->id_turista]);
	 	session(['nombre' => $consult->prnombre]);
	 	session(['apellido' => $consult->prapellido]);
	 	return redirect('/');
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

}



