@extends('status')
@section('title','iniciar')
@section('content')

   <div id="map"> @include('partials.nav')</div>

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
 @endsection
