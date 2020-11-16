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
        <a href="" data-toggle="modal" data-target="#respass" class="center-block">Has olvidado tu contraseña</a>
            <br>
            <br>
         <button class="mx-auto btn btn-primary" style="padding-left: 8%"  type="submit">Iniciar sesion</button>
         <br>
         <br>
          <a href="" data-toggle="modal" data-target="#regis" class="text-center">Registrarse</a>
            </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="respass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="regis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection