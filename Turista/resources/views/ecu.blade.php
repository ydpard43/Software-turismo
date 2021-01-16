@extends('status')
@section('title','Nueva ruta')

@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-2">Nueva ruta</span>
        <br>
        <p id="profile-name" class="profile-name-card"></p>
        <span>Ajustar formula</span>
        <hr>
        @if(session('status'))
            {{session('status')}}
        @endif
        <form action="{{route('ecu')}}" method="POST">
            @csrf
        @foreach($f as $pesos)
        <span>{{$pesos->nombre}}</span>
        <input type="number"  name="pesos[]" value="{{$pesos->peso}}">
        <input type="hidden" name="id[]"  value="{{$pesos->id_formula}}">
        @endforeach
        <hr>
        <hr>
        <div style="text-align: right; display: block; width: 100%;">
         <button type="submit" class="btnp">Siguiente</button>
        </div>
        </form>
        <br>
    </div>
</div>


@endsection