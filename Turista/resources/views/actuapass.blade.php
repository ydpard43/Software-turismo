@php
if (!(session()->has('nombre'))) {
return redirect()->to('/')->send();
}
@endphp
@extends('status')
@section('title','Cambiar contraseña')
@section('content')
<div class="card text-center">
    <div class="card-body">
        <h1 id="title">Cambiar contraseña</h1>
        <br>
                          @if(session('status'))
        <div class="alert alert-warning alert-dismissible fade show" id="myAlert" role="alert">
            <strong>{{session('status')}}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="cerrar()" aria-label="Close"></button>
        </div>
        <br>
        @endif

        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" action="{{route('actualizar')}}" method="POST">
            @csrf
        <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
        <input type="password" style="background:#f1f1f1; " required  name="pass"id="pass" class="form-control" >
         <label class="form-label" for="pass">Contraseña actual</label>

    </div>
</div>
</div>
<div class="row mb-4">
    <div class="col">
        <div class="form-outline">
        <input type="password" style="background:#f1f1f1; " required name="pass2" id="pass2" class="form-control">
         <label class="form-label" for="pass2">Nueva Contraseña</label>
    </div>
    </div>
</div>
        
            <br>
            <div style="text-align:right;">
        <a class="btn btn-info" href="{{route('perfil')}}">Volver</a>
         <button class="btn btn-primary"  type="submit">Enviar</button>
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