@extends('status')
@section('title','Guardar ruta')
@section('parts')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title titulo" style="text-align: center;">Nueva ruta</h2>
        
        <form action="{{route('guardarrp2')}}" onsubmit="funcionSubmit(event)" method="POST">
          <h5 style="margin-bottom: 10px;">Datos del recorrido</h5>
          Nombre de la ruta: <input required minlength="4" maxlength="20" type="text" id="name">
          <br>
        <h7 style="margin-bottom: 10px;">Puntos de interes</h7>
        @if(session('status'))
            {{session('status')}}
        @endif
            @csrf
            <div style="padding: 3%;">
             <div class="row row-cols-2 row-cols-md-3 g-4 text-center" >
        @for($i=0;$i<count($poi);$i++)
    
            <div class="col">
                <div class="card h-100">
                  <img
                    src="img/{{$nombres[$poi[$i]]['img']}}"
                    alt="..."
                  />
                  <div class="card-body">
                    <span class="card-title"> {{$i+1}}.{{$nombres[$poi[$i]]['nombre']}}</span>
                  </div>
                </div>
              </div>
          @endfor
          </div>
        </div>
        <br>
        Distancia total: {{round($total,2)}} km
        <br>
        Tiempo aproximado: {{$time}} min
        <br>
        Costo Total : @if($costo>0){{$costo}}@endif @if($costo==0) Ninguno @endif
        <div style="text-align: right; display: block; width: 100%;">
            <br>
        <a type="button" class="btn btn-danger " href="{{route('nuevar')}}">Volver al inicio</a>
         <button type="submit" class="btn btn-primary ">Guardar</button>
        </div>

        </form>
        <br>
    </div>
</div>
<script>
    var app = @json($poi);
    var time=@json($time);
    var cost=@json($costo);
    var distance=@json($total);
      
       $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        function funcionSubmit(event){
    event.preventDefault();

    $.ajax({
    type:"POST",
    url:"guardarrp2",
    data:{poi:app,time:time,costo:cost,name:$('#name').val(),distance:distance},
    success: function(re){
      window.location.href = '{{route("home")}}'; 
    }
});
 }

</script>
@endsection