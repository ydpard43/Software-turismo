@extends('status')
@section('title','Nueva ruta')
@section('parts')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
 <link rel="stylesheet" type="text/css" href="css/number.css">
@endsection
@section('content')
<div class="card text-center">
        <div class="card-body">
          <h5 class="card-title titulo">Establecer formula de ruta</h5>
        @if(session('status'))
            {{session('status')}}
        @endif
        <form action="{{route('ecu')}}" onsubmit="funcionSubmit(event)" method="POST" name="formulario">
            @csrf
        <select style="margin-bottom: 10px;" name="formula" id="select_ecu">
        <option value="-1" selected> Seleccionar</option>
        @foreach($f as $ecuacion)
        <option value="{{$ecuacion->id_formula}}">{{$ecuacion->nombre}}</option>
        @endforeach
        </select>

        <div id="ecu">
        </div>
         <button type="submit" class="btn btn-primary btn-block mb-4">Siguiente</button>
        </form>
    </div>
</div>
<!-- MDB -->

<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>
<script src="js/pp.js"></script>
@endsection