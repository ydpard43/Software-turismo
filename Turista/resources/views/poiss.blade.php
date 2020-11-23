@extends('status')
@section('title','Listado de Pois')
@section('content')
 @include('partials.nav2')
    <div class="container">
        <header>
            <div class="logo">
                <h1>Puntos de interes</h1>
            </div>
            <form action="">
                <input type="text" class="barra-busqueda" id="barra-busqueda" placeholder="Busca un punto de interes">
            </form>

            <div class="categorias" id="categorias">
                <a href="#" class="activo">Todos</a>
                @foreach($municipios as $muni)
                <a href="#">{{$muni->nombre}}</a>
                @endforeach
            </div>
        </header>
        <!--Grip Productos-->
        <section class="grid" id="grid">
            @foreach($poi as $p)
            <div class="item" data-categoria="{{strtolower($p->nomm)}}" data-etiquetas="{{$p->nomm}} {{strtolower($p->nomm)}} {{$p->nomp}} {{strtolower($p->nomp)}}"
                data-descripcion="{{$p->nomp}}">
                <a href="{{route('ver',$p->nomp)}}" style="font-size: 18px; color:black;  display:block; text-align: center;" id="addon-wrapping">{{$p->nomp}}</a>
                <br>
                <div class="item-contenido" style="margin-top: 5px;">
                    <img src="img/{{$p->id_imagenpoi}}" alt="">
                </div>

                <div class="small"></div>

                <div class="input-group flex-nowrap">
                    <div class="input-group-prepend">

                    </div>
                    <div style="text-align: center;">
                    <a><img style="width: 15%;" src="img/estrella.png"><img style="width: 15%;" src="img/estrella.png"><img style="width: 15%;" src="img/estrella.png"><img  style="width: 15%;"src="img/estrella.png"><img  style="width: 15%;"src="img/estrella.png"></a>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
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