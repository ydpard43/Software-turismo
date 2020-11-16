@extends('status')
@section('title','Iniciar sesion')

@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-4">Mi Ruta</span>
        <br>
        <img id="profile-img" class="profile-img-card" src="https://quesignificado.com/wp-content/uploads/2018/11/turista-992x661.jpg" />
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" action="{{route('home')}}" method="POST">
            @csrf
        <span id="reauth-email" class="reauth-email"></span>
        <input type="text" id="inputusuario" class="form-control" placeholder="Usuario" required autofocus>

        <input type="password" id="inputcontrasena" class="form-control" placeholder="Contraseña" required>
        <a href="#" class="center-block">Has olvidado tu contraseña</a>
            <br>
            <br>
         <button class="mx-auto btn btn-primary" style="padding-left: 8%"  type="submit">Iniciar sesion</button>
         <br>
         <br>
          <a href="#" class="text-center">Registrarse</a>
            </form>
    </div>
</div>
@endsection