@extends('status')
@section('title','Registrarse')

@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-4">Registrarse</span>
        <br>
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" action="{{route('regist')}}" method="post" enctype="multipart/form-data" >
            @csrf
        @if(session('status'))
        {{session('status')}}
        @endif
        <input type="text" name="primern"id="inputusuario" class="form-control" value="{{old('primern')}}" placeholder="Nombre"  >
        {!!$errors->first('primern','<span>:message</span>')!!}
        <input type="text" name="segundon" id="inputcontrasena" class="form-control" value="{{old('segundon')}}" placeholder="Segundo nombre" >
         {{$errors->first('segundon')}}
          <input type="text" name="primera" id="inputusuario" class="form-control" value="{{old('primera')}}" placeholder="Primer apellido"  >
        {!!$errors->first('primera','<span>:message</span>')!!}
        <input type="text" name="segunda" id="inputcontrasena" class="form-control" value="{{old('segunda')}}" placeholder="Segundo apellido" >
         {{$errors->first('segunda')}}
          <input type="password" name="password" id="inputusuario" class="form-control" value="{{old('password')}}" placeholder="Contraseña"  >
        {!!$errors->first('password','<span>:message</span>')!!}
        <input type="password" name="password2" id="inputcontrasena" class="form-control" value="{{old('password2')}}" placeholder="Repetir Contraseña" >
        <input class="form-control" type="email" name="email">
        <input type="file" name="img" accept="image/*" class="form-control-file">
         {{$errors->first('password2')}}
         <select name="sexo">
           <option value="0">Mujer</option>
           <option value="1">Hombre</option>
         </select>
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