@extends('status')
@section('title','Nueva ruta')

@section('content')
<div class="card text-center">
        <div class="card-body">
         <div class="modal fade" id="info" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1"aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal"aria-label="Close"></button>
                  </div>
                  <div class="modal-body"></div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                      Close
                    </button>
                    <button type="button" class="btn btn-primary">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
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
        <p id="porcentaje">Porcentaje total 100%</p>
        <input type="button" class="btn btn-success btn-block mb-4" data-mdb-toggle="modal" data-mdb-target="#info" value="Ayuda">
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
$('input[type="number"]').on('change', function(e){
      
     cantidad = document.getElementsByName("pesos[]");
     sum=0;
for(var i=0;i<cantidad.length;i++){
sum=sum+(cantidad[i].value*app[i]['valormaximo']);    
    }    
$('#porcentaje').text("Porcentaje total "+sum+"%");
});
</script>
@endsection