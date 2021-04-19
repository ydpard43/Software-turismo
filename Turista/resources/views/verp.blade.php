@extends('status')
@section('title',$poi[0]->nomp)
@section('content')
 @include('partials.nav3')
 @php
 $a[0]=0;
 $c=5-$estrellas;
 @endphp
 <div class="card presentacion">
        <img
          src="../img/{{$poi[0]->imagen}}"
          class="card-img-top"
          alt="..."
          style="width: 100%;"
        />
        <div class="card-body">
          <h5 class="card-title ">{{$poi[0]->nomp}}</h5>
          <div class="container">
            <div class="row">
              <div class="col-md">
                Ubicación: {{$poi[0]->nomm}}
              </div>
              <div class="col-md">
                Tipologia(s): 
                @foreach($poi as $on =>$value)
                @if($on==0)
                {{$value->nombre}}
                @else
                 ,{{$value->nombre}}
                 @endif
                @endforeach
              </div>
              <div class="col-md">
                Costo : @if($poi[0]->costo >0) $ {{$poi[0]->costo >0}}@endif @if($poi[0]->costo==0) Ninguno    @endif
              </div>
              <p class="mt-2">Descripción: {{$poi[0]->descripcion}}</p>

            <small class="text-muted">
            @for($i=0;$i<$estrellas;$i++)
            <i style="font-size: 22px;" class="fa fa-star star-act" aria-hidden="true"></i>
            @endfor
                @for($i=0;$i<$c;$i++)
            <i style="font-size: 22px;" class="fa fa-star" aria-hidden="true"></i>
            @endfor
            </small>
            <br>
            @if(!empty($opiniones))
            <div class="opiniones">
              <h5 class="card-title mb-3">Opiniones</h5>
              </div>
            @endif
            @foreach($opiniones as $op)
            @if(($op->id_turista)!=(session('id')))
              <div class="card m-0 mb-3" >
                <div class="row g-0">
                  <div class="col-md-12">
                    <div class="card-body p-3">
                        <h5 class="card-title">{{$op->alias}}</h5>
                        <p class="card-text">
                          <small class="text-muted">
                            @for($i=0;$i<$op->estrellas;$i++)
                            <i style="font-size: 22px;" class="fa fa-star star-act" aria-hidden="true"></i>
                            @endfor
                                @for($i=0;$i<(5-$op->estrellas);$i++)
                            <i style="font-size: 22px;" class="fa fa-star" aria-hidden="true"></i>
                            @endfor
                          </small>
                        </p>
                         <p class="card-text mb-0">
                          {{$op->opinion}}
                        </p>
                      </div>
                  </div>
                </div>
              </div>
              @else
            <div class="card m-0 mb-3" >
                <div class="row g-0">
                  <div class="col-md-12">
                    <div class="card-body p-3">
                        <h5 class="card-title">{{$op->alias}}</h5>
                        <p class="card-text">
                          <small class="text-muted">
                            @for($i=0;$i<$op->estrellas;$i++)
                            <i style="font-size: 22px;" class="fa fa-star star-act" aria-hidden="true"></i>
                            @endfor
                             @for($i=0;$i<(5-$op->estrellas);$i++)
                            <i style="font-size: 22px;" class="fa fa-star" aria-hidden="true"></i>
                            @endfor
                          </small>
                        </p>
                         <p class="card-text mb-0">
                          {{$op->opinion}}
                        </p>
                        <div style="text-align: right;">
                          <button class="btn btn-primary"  data-mdb-toggle="modal" data-mdb-target="#exampleModal">Cambiar</button>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="card-title mb-3 mt-3">Escribe tu opinión</h5>
        <button
          type="button"
          class="btn-close"
          data-mdb-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
                       
              <form action="{{route('aopoi')}}" method="post">
                @csrf
                @php
                    $a[0]=1;
                    @endphp
                <div class="form-outline mb-4">
                    <textarea minlength="5" maxlength="100" required class="form-control"style="background: #f1f1f1;"id="form" name="op" rows="4">{{$op->opinion}}</textarea>
                    <label class="form-label" for="form">Reseña</label>
                </div>
                 <input type="hidden" name="poi" value="{{$poi[0]->id_poi}}">
                 <p class="clasificacion">
                    <input id="radio1" type="radio" name="estrellas" value="5">
                    <label  class="fa fa-star" aria-hidden="true" style="font-size: 25px;" for="radio1"></label>
                    <input id="radio2" type="radio" name="estrellas" value="4">
                    <label  class="fa fa-star" aria-hidden="true" style="font-size: 25px;" for="radio2"></label>
                    <input id="radio3" type="radio" name="estrellas" value="3">
                    <label  class="fa fa-star" aria-hidden="true" style="font-size: 25px;" for="radio3"></label>
                    <input id="radio4" type="radio" name="estrellas" value="2">
                    <label  class="fa fa-star" aria-hidden="true" style="font-size: 25px;" for="radio4"></label>
                    <input id="radio5" type="radio" name="estrellas" value="1">
                    <label  class="fa fa-star" aria-hidden="true" style="font-size: 25px;" for="radio5"></label>
                  </p>
        <button type="submit" class="btn btn-primary">
          Guardar
        </button>
        <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Cerrar</button>
            </form> 
      </div>

    </div>
  </div>
</div>
              @endif
              @endforeach


            </div>
          </div>
                  @if((session()->has('nombre')))
        @if($a[0]==0)
        <form action="{{route('insertpoi')}}" onsubmit="validar(event)" name="formulario" id="formulario" method="post">
            @csrf
            <h5 class="card-title mb-3 mt-3">Escribe tu opinión</h5>
                <div class="form-outline mb-4">
                    <textarea class="form-control" required minlength="5" maxlength="100" style="background: #f1f1f1;"id="form" name="op" rows="4"></textarea>
                    <label class="form-label" for="form">Reseña</label>
                </div>
                 <input type="hidden" name="poi"  value="{{$poi[0]->id_poi}}">
                 <p class="clasificacion">
                    <input id="radio1" type="radio" name="estrellas" value="5">
                    <label  class="fa fa-star" aria-hidden="true" style="font-size: 25px;" for="radio1"></label>
                    <input id="radio2" type="radio" name="estrellas" value="4">
                    <label  class="fa fa-star" aria-hidden="true" style="font-size: 25px;" for="radio2"></label>
                    <input id="radio3" type="radio" name="estrellas" value="3">
                    <label  class="fa fa-star" aria-hidden="true" style="font-size: 25px;" for="radio3"></label>
                    <input id="radio4" type="radio" name="estrellas" value="2">
                    <label  class="fa fa-star" aria-hidden="true" style="font-size: 25px;" for="radio4"></label>
                    <input id="radio5" type="radio" name="estrellas" value="1">
                    <label  class="fa fa-star" aria-hidden="true" style="font-size: 25px;" for="radio5"></label>
                  </p>
                  <input type="hidden" name="poi" value="{{$poi[0]->id_poi}}">
                  <div>
                    <div style="text-align: right;">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                  </div>
                </form>
                @endif
                @endif
        </div>

      </div>

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
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>
<script>
  function validar(event) {
       event.preventDefault();
     if (  $('#radio1').is(':checked') ||   $('#radio2').is(':checked') ||   $('#radio3').is(':checked') ||   $('#radio4').is(':checked') ||   $('#radio5').is(':checked')) {
       document.formulario.submit();
     }else{
      console.log('not');
     }
  }
  
</script>
 @endsection