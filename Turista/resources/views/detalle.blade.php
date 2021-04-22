@extends('status')
@section('title','Detalles de la ruta')
@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title titulo" style="text-align: center;">{{$ruta[0]->nombre}}</h2>
        <h5 style="margin-bottom: 10px;">Datos del recorrido</h5>
         <div>
          Nombre de la ruta : <input type="text" id="nomb" value="{{$ruta[0]->nombre}}">
          </div>
            <br>
            <div class="text-center">
        <h5 style="margin-bottom: 10px;">Puntos de interes</h7>
             </div>
        @if(session('status'))
            {{session('status')}}
        @endif
       
            @csrf
            <div style="padding: 3%;">
             <div class="row row-cols-2 row-cols-md-3 g-4 text-center" >
        @for($i=0;$i<count($ruta);$i++)
    
            <div class="col">
                <div class="card h-100">
                  <img
                    src="../img/{{$ruta[$i]->imagen}}"
                    alt="..."
                  />
                  <div class="card-body">
                    <span class="card-title"> {{$i+1}}.{{$ruta[$i]->pn}}</span>
                  </div>
                </div>
              </div>
          @endfor
          </div>
        </div>
        <br>
        Modalidad: @if($ruta[0]->modalidad=='0') Carro @endif @if($ruta[0]->modalidad=='1') Pie @endif @if($ruta[0]->modalidad=='2') Bicicleta @endif
        <br>
        Distancia total: {{round($ruta[0]->distancia,2)}} km
        <br>
        Tiempo aproximado: {{$ruta[0]->tiempo}} min
        <br>
        Costo Total : @if($ruta[0]->costo>0) $ {{$ruta[0]->costo}}@endif @if($ruta[0]->costo==0) Ninguno @endif

        <div style="text-align: center; display: block; width: 100%;">
            <br>
        <a type="button" class="btn btn-info " href="{{route('rutas')}}">Volver</a>
        <a type="button" class="btn btn-success" onclick="actualiza()">Actualizar</a>
         <button class="delete btn btn-danger" onclick="eliminar()">Eliminar</button>
        </div>
        <br>
    </div>
</div>
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>
<script>

      var app = @json($ruta);
var token = '{{csrf_token()}}';
        function eliminar(){
    $.ajax({
    type:"PUT",
    url:"{{url('/eliminar')}}",
    data:{ruta:app[0]["id_ruta"],_token:token},
    success: function(re){
     window.location.href = '{{route("rutas")}}'; 
    
    }
});
 }
 function actualiza() {
  var nombre=$('#nomb').val();
  if (!($.isEmptyObject(nombre))) {
          $.ajax({
    type:"PUT",
    url:"{{url('/actualiza')}}",
    data:{nombre:nombre,ruta:app[0]["id_ruta"],_token:token},
    success: function(re){ 
   
    window.location = "" + nombre;

    }
});
  }else{
    alert('EL nombre de la ruta no puede esta vacio');
  }

 }

</script>
@endsection