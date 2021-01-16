@extends('status')
@section('title',$poi[0]->nomp)
@section('content')
 @include('partials.nav2')
 @php
 $a[0]=0;
 @endphp
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-3">{{$poi[0]->nomp}}</span>
        <br>
        <p id="profile-name" class="profile-name-card"></p>
        <img style='border-radius: 25px;' src="img/{{$poi[0]->id_imagenpoi}}">
        <div style="text-align: center; padding-top: 1%;">
            @if($estrellas=='0')
            <i>No hay calificaciones</i>
            @endif
        	@if($estrellas=='1')
        	<a><img style="width: 7%;" src="img/estrella.png"></a>
        	@endif
        	@if($estrellas=='2')
        	<a><img style="width: 7%;" src="img/estrella.png"><img style="width: 7%;" src="img/estrella.png"></a>
        	@endif
        	@if($estrellas=='3')
        	<a><img style="width: 7%;" src="img/estrella.png"><img style="width: 7%;" src="img/estrella.png"><img style="width: 7%;" src="img/estrella.png"></a>
        	@endif
        	@if($estrellas=='4')
        	<a><img style="width: 7%;" src="img/estrella.png"><img style="width: 7%;" src="img/estrella.png"><img style="width: 7%;" src="img/estrella.png"><img  style="width: 7%;"src="img/estrella.png"></a>
        	@endif
        	@if($estrellas=='5')
        	<a><img style="width: 7%;" src="img/estrella.png"><img style="width: 7%;" src="img/estrella.png"><img style="width: 7%;" src="img/estrella.png"><img  style="width: 7%;"src="img/estrella.png"><img style="width: 7%;"src="img/estrella.png"></a>
        	@endif
                    </div>
        <span style="text-align:right; padding-right: 33%; padding-top: 1%; ">Ubicación:{{$poi[0]->nomm}}</span>
        <span style="text-align:right; padding-right: 35%; padding-top: 1%; ">Tipologia:{{$poi[0]->nombre}}</span>
        <span style="text-align:right; padding-right: 41%; padding-top: 1%; ">Descripcion</span>
        <p>{{$poi[0]->nomm}}</p>
        <div>
        	<h2 style="padding-right: 270px;">Opiniones</h2>
        @if($estrellas=='0')
        <i style="padding-right: 270px;">No existe ninguna opinion</i>
        @endif
         @foreach($opiniones as $op)

         @if(($op->id_turista)!=(session('id')))
         <div>
         	<div style="display: grid;">
         <span>{{$op->alias}}</span>
         <span>{{$op->opinion}}</span>
     	</div>
         <div style="padding-bottom: 6%;">
         @if($op->estrellas == '5' )
         <img style="width: 4%;" src="img/estrella.png"><img style="width: 4%;" src="img/estrella.png"><img style="width: 4%;" src="img/estrella.png"><img  style="width: 4%;"src="img/estrella.png"><img style="width: 4%;"src="img/estrella.png">
         @endif
          @if($op->estrellas == '4' )
         <img style="width: 4%;" src="img/estrella.png"><img style="width: 4%;" src="img/estrella.png"><img style="width: 4%;" src="img/estrella.png"><img  style="width: 4%;"src="img/estrella.png">
         @endif
          @if($op->estrellas == '3' )
         <img style="width: 4%;" src="img/estrella.png"><img style="width: 4%;" src="img/estrella.png"><img style="width: 4%;" src="img/estrella.png">
         @endif
          @if($op->estrellas == '2' )
         <img style="width: 4%;" src="img/estrella.png"><img style="width: 4%;" src="img/estrella.png">
         @endif
          @if($op->estrellas == '1' )
         <img style="width: 4%;" src="img/estrella.png">
         @endif
     
     	@else
     	        <form action="{{route('aopoi')}}" method="post">
     	        	@php
     	        	$a[0]=1;
     	        	@endphp
        	@csrf
        	<textarea placeholder=" Ingresa tu opinion" name="op" rows="3" style="width: 100%; padding-left: 14px; padding-right: 14px; padding-top: 5px; padding-bottom: 5px;border:1px solid gray; border-radius: 20px;">{{$op->opinion}}</textarea>
				  <p class="clasificacion">
				    <input id="radio1" type="radio" name="estrellas" value="5">
				    <label style="font-size: 30px;" for="radio1">★</label>
				    <input id="radio2" type="radio" name="estrellas" value="4">
				    <label style="font-size: 30px;" for="radio2">★</label>
				    <input id="radio3" type="radio" name="estrellas" value="3">
				    <label style="font-size: 30px;" for="radio3">★</label>
				    <input id="radio4" type="radio" name="estrellas" value="2">
				    <label style="font-size: 30px;" for="radio4">★</label>
				    <input id="radio5" type="radio" name="estrellas" value="1">
				    <label style="font-size: 30px;" for="radio5">★</label>
				  </p>
				  <input type="hidden" name="poi" value="{{$poi[0]->id_poi}}">
				  <button type="submit" class="btn-primary">enviar</button>
				</form>
     	 @endif
         @endforeach

        </div>
        @if((session()->has('nombre')))
        @if($a[0]==0)
        <form action="{{route('insertpoi')}}" method="post">
        	@csrf
        	<textarea placeholder=" Ingresa tu opinion" name="op" rows="3" style="width: 100%; padding-left: 14px; padding-right: 14px; padding-top: 5px; margin-top: 7px; padding-bottom: 5px;border:1px solid gray; border-radius: 20px;"></textarea>
				  <p class="clasificacion">
				    <input id="radio1" type="radio" name="estrellas" value="5">
				    <label style="font-size: 30px;" for="radio1">★</label>
				    <input id="radio2" type="radio" name="estrellas" value="4">
				    <label style="font-size: 30px;" for="radio2">★</label>
				    <input id="radio3" type="radio" name="estrellas" value="3">
				    <label style="font-size: 30px;" for="radio3">★</label>
				    <input id="radio4" type="radio" name="estrellas" value="2">
				    <label style="font-size: 30px;" for="radio4">★</label>
				    <input id="radio5" type="radio" name="estrellas" value="1">
				    <label style="font-size: 30px;" for="radio5">★</label>
				  </p>
				  <input type="hidden" name="poi" value="{{$poi[0]->id_poi}}">
				  <button type="submit" class="btn-primary">enviar</button>
				</form>
				@endif
				@endif
				 @if(!(session()->has('nombre')))
				 <div style="display: block; text-align: center;">
				 	<i>Para calificar un destino inicia sesión</i>
				 </div>
				 @endif
        </div>

    </div>
    <script src="{!! asset('js/main.js') !!}"></script>
     <script src="{!! asset('js/pushbar.js') !!}">
 </script>
 <script src="{!! asset('js/mostrar.js') !!}">
 </script>
 <script>
        var pushbar=new Pushbar({
            blur:true,
            overlay:true

        });
</script>
 @endsection