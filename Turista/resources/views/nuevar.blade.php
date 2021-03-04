@extends('status')
@section('title','Nueva ruta')

@section('content')
<div class="card presentacion">
    <div class="card-body">
        <h2 class="card-title titulo" style="text-align: center;">Nueva ruta</h2>
        <h5 style="margin-bottom: 10px;">Seleccione las tipologias</h5>
        @if(session('status'))
            {{session('status')}}
        @endif
        <form action="{{route('nuevar')}}" method="POST">
            @csrf
        <div id="datos">
        <div style="padding: 14px; border-radius:25px; border:solid #80edff; ">
           <div class="table-responsive-lg" style="max-height: 230px; overflow-y: auto;
                       overflow-x: hidden;">
            <table class="table table-borderless">
                <thead>
                </thead>
                <tbody>
                    @foreach($tp as $t)
                    <tr>
                      <td><input style="margin-top: -7px; " type="checkbox" name="tip[]" value="{{$t->nombre}}">   {{$t->nombre}}</td>
                      
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

            <input type="number" name="time" id="time" readonly required value="60"  min="60" max="500"style="width: 14%; padding-right: 0; padding-left: 0;text-align: center;" onkeypress="return valida(event)" class="" value="{{old('time')}}">
            {!!$errors->first('time','<span>:message</span>')!!}
            <span style="color: #808080;">Min</span>
            <input type="checkbox" id="check" checked>
        </div>
        <h5>Seleccione el tipo de delimitación</h5>
        <select name="del">
            <option value="0">Municipios</option>
            <option value="1">En mapa</option>
        </select>
<hr> 
         <button type="submit" class="btn btn-primary btn-block mb-4">Siguiente</button>
        </form>
        <br>
    </div>
</div>

<script>
        function valida(e) {
            tecla = (document.all) ? e.keyCode : e.which; 
            if (tecla==8) return true;
            else if (tecla==0||tecla==9)  return true;
           patron =/[0-9\s]/;
            te = String.fromCharCode(tecla);
            return patron.test(te); 
        } 
        $('#check').on('change', function(e){
    if (this.checked) {
        $('#time').val('60');
         $('#time').attr("readonly", true);
    } else {
         $('#time').attr("readonly", false);
    }
});
</script>
@endsection