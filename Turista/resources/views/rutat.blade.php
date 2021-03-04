@extends('status')
@section('parts')
@include('routes')
@endsection
@section('title','Nueva ruta')

@section('content')
<style>
    .leaflet-routing-container-hide {display: none;}
</style>
         <div class="modal fade" id="info" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1"aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Seleccion del punto de partida</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal"aria-label="Close" onclick="cerrar()"></button>
                  </div>
                  <div class="modal-body">
                      <h5>Para establecer el primer punto de la ruta debe seguir los siguientes pasos</h5>
                      <h6>1.Primero seleccione un marcador en el mapa</h6>
                      <div class="guia">
                      <img src="img/screen1.jpg">
                      </div>
                      <p>Al dar click sobre el vera información relevante acerca del punto de interes pulsado</p>
                      <div class="guia">
                      <img src="img/screen2.jpg">
                      </div>
                      <h6>2.Pulse el boton que contiene el texto 'Punto de partida'</h6>
                      <div class="guia">
                      <img src="img/screen3.jpg">
                      </div>
                      <p>En caso de querer cambiar el punto de partida, cierre la ventana que muestra los datos del destino y vuelva al paso 1</p>
                      <h6>Para terminar de click en el boton con el icono de un avión de papel</h6>
                      <div class="guia">
                       <img src="img/screen4.jpg">
                       </div>
                      <h6>En caso de que desee volver a ver la guia presione el boton con el icono de un signo de interrogación</h6>
                      <div class="guia">
                       <img src="img/screen5.jpg">
                      </div>
                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-primary" onclick="cerrar()">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
<div id="map"></div>
   <form  action="{{route('rutat')}}" name="formulario" method="POST">
    @csrf
    <input type="hidden" name="pois" id="pois">
   </form>
 <script src="{!! asset('js/map.js') !!}">
 </script>
    <script>
        $('#info').modal('show');
        function cerrar() {
              $('#info').modal('hide');
        }
    var app = @json($pun);
    var t= @json($t);
    </script>
    <script src="{!! asset('js/rutat.js') !!}"></script>
@endsection