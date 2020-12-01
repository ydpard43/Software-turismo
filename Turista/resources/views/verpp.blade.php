@extends('status')
@section('title','Mi perfil')
@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container" style="background: linear-gradient(180deg, rgba(0,215,255,1) 24%, rgba(255,255,255,1) 24%);">
        <span id="title" style="color: white;" class="mx-auto display-4">Perfil</span>
        <br>
        @if(session('status'))
        <h4 style="color:blue; ">{{session('status')}}</h4>
        @endif
        <div style="text-align: center;">
        <img style="width: 40%; border-radius: 100px; margin-bottom: 13px;" id="imagen" src="img/{{$turista->imagen}}">
        <input style='display: none;' accept="image/*" id="archivo"type="file" name="img" >
        </div>
        <form class="form-signin" action="{{route('ap')}}" method="post" enctype="multipart/form-data" >
            @csrf
        <div>
        <span style="margin-right: 49%;">Alias</span><span style="position: absolute;">Correo</span>
        </div>
        <div style="display:flex;">
        <hr style="width: 45%; margin-left: 0; position: relative;"><hr style="width: 45%; margin-right:0; position: relative;">
        </div>
        <div class="regist">
        <input type="text" name="nomu" class="" value="{{$turista->alias}}" placeholder="Nombre de usuario" >
        <input type="email" value="{{$correo[0]->id_correoturista}}" name="email">
        </div>
         <span>Nombres</span>
        <hr>
        <div class="regist">
        <input type="text" name="primern" value="{{$turista->prnombre}}" placeholder="Nombre"  >
        <input type="hidden" name="">
        {!!$errors->first('primern','<span>:message</span>')!!}
        <input type="text" name="segundon" value="{{$turista->sgnombre}}" placeholder="Segundo nombre" >
         {{$errors->first('segundon')}}
         </div>
         <span>Apellidos</span>
         <hr>
         <div class="regist">
          <input type="text" name="primera" class="" value="{{$turista->prapellido}}" placeholder="Primer apellido"  >
        {!!$errors->first('primera','<span>:message</span>')!!}
        <input type="text" name="segunda" class="" value="{{$turista->sgapellido}}" placeholder="Segundo apellido" >
        {{$errors->first('segunda')}}

        </div>
         <span>Genero</span>
        <hr>
        <div class="regist">
        <select class="form-control"name="sexo">
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


        <div class="regist">
        <button class="btn btn-primary" style="width:30%;" type="submit">Actualizar</button>
        <a class="btn btn-primary" style="width: 40%;"  href="{{route('actualizar')}}">Cambiar contraseña</a>
        </div>
            </form>
           </div>
</div>
<script>
$('#imagen').click(function(event) {
    $('#archivo').click();
});
</script>
@endsection