@extends('status')
@section('parts')
@include('routes')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('title','Inicio')

@section('content')
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
    <script>

    </script>
    <script src="{!! asset('js/rutar.js') !!}"></script>
@endsection