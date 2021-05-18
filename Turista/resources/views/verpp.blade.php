@extends('status')
@section('title','Mi perfil')
@section('content')

<div class="card text-center">
    <div class="card-body" style="background: linear-gradient(180deg, rgba(0,215,255,1) 30%, rgba(255,255,255,1) 30%); border-radius: 25px;">
        <h1 id="title" style="color: white;">Perfil</h1>
        @if(session('status'))
        <h4 style="color:blue; ">{{session('status')}}</h4>
        @endif
        <form class="form-signin" action="{{route('ap')}}" method="post" enctype="multipart/form-data" >
        <div style="text-align: center;">
        <img style="width: 200px; height: 200px; border-radius: 100px; margin-bottom: 13px;" id="imagen" src="img/{{$turista->imagen}}">
        <input style='display: none;' accept="image/*" id="archivo" type="file" name="img" onchange="loadImage(event)">
        </div>
            @csrf
        <div class="row mb-4">
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " data-mdb-showcounter="true" minlength="4" 
                maxlength="30" required type="text" value="{{$turista->alias}}" id="formu" class="form-control" name="nomu" />
              <label class="form-label" for="formu">Usuario</label>
              <div class="form-helper"></div>
            </div>
          </div>
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " minlength="12" 
                maxlength="40" data-mdb-showcounter="true" required type="email" value="{{$turista->correo}}" id="forme" class="form-control" name="email" />
              <label class="form-label" for="forme">Correo</label>
              <div class="form-helper"></div>
            </div>
          </div>
        </div>
                <div class="row mb-4">
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " data-mdb-showcounter="true" minlength="2" 
                maxlength="10" required onkeypress="return comprobar(event)" type="text" value="{{$turista->prnombre}}" id="pn" class="form-control" name="primern" />
              <label class="form-label" for="pn">Nombre</label>
              <div class="form-helper"></div>
            </div>
          </div>
        <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " data-mdb-showcounter="true" minlength="2" 
                maxlength="10" required onkeypress="return comprobar(event)" type="text"  type="text" id="pa" value="{{$turista->prapellido}}" name="primera"class="form-control" />
              <label class="form-label" for="pa">Apellido</label>
              <div class="form-helper"></div>
            </div>
        </div>
        </div>
        <div class="row mb-4">
                  <div class="col">
            <div class="form-outline">
        <select class="select" style="width: 100%; "name="sexo">
           <option @if( ($turista->sexo) =='false')
            selected
           @endif
            value="0">Mujer</option>
           <option
           @if( ($turista->sexo) =='true')
            selected
           @endif
           value="1">Hombre</option>
         </select>
         </div>
     </div>
 </div>

        <div class="regist" style="text-align: right;">
        <a class="btn btn-primary" style="margin-bottom: 10px;" href="{{route('home')}}">Volver</a>
        <button class="btn btn-info" style="margin-bottom: 10px;" type="submit">Actualizar</button>
         <a class="btn btn-success" style="margin-bottom: 10px;"  href="{{route('actualizar')}}">Cambiar contraseña</a>
        </div>
        <br>
    
            </form>
           </div>
</div>

<script>
$('#imagen').click(function(event) {
    $('#archivo').click();
});
  var loadImage = function(event) {
    var image = document.getElementById('imagen');
    image.src = URL.createObjectURL(event.target.files[0]);
  };
      function comprobar(e) {
            opcion = (document.all) ? e.keyCode : e.which; 
            if (opcion==8) return true;
            else if (opcion==0||opcion==9)  return true;
           patron =/^[A-Z]+$/i;
            check = String.fromCharCode(opcion);
            return patron.test(check); 
        }
</script>
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>
@endsection