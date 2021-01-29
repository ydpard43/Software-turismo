@extends('status')
@section('parts')
@include('routes')
@endsection
@section('title','Nueva ruta')

@section('content')
<style>
    .leaflet-routing-container-hide {display: none;}
</style>
<div id="map"></div>
   <form  action="{{route('rutat')}}" name="formulario" method="POST">
    @csrf
    <input type="text" name="pois" id="pois">
   </form>
 <script src="{!! asset('js/map.js') !!}">
 </script>
    <script>
    var app = @json($pun);
    var t= @json($t);
    </script>
    <script src="{!! asset('js/rutat.js') !!}"></script>
@endsection