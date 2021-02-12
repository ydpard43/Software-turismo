@php
if ((session()->has('nombre'))) {
return redirect()->to('/')->send();
}
@endphp
@extends('status')
@section('title','iniciar')
@section('content')
    <div class="card text-center" style="margin-top: 2%;">
        <div class="card-body">
          <h5 class="card-title titulo">Mi Ruta</h5>
                  @if(session('status'))
        <div class="alert alert-warning alert-dismissible fade show" id="myAlert" role="alert">
            <strong>{{session('status')}}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="cerrar()" aria-label="Close"></button>
        </div>
        @endif
                <p id="profile-name" class="profile-name-card"><img id="profile-img" class="img-profile" src="{!!asset('img/turista.png')!!}" /></p>
          <form action="{{route('iniciar')}}" method="POST">
            @csrf
            <div class="form-outline mb-4">
              <input style="background: #f1f1f1" name="name" type="text" value="{{old('user')}}" id="formuser" class="form-control" />
              <label class="form-label" for="formuser">Usuario</label>
            </div>
            <div class="form-outline mb-4">
              <input style="background: #f1f1f1" name="password" type="password" id="formpass" class="form-control" />
              <label class="form-label" for="formpass">Contraseña</label>
            </div>
  <div class="row mb-4">
    <div class="col">
      <a href="{{route('reepass')}}">¿Olvidaste tu Contraseña?</a>
    </div>
  </div>
            <button type="submit" class="btn btn-primary btn-block mb-4">Inicia Sesión</button>
            <div class="text-center">
              <p>No tienes una cuenta? <a href="{{route('regist')}}">Registrate</a></p>
              
            </div>
          </form>
        </div>
      </div>
      <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>
<script>
     function cerrar(){
    $('#myAlert').hide();
   }

</script>
@endsection