@extends('status')
@section('parts')
@include('routes')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="js/Leaflet.Control.Custom.js"></script>
@endsection
@section('title','Inicio')
@section('content')
@include('partials.nav')
<div id="map">

</div>
<script>
var result=@json(session()->has('nombre'));
</script>
<script src="{!! asset('js/map.js') !!}">
</script>
<script src="{!! asset('js/rutar.js') !!}"></script>
@endsection