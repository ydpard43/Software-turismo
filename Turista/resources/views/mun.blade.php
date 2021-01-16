@extends('status')
@section('title','Delimitacion')

@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-2">Nueva ruta</span>
        <br>
        <p id="profile-name" class="profile-name-card"></p>
        <span>Seleccione los municipios</span>
        <hr>
        @if(session('status'))
            {{session('status')}}
        @endif
        <form action="{{route('mun')}}" method="POST">
            @csrf
        <div id="datos">
        <div style="padding: 14px; border-radius:25px; border:solid #80edff; ">
           <div class="table-responsive-lg" style="max-height: 100px; overflow-y: auto;
                       display: inline-block; overflow-x: hidden;">
            <table class="table">
                <thead>
                    <tr>
                      <th scope="col">Nombre</th>
                      <th scope="col">Opción</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mun as $mn)
                    <tr>
                      <td scope="col">{{$mn->nombre}}</td>
                      <td><input style="margin-top: -7px; " type="checkbox" name="mun[]" value="{{$mn->nombre}}"></td>
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
            <a href="{{route('nuevar')}}">Atras</a>
            <button type="submit" class="btnp">Siguiente</button>
        </div>
        </form>
        <br>
    </div>
</div>


@endsection