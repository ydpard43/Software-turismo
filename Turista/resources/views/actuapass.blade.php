@php
if (!(session()->has('nombre'))) {
return redirect()->to('/')->send();
}
@endphp
@extends('status')
@section('title','Cambiar contraseña')
@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-4">Reestablecer contraseña</span>
        <br>
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" action="{{route('actualizar')}}" method="POST">
            @csrf
        <input type="password" name="email"id="inputusuario" class="form-control" placeholder="Contraseña actual">
        <input type="password" name="email"id="inputusuario" class="form-control" placeholder="Nueva contraseña">
        {!!$errors->first('name','<span>:message</span>')!!}
            <br>
         <button class="mx-auto btn btn-primary" style="padding-left: 8%"  type="submit">Enviar</button>
            </form>
    </div>
</div>

@endsection