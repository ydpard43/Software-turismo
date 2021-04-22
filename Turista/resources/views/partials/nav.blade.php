		@if(session()->has('nombre'))

		         <div class="modal fade" id="info" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1"aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <img src="img/ruta.png" style="width: 7%; margin-left: auto;"><h5 class="modal-title" style="margin-left: 2%;" id="staticBackdropLabel">Rutas</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal"aria-label="Close" onclick="cerrar()"></button>
                  </div>
                  <div class="modal-body">
<div class="text-center">
	<h5>Seleccione una ruta</h5>
</div>
			<div class="content-select">
<select id="r">
<option value="-1">Escoger</option>
@if(isset($rt))
@foreach($rt as $r)
<option value="{{$r->id_ruta}}">{{$r->nombre}}</option>
@endforeach
@endif
</select>
				<i></i>
			</div>
			<div class="ocultar" id="sec1">
			<div class="text-center">
				<h5>Detalles del recorrido</h5>
				<div class="text-rigth"style="font-size: 19px;">
					<span>Tiempo transcurrido :</span>
				<i id="hora">0</i><i style="margin-left: 2px;"> hora(s) </i> <i style="margin-left: 2px;" id="minutes">0</i><i style="margin-left: 2px;"> min </i>
<i style="margin-left: 7px;" id="seconds"> 0</i> <i style="margin-left: 2px;"> seg </i>
			</div>
			</div>
			<div class="text-center">
				<span style="font-size: 19px;">Porcentaje completado: </span>
				<span  id="porcent"style="font-size: 19px;">0%</span>
			</div>
			<div class="text-center">
				<span style="font-size: 19px;">Pois faltantes : </span>
				<span style="font-size: 19px;"id="restantes"></span>
			</div>
			</div>
			<div class="ocultar" id="sec2">
			<div class="access ">
				<i><img style="width:40px;"src="img/lanzadera.png" alt="Iniciar" onClick="Start()"></i>
				<i><img class="pausa" style="width:40px;"src="img/pausa.png" alt="Pausar" onClick="Stop()"></i>
				<i><img style="width:40px;"src="img/reset.png" onClick="Reset()" alt="Reiniciar"></i>
			</div>
			</div>
		</div>
                  
                  <div class="modal-footer">
                  	<a style="color:white;" class="btn btn-primary">Ver</a>
                    <button type="button" class="btn btn-primary" onclick="cerrar()">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
		@endif