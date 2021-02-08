@php
if ((session()->has('nombre'))) {
return redirect()->to('/')->send();
}
@endphp
@extends('status')
@section('title','Registrarse')

@section('content')
  <div class="card text-center">
    <div class="card-body">
      
      <h5 class="card-title titulo">Crear una Cuenta</h5>
        @if(session('status'))
        <div class="alert alert-warning alert-dismissible fade show" id="myAlert" role="alert">
            <strong>{{session('status')}}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="cerrar()" aria-label="Close"></button>
        </div>
        @endif
                @if(session('statu'))
        <div class="alert alert-success alert-dismissible fade show" id="myAlert" role="alert">
            <strong>{{session('statu')}}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="cerrar()" aria-label="Close"></button>
        </div>
        @endif
      <form action="{{route('regist')}}" method="post">
        @csrf
        <div class="row mb-4">
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required type="text" value="{{old('nomu')}}" id="formu" class="form-control" name="nomu" />
              <label class="form-label" for="formu">Usuario</label>
            </div>
          </div>
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required type="email" value="{{old('email')}}" id="forme" class="form-control" name="email" />
              <label class="form-label" for="forme">Correo</label>
            </div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required onkeypress="return validate(event)" type="text" value="{{old('primern')}}" id="pn" class="form-control" name="primern" />
              <label class="form-label" for="pn">1° nombre</label>
            </div>
          </div>
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required onkeypress="return validate(event)" type="text" value="{{old('primern')}}" type="text" id="sn" name="segundon" value="{{old('segundon')}}" class="form-control" />
              <label class="form-label" for="sn">2° nombre</label>
            </div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required onkeypress="return validate(event)" type="text" value="{{old('primern')}}" type="text" id="pa" value="{{old('primera')}}" name="primera"class="form-control" />
              <label class="form-label" for="pa">1° apellido</label>
            </div>
          </div>
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required onkeypress="return validate(event)" type="text" value="{{old('primern')}}"type="text" id="sa" value="{{old('segunda')}}" name="segunda" class="form-control" />
              <label class="form-label" for="sa">2° apellido</label>
            </div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required value="{{old('password')}}" type="password" id="pass1" class="form-control" name="password" />
              <label class="form-label" for="pass1">Contraseña</label>
            </div>
          </div>
          <div class="col">
            <div class="form-outline">
            <select  style="width: 100%;" id="sexo" required class="select"name="sexo">
            <option selected value="-1">Genero</option>
           <option value="0">Mujer</option>
           <option value="1">Hombre</option>
         </select>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mb-4">Enviar</button>
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
<script>
    function validate(e) {
            tecla = (document.all) ? e.keyCode : e.which; 
            if (tecla==8) return true;
            else if (tecla==0||tecla==9)  return true;
           patron =/^[A-Z]+$/i;
            te = String.fromCharCode(tecla);
            return patron.test(te); 
        }
   function cerrar(){
    $('#myAlert').hide();
   }

</script>
@endsection