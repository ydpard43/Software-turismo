@extends('status')
@section('title','Registrarse')

@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-4">Registrarse</span>
        <br>
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" action="{{route('regist')}}" method="POST">
            @csrf
        <input type="text" name="primern"id="inputusuario" class="form-control" value="{{old('user')}}" placeholder="Nombre"  >
        {!!$errors->first('name','<span>:message</span>')!!}
        <input type="text" name="segundon" id="inputcontrasena" class="form-control" value="{{old('pass')}}" placeholder="Segundo nombre" >
         {{$errors->first('password')}}
          <input type="text" name="primera" id="inputusuario" class="form-control" value="{{old('user')}}" placeholder="Primer apellido"  >
        {!!$errors->first('primera','<span>:message</span>')!!}
        <input type="text" name="segunda" id="inputcontrasena" class="form-control" value="{{old('pass')}}" placeholder="Segundo apellido" >
         {{$errors->first('password')}}
          <input type="password" name="password" id="inputusuario" class="form-control" value="{{old('user')}}" placeholder="Usuario"  >
        {!!$errors->first('name','<span>:message</span>')!!}
        <input type="password" name="password" id="inputcontrasena" class="form-control" value="{{old('pass')}}" placeholder="Contraseña" >
         {{$errors->first('password')}}
            <br>
            <br>
         <button class="mx-auto btn btn-primary" style="padding-left: 8%"  type="submit">Iniciar sesion</button>
         <br>
         <br>
          <a href="" data-toggle="modal" data-target="#regis" class="text-center">Registrarse</a>
            </form>
    </div>
</div>

@endsection