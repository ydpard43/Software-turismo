@extends('status')
@section('title','Nueva ruta')

@section('content')
<div class="mx-auto container">
    <div class="mx-auto card card-container">
        <span id="title"  class="mx-auto display-2">Nueva ruta</span>
        <br>
        <p id="profile-name" class="profile-name-card"></p>
        <span>Seleccione las tipologias</span>
        <hr>
        @if(session('status'))
            {{session('status')}}
        @endif
        <form action="{{route('nuevar')}}" method="POST">
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
                    @foreach($tp as $t)
                    <tr>
                      <td scope="col">{{$t->nombre}}</td>
                      <td><input style="margin-top: -7px; " type="checkbox" name="tip[]" value="{{$t->nombre}}"></td>
                    </tr>
                     @endforeach
                </tbody>
            </table>   
            </div>     
        </div>
        </div>
        <hr>
         <div style="display: block ruby; text-align: center;">
            <span style="color: #808080;">Tiempo disponible</span>
            <input type="text" name="time" style="width: 14%; padding-right: 0; padding-left: 0;text-align: center;"  class="" value="{{old('time')}}">
            {!!$errors->first('time','<span>:message</span>')!!}
            <span style="color: #808080;">Min</span>
        </div>
        <h5>Seleccione el tipo de delimitación</h5>
        <select name="del">
            <option value="0">Municipios</option>
            <option value="1">En mapa</option>
        </select>
        <hr>
        <div style="text-align: right; display: block; width: 100%;">
         <button type="submit" class="btnp">Siguiente</button>
        </div>
        </form>
        <br>
    </div>
</div>


@endsection