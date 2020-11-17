@extends('status')
@section('title','Cambiar contraseña')

@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-4">Reestablecer contraseña</span>
        <br>
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" action="{{route('actuap')}}" method="POST">
            @csrf
        <input type="text" name="primern"id="inputusuario" class="form-control" value="{{old('user')}}" placeholder="Nueva contraseña"  >
        {!!$errors->first('name','<span>:message</span>')!!}
        <input type="text" name="segundon" id="inputcontrasena" class="form-control" value="{{old('pass')}}" placeholder="Repetir contraseña" >
         {{$errors->first('password')}}
            <br>
               <input type="text" name="nomu" id="inputcontrasena" class="form-control" value="{{old('pass')}}" placeholder="Nombre de usuario" >
            <br>
         <button class="mx-auto btn btn-primary" style="padding-left: 8%"  type="submit">Enviar</button>
         <br>
         <br>
          <a href="{{route('iniciar')}}" class="text-center">Iniciar sesion</a>
            </form>
    </div>
</div>

@endsection