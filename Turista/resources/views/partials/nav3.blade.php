	<div class="contenedor">
		<main>
			<nav>
				<i class="btn-menu" style="margin-left: 14%;" data-pushbar-target="pushbar-menu"><img style="width:30px; height:30px; " src="../img/menu.png"></i>
			</nav>
		</main>
		<!-- Pushbars: Menu -->
		<div data-pushbar-id="pushbar-menu" class="pushbar" style="width: 100px;" data-pushbar-direction="left">
			<div class="btn-cerrar">
				<i data-pushbar-close><img style="width: 20px;" src="../img/eliminar.png"></i>
			</div>
			<nav>
				@if((session()->has('nombre')))
				<a href="{{route('perfil')}}"><img style="width: 70px; margin-left:13%; "src="../img/fotografo.png"></a>
				@endif
				<a href="{{route('pois')}}"><img style="width: 50px; margin-left:20%; padding-top:40%;"src="../img/marcador.png"></a>
				@if((session()->has('nombre')))
				<li><a href="#"><img style="width: 50px; margin-left:20%; "src="../img/senalizar.png" onclick="mostrar()"></a></li>
				<ul class="o" id="u1">
					<li><a href="#"><img style="width: 50px; margin-left:20%; "  src="../img/varita.png"></a>
					</li>
					@if((session()->has('nombre')))
				<li><a href="#"><img style="width: 50px; margin-left:20%; "  src="../img/configuraciones.png"></a></li>
					@endif
			</ul>@endif
			@if(session()->has('nombre'))
				<a href="{{route('salir')}}"><img style="width: 50px; margin-left:20%; "src="../img/puerta.png"></a>
				@else
				<a href="{{route('iniciar')}}"><img style="width: 50px; margin-left:20%; "src="../img/entrar.png"></a>
				@endif

			</nav>
		</div>
	</div>