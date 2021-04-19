@extends('status')
@section('title','Listado de Pois')
@section('content')
 @include('partials.nav2')
    <div class="container">
        <header>
            <div class="logo">
                <h1>Puntos de interes</h1>
            </div>
                <input type="text" class="barra-busqueda" id="barra-busqueda" placeholder="Busca un punto de interes">
            <div class="categorias" id="categorias">
                <a href="#" class="activo">Todos</a>
                @foreach($municipios as $muni)
                <a href="#">{{$muni->nombre}}</a>
                @endforeach
            </div>
        </header>
        <div class="grid" id="grid">
            @foreach($poi as $p)
            <div class="item" data-categoria="{{strtolower($p->nomm)}}" data-etiquetas="{{$p->nomm}} {{strtolower($p->nomm)}} {{$p->nomp}} {{strtolower($p->nomp)}}"
                data-descripcion="{{$p->nomp}}">
                <div class="item-contenido" >
                <div class="" >
                <div class="col h-100">
                <div class="card">
                     <a style="color: #4f4f4f;" href="{{route('ver',$p->nomp)}}">
                  <img
                    src="img/{{$p->imagen}}"
                    class="card-img-top"
                    alt="..."
                  />
                   </a>
                  <div class="card-body">
                    <a style="color: #4f4f4f;" href="{{route('ver',$p->nomp)}}">
                    <h5 style="font-size: 1rem;" class="card-title">{{$p->nomp}}</h5>
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