@php
if ((session()->has('nombre'))) {
return redirect()->to('/')->send();
}
@endphp
@extends('status')
@section('title','iniciar')
@section('content')
<div class="mx-auto container2">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-4">Mi Ruta</span>
        <br>
        <img id="profile-img" class="profile-img-card" src="{!!asset('img/turista.png')!!}" />
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" action="{{route('iniciar')}}" method="POST">
            @csrf
        <span id="reauth-email" class="reauth-email"></span>
        <input type="text"style="width: 100%;"  name="name"id="inputusuario"  value="{{old('user')}}" placeholder="Usuario"  >
        {!!$errors->first('name','<span>:message</span>')!!}

        <input type="password" style="width: 100%;" name="password" id="inputcontrasena"  value="{{old('pass')}}" placeholder="Contraseña" >
         {{$errors->first('password')}}
         <div class="login">
        <a href="reepass" class="forgot">¿Has olvidado tu contraseña?</a>
               </div>
          <div class="login">
         <button class="btn btn-primary" style="display: block;" type="submit">Iniciar sesion</button>
           </div>
                <div class="login">
          <a href="{{route('regist')}}" class="text-center">Registrarse</a>
          </div>
            </form>
    </div>
</div>
@endsection