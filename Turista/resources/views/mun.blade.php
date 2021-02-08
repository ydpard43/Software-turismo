@extends('status')
@section('title','Delimitacion')

@section('content')
<div class="card presentacion">
    <div class="card-body">
        <h2 class="card-title titulo" style="text-align: center;">Nueva ruta</h2>
        <span>Seleccione los municipios</span>
        <hr>
        @if(session('status'))
            {{session('status')}}
        @endif
        <form action="{{route('mun')}}" method="POST">
            @csrf
        <div id="datos">
        <div style="padding: 14px; border-radius:25px; border:solid #80edff; ">
           <div class="table-responsive-lg" style="max-height: 230px; overflow-y: auto;
                        overflow-x: hidden;">
            <table class="table table-borderless">
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mun as $mn)
                    <tr>
                      <td scope="col"><input style="margin-top: -7px; " type="checkbox" name="mun[]" value="{{$mn->nombre}}">  {{$mn->nombre}}</td>
                    </tr>
                     @endforeach
                </tbody>
            </table>   
            </div>     
        </div>
        </div>
        <br>
        <br>
        <div style="text-align: right; display: block; width: 100%;">
            <a class="btn btn-info"href="{{route('nuevar')}}">Atras</a>
            <button type="submit" class="btn btn-primary">Siguiente</button>
        </div>
        </form>
        <br>
    </div>
</div>


@endsection