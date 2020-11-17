@extends('status')
@section('title','iniciar')

@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-4">Mi Ruta</span>
        <br>
        <img id="profile-img" class="profile-img-card" src="https://quesignificado.com/wp-content/uploads/2018/11/turista-992x661.jpg" />
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" action="{{route('iniciar')}}" method="POST">
            @csrf
        <span id="reauth-email" class="reauth-email"></span>
        <input type="text" name="name"id="inputusuario" class="form-control" value="{{old('user')}}" placeholder="Usuario"  >
        {!!$errors->first('name','<span>:message</span>')!!}

        <input type="password" name="password" id="inputcontrasena" class="form-control" value="{{old('pass')}}" placeholder="Contraseña" >
         {{$errors->first('password')}}
        <a href="reepass" class="center-block">Has olvidado tu contraseña</a>
            <br>
            <br>
         <button class="mx-auto btn btn-primary" style="padding-left: 8%"  type="submit">Iniciar sesion</button>
         <br>
         <br>
          <a href="{{route('regist')}}" class="text-center">Registrarse</a>
            </form>
    </div>
</div>
@endsection