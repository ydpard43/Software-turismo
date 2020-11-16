<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class login extends Controller
{
    public function store()
    {
     request()->validate([
		'name' =>'required|min:6',
		'password' =>'required|min:12'
     ]);
    }
}



