@extends('status')
@section('title','Nueva ruta')
@section('content')
        @if(isset($msg))
                <div class="alert alert-danger alert-dismissible fade show" id="myAlert" role="alert">
            <strong>{{$msg}}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="cerrar()" aria-label="Close"></button>
        </div>
         @endif
        @if(session('status'))
        <div class="alert alert-danger alert-dismissible fade show" id="myAlert" role="alert">
            <strong>{{session('status')}}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="cerrar()" aria-label="Close"></button>
              </div>
        @endif
<div class="card">
    <div class="card-body">
        <h2 class="card-title titulo" style="text-align: center;">Nueva ruta</h2>
        <h5 style="margin-bottom: 10px;">Seleccione las tipologias</h5>
        <form action="{{route('nuevar')}}" method="POST">
            @csrf
        <div id="datos">
        <div>
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
         <div class="text-center">
            <span style="color: #808080;">Tiempo disponible</span>
            <input type="number" name="time" id="time" readonly required value="60"  min="60" max="500"style="width: 20%; padding-right: 0; padding-left: 0;text-align: center;" onkeypress="return valida(event)" class="" value="{{old('time')}}">
            {!!$errors->first('time','<span>:message</span>')!!}
            <span style="color: #808080;">Min</span>
            <input type="checkbox" id="check" checked>
        </div>
        <br>
        <div class="text-center">
        <span>Seleccione el tipo de delimitación : </span>
        <select name="del">
            <option value="0">Municipios</option>
            <option value="1">En mapa</option>
        </select>
        </div>
<br>
        <div class="text-center">
        <span>Seleccione la modalidad: </span>
        <select name="mod">
            <option value="0">En carro</option>
            <option value="1">A pie</option>
            <option value="2">En bicicleta</option>
        </select>
        </div>
<div style="margin-top: 20px; text-align: right;">
         <a class="btn btn-info  mb-3" href="{{route('home')}}">Volver al inicio</a>
         <button type="submit" class="btn btn-primary mb-3">Siguiente</button>
</div>
        </form>
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
<script>
     function cerrar(){
    $('#myAlert').hide();
   }

</script>
@endsection