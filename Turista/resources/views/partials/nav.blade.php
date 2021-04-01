	<div class="contenedor">
		<main>
			<nav>
				<i class="btn-menu" style="margin-left: 14%;" data-pushbar-target="pushbar-menu"><img style="width:30px; height:30px; " src="img/menu.png"></i>
			</nav>
		</main>
		@if(session()->has('nombre'))
		<a class="btn-menu2" data-pushbar-target="pushbar-menu2"><img style="width:40px; height: 40px; margin-left:14px; margin-top: 200%; " src="img/locations.png"></a>
		 @endif
		<!-- Pushbars: Menu -->
		<div data-pushbar-id="pushbar-menu" class="pushbar" style="width: 100px;" data-pushbar-direction="left">
			<div class="btn-cerrar">
				<i data-pushbar-close><img style="width: 20px;" src="img/eliminar.png"></i>
			</div>
			<nav>
					@if(session()->has('nombre'))
				<a href="{{route('perfil')}}"><img style="width: 70px; margin-left:13%; "src="img/fotografo.png"></a>
				@endif
				<a href="{{route('pois')}}"><img style="width: 50px; margin-left:20%; padding-top:40%;"src="img/marcador.png"></a>
				<li><a href="#"><img style="width: 50px; margin-left:20%; "src="img/senalizar.png" onclick="mostrar()"></a></li>
				<ul class="o" id="u1"><li><a href="{{route('nuevar')}}"><img style="width: 50px; margin-left:20%; "  src="img/varita.png"></a></li>
					@if((session()->has('nombre')))
				<li><a href="#"><img style="width: 50px; margin-left:20%; "  src="img/configuraciones.png"></a></li>
				@endif
			</ul>
				@if(!(session()->has('nombre')))
				<a href="{{route('iniciar')}}"><img style="width: 50px; margin-left:20%; "src="img/entrar.png"></a>
				@endif
				@if(session()->has('nombre'))
				<a href="{{route('salir')}}"><img style="width: 50px; margin-left:20%; "src="img/puerta.png"></a>
				@endif
			</nav>
		</div>
		@if(session()->has('nombre'))
		<div data-pushbar-id="pushbar-menu2" data-pushbar-direction="left">
			<i data-pushbar-close><img style="width: 20px;" src="img/eliminar.png"></i>
			<nav>
			 <div style="display: flex;">
				<a href="#"><img style="width: 50px; margin-left:50%; "src="img/senalizar.png"></a>
				<span style="font-size:23px; margin-top: 5%; margin-left: 21%;">Rutas</span>
			</div>

			<div class="content-select">
<select id="r">
<option value="-1"> Seleccionar</option>
@if(isset($rt))
@foreach($rt as $r)
<option value="{{$r->id_ruta}}">Ruta {{$r->id_ruta}}</option>
@endforeach
@endif
</select>
				<i></i>
			</div>
			<div>

			<div class="text-center">
				<h5>Tiempo</h5>
				<div style="font-size: 19px;">
				<i id="hora">0</i><i style="margin-left: 2px;"> hora(s) </i> <i style="margin-left: 2px;" id="minutes">0</i><i style="margin-left: 2px;"> min </i>
<i style="margin-left: 7px;" id="seconds"> 0</i> <i style="margin-left: 2px;"> seg </i>
			</div>
			</div>
			<br>
			<div class="text-center">
				<span style="font-size: 19px;">Porcentaje : </span>
				<span  id="porcent"style="font-size: 19px;">0%</span>
			</div>
			<br>
			<div class="text-center">
				<span style="font-size: 19px;">Pois faltantes : </span>
				<span style="font-size: 19px;"id="restantes"></span>
			</div>
			</div>
			<div class="access">
				<i><img style="width:50px;"src="img/lanzadera.png" onClick="Start()"></i>
				<i><img class="pausa" style="width:50px;"src="img/pausa.png" onClick="Stop()"></i>
				<i><img style="width:50px;"src="img/reset.png" onClick="Reset()"></i>
			</div>
			<div style="display: block;text-align: center;margin-top: 35px;">
				<a style="color:white; padding-left: 9%; padding-right: 9%;" class="btn btn-primary">Ver</a>
			</div>
		</div>
		@endif
	</div>