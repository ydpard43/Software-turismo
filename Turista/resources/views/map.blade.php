@extends('status')
@section('parts')
@include('routes')
@endsection
@section('title','iniciar')

@section('content')
   
   <div id="map"></div>
   <form  action="{{route('map')}}" name="formulario" method="POST">
   	@csrf
   	<input type="hidden" name="pois" id="pois">
   </form>
 
 <script src="{!! asset('js/map_nr.js') !!}">
 </script>
 <script> var app = @json($pois);</script>
 <script src="{!! asset('js/poi.js') !!}"></script>
 @endsection