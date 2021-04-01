@extends('status')
@section('parts')
@include('routes')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="js/Leaflet.Control.Custom.js"></script>
@endsection
@section('title','Inicio')

@section('content')
<style>
	.btn-group-vertical{
		box-shadow: none;
	}
	.btn-group-vertical:hover {
		box-shadow: none;
	}
	.btn1{
	border-radius: 20px;
    text-align: center;
    width: 40px;
    height: 40px;
    margin-bottom: 3px;
    margin-top: 3px;
    padding: 0;
    margin-left: 2vh;
	}
	.btnr{

    text-align: center;
    margin-bottom: 3px;
    padding: 0;
    display: none;
}
	}
</style>
<div id="map">@include('partials.nav')</div>

 <script src="{!! asset('js/map.js') !!}">
 </script>
  <script src="{!! asset('js/pushbar.js') !!}">
 </script>
 <script src="{!! asset('js/mostrar.js') !!}">
 </script>
 <script>
        var pushbar=new Pushbar({
            blur:true,
            overlay:true

        });
</script>
    <script src="{!! asset('js/rutar.js') !!}"></script>

@endsection