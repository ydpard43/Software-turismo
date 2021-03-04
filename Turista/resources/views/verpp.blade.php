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
              <input style="background:#f1f1f1; " required type="text" value="{{$turista->alias}}" id="formu" class="form-control" name="nomu" />
              <label class="form-label" for="formu">Usuario</label>
            </div>
          </div>
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required type="email" value="{{$turista->correo}}" id="forme" class="form-control" name="email" />
              <label class="form-label" for="forme">Correo</label>
            </div>
          </div>
        </div>
                <div class="row mb-4">
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required onkeypress="return validate(event)" type="text" value="{{$turista->prnombre}}" id="pn" class="form-control" name="primern" />
              <label class="form-label" for="pn">1° nombre</label>
            </div>
          </div>
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required onkeypress="return validate(event)" type="text"  type="text" id="sn" name="segundon" value="{{$turista->sgnombre}}" class="form-control" />
              <label class="form-label" for="sn">2° nombre</label>
            </div>
          </div>
        </div>
           <div class="row mb-4">
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required onkeypress="return validate(event)" type="text"  type="text" id="pa" value="{{$turista->prapellido}}" name="primera"class="form-control" />
              <label class="form-label" for="pa">1° apellido</label>
            </div>
          </div>
          <div class="col">
            <div class="form-outline">
              <input style="background:#f1f1f1; " required onkeypress="return validate(event)" type="text" type="text" id="sa" value="{{$turista->sgapellido}}" name="segunda" class="form-control" />
              <label class="form-label" for="sa">2° apellido</label>
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


        <div class="regist">
        <button class="btn btn-primary" style="width:30%;" type="submit">Actualizar</button>
        <a class="btn btn-primary" style="width: 40%;"  href="{{route('actualizar')}}">Cambiar contraseña</a>
        </div>
            </form>
           </div>
</div>
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>
<script>
$('#imagen').click(function(event) {
    $('#archivo').click();
});
  var loadImage = function(event) {
    var image = document.getElementById('imagen');
    image.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
@endsection