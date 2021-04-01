@extends('status')
@section('title','Listado de Pois')
@section('content')
 @include('partials.nav2')
    <div class="container">
        <header>
            <div class="logo">
                <h1>Listado de rutas</h1>
            </div>
                <input type="text" class="barra-busqueda" id="barra-busqueda" placeholder="Busca una ruta">
        </header>
        <div class="grid" id="grid">
            @foreach($rutas as $p)
            <div class="item" data-categoria="{{strtolower($p->nombre)}}" data-etiquetas="{{$p->nombre}} {{strtolower($p->nombre)}} {{$p->nombre}} {{strtolower($p->nombre)}}"
                data-descripcion="{{$p->nombre}}">
                <div class="item-contenido" >
                <div >
                <div class="col">
                <div class="card">
                     <a style="color: #4f4f4f;" href="{{route('detalle',$p->nombre)}}">
                 <div class="slider">
            <ul>
                @foreach($img as $imagen)
                @if($imagen->id_ruta==$p->id_ruta)
                    <li>
                         <img src="img/{{$imagen->imagen}}" alt="..">         
                    </li>
                @endif
                @endforeach
            </ul>
             </div>
                   </a>
                  <div class="card-body">
                    <a style="color: #4f4f4f;" href="{{route('detalle',$p->nombre)}}">
                    <h5 style="font-size: 1rem;" class="card-title">{{$p->nombre}}</h5>
                    </a>
                  </div>
                </div>
              </div>
                </div>
            </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="https://unpkg.com/web-animations-js@2.3.2/web-animations.min.js"></script>
    <script src="https://unpkg.com/muuri@0.9.3/dist/muuri.min.js"></script>
    <script src="{!! asset('js/main.js') !!}"></script>
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