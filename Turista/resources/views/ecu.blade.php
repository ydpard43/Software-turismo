@extends('status')
@section('title','Nueva ruta')

@section('content')
<div class="card text-center">
        <div class="card-body">
          <h5 class="card-title titulo">Ajustar formula</h5>
        @if(session('status'))
            {{session('status')}}
        @endif
        <form action="{{route('ecu')}}" onsubmit="funcionSubmit(event)" method="POST" name="formulario">
            @csrf

        @foreach($f as $pesos)
        <div class="form-outline mb-4">
        <input type="number" id="form1" class="form-control" onkeypress="return valida(event)" name="pesos[]" value="{{$pesos->peso}}">
        <label class="form-label" for="form1" >{{$pesos->nombre}} factor:{{$pesos->valormaximo}}</label >
        <input type="hidden" name="id[]"  value="{{$pesos->id_formula}}">
        </div>
        @endforeach
         <button type="submit" class="btn btn-primary btn-block mb-4">Siguiente</button>
        </form>
    </div>
</div>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>
<script>
    var app = @json($f);
    var sum=0;
    function valida(e) {
            tecla = (document.all) ? e.keyCode : e.which; 
            if (tecla==8) return true;
            else if (tecla==0||tecla==9)  return true;
           patron =/[0-9\s]/;
            te = String.fromCharCode(tecla);
            return patron.test(te); 
        }
        function funcionSubmit(event){
    // esta linea detiene la ejecucion del submit
    sum=0;
    event.preventDefault();
  cantidad = document.getElementsByName("pesos[]");
for(var i=0;i<cantidad.length;i++){
sum=sum+(cantidad[i].value*app[i]['valormaximo']);
    }
    if (sum==100) {
      document.formulario.submit();  
    }else{
        alert('Los valores no suman 100%');
    }
}
</script>
@endsection