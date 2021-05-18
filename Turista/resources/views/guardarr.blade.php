@extends('status')
@section('title','Guardar ruta')
@if(!isset($rt))
@php
return redirect()->to('/')->send();
@endphp
@endif
@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title titulo" style="text-align: center;">Rutas disponibles</h2>
        <h5 style="margin-bottom: 10px;">Seleccione la ruta de su agrado</h5>
        @if(session('status'))
            {{session('status')}}
        @endif
        <form action="{{route('guardarr')}}" onsubmit="funcionSubmit(event)" method="POST">
            @csrf
        <div id="datos">
        <div style="padding: 14px; border-radius:25px; border:solid #80edff; ">
           <div class="table-responsive-lg" style="max-height: 230px; overflow-y: auto;
                       overflow-x: hidden;">
            <table class="table table-borderless">
                <thead>
                </thead>
                <tbody>
                    @foreach($rt as $t=>$value)
                    <tr>
                      <td><input style="margin-top: -7px; display: initial;" required type="radio" onclick="actualizar({{$t}})" name="tip" value="{{$t}}">
                        @for($i=0;$i<count($value);$i++)
                       
                        @if($i!=(count($value)-1))
                        {{$p[$value[$i]]}},
                        @endif
                        @if($i===(count($value)-1))
                        {{$p[$value[$i]]}}
                        @endif
                        @endfor
                      </td>
                    </tr>
                     @endforeach
                </tbody>
            </table>
            <input type="hidden" name="indice" id="indice">   
            </div>     
        </div>
        </div>
        <hr>
         <button type="submit" class="btn btn-primary btn-block mb-4">Siguiente</button>
        </form>
        <br>
    </div>
</div>
<script>
    var select;
     var app = @json($rt);
     var route=@json($p);
    function actualizar(a) {
            select=a;
            $('#indice').val(app[select]);
        }
</script>
@endsection