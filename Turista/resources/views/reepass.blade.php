@extends('status')
@section('title','Cambiar contraseña')

@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-4">Reestablecer contraseña</span>
        <br>
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" action="{{route('reepass')}}" method="POST">
            @csrf
        <input type="email" name="email"id="inputusuario" class="form-control" value="{{old('user')}}" placeholder="Digite su correo"  >
        {!!$errors->first('name','<span>:message</span>')!!}
            <br>
         <button class="mx-auto btn btn-primary" style="padding-left: 8%"  type="submit">Enviar</button>
         <br>
         <br>
          <a href="{{route('iniciar')}}" class="text-center">Iniciar sesion</a>
            </form>
    </div>
</div>

@endsection