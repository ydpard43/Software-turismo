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
				<ul class="o" id="u1"><li><a href="#"><img style="width: 50px; margin-left:20%; "  src="img/varita.png"></a></li>
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
				<select >
					<option>Ruta 1</option>
					<option>Ruta 1</option>
					<option>Ruta 1</option>
					<option>Ruta 1</option>
				</select>
				<i></i>
			</div>
			<div>
			<div class="router">
				<span>Porcentaje</span>
				<span>10%</span>
			</div>
			<div class="router">
				<span>Tiempo</span>
				<span>10 min</span>
			</div>
			<div class="router">
				<span>Pois faltantes</span>
				<span>10</span>
			</div>
			</div>
			<div class="access">
				<i><img style="width:50px;"src="img/lanzadera.png"></i>
				<i><img class="pausa" style="width:50px;"src="img/pausa.png"></i>
				<i><img style="width:50px;"src="img/reset.png"></i>
			</div>
			<div style="display: block;text-align: center;margin-top: 35px;">
				<a style="color:white; padding-left: 9%; padding-right: 9%;" class="btn btn-primary">Ver</a>
			</div>
		</div>
		@endif
	</div>