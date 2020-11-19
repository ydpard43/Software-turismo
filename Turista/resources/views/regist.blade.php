@extends('status')
@section('title','Registrarse')

@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-4">Crear una cuenta</span>
        <br>
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" action="{{route('regist')}}" method="post" enctype="multipart/form-data" >
            @csrf
        @if(session('status'))
        {{session('status')}}
        @endif
        <span>Nombres</span>
        <hr>
        <div class="regist">
        <input type="text" name="nomu" class="" value="{{old('pass')}}" placeholder="Nombre de usuario" >
        </div>
        <div class="regist">
        <input type="text" name="primern" value="{{old('primern')}}" placeholder="Nombre"  >
        <input type="hidden" name="">
        {!!$errors->first('primern','<span>:message</span>')!!}
        <input type="text" name="segundon" value="{{old('segundon')}}" placeholder="Segundo nombre" >
         {{$errors->first('segundon')}}
         </div>
         <span>Apellidos</span>
         <hr>
         <div class="regist">
          <input type="text" name="primera" class="" value="{{old('primera')}}" placeholder="Primer apellido"  >
        {!!$errors->first('primera','<span>:message</span>')!!}
        <input type="text" name="segunda" class="" value="{{old('segunda')}}" placeholder="Segundo apellido" >
        {{$errors->first('segunda')}}
        </div>
        <span>Contraseña</span>
        <hr>
         <div class="regist">
          <input type="password" name="password"  class="" value="{{old('password')}}" placeholder="Contraseña"  >
        {!!$errors->first('password','<span>:message</span>')!!}
        <input type="password" name="password2"  value="{{old('password2')}}" placeholder="Repetir Contraseña" >
        {{$errors->first('password2')}}
        </div>
        <hr>
        <div class="regist">
        <input type="email" name="email">
        <select class="form-control"name="sexo">
           <option value="0">Mujer</option>
           <option value="1">Hombre</option>
         </select>
         </div>
        <input type="file" name="img" accept="image/*" class="file">

        <div class="regist">
         <button class="btnp" type="submit">Enviar</button>
        </div>
        <br>
          <a href="{{route('iniciar')}}" class="text-center">Iniciar sesion</a>
            </form>
    </div>
</div>

@endsection