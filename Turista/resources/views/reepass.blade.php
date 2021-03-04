@extends('status')
@section('title','Cambiar contraseña')
@section('parts')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="alert alert-success" id="myAlert" style="display:none;">
    <strong>Revise su correo electronico!</strong> Luego digite el codigo recibido
  </div>
        <div class="alert alert-warning " id="myAlert2" style="display:none;">
            <strong>Correo no valido!</strong>
        </div>
          <div class="alert alert-info" id="myAlert3" style="display:none;">
            <strong>Digite su nueva contraseña!</strong>
        </div>
                <div class="alert alert-warning " id="myAlert4" style="display:none;">
            <strong>Revise el codigo!</strong>
        </div>
          <div class="alert alert-warning " id="myAlert5" style="display:none;">
            <strong>La contraseña no puede estar vacia!</strong>
        </div>
          <div class="alert alert-success" id="myAlert6" style="display:none;">
            <strong>Contraseña cambiada exitosamente!</strong> 
        </div>
                  <div class="alert alert-warning" id="myAlert7" style="display:none;">
            <strong>Operación no permitida!</strong> 
        </div>
    <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title titulo">Restablecer Contraseña</h5>
          <form action="" onsubmit="funcionSubmit(event)" method="POST" class="needs-validation">
            @csrf
            <div class="form-outline mb-4">
              <input type="email" required class="form-control" id="correo" style="background: #f1f1f1;"  name="email" />
              <label class="form-label" id='label'  for="form2Example1">Digita tu correo</label>
            </div>
            <button type="submit" id='button' class="btn btn-primary btn-block mb-4">Recuperar contraseña</button>
            <div class="text-center">
              <p>Ya tienes una cuenta? <a href="{{route('iniciar')}}">Inicia Sesión</a></p>
            </div>
          </form>
        </div>
      </div>
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>
<script src="js/re.js"></script>
@endsection