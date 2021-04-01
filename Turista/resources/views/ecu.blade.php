@extends('status')
@section('title','Nueva ruta')
@section('parts')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="card text-center">
        <div class="card-body">
          <h5 class="card-title titulo">Establecer formula de ruta</h5>
        @if(session('status'))
            {{session('status')}}
        @endif
        <form action="{{route('ecu')}}" onsubmit="funcionSubmit(event)" method="POST" name="formulario">
            @csrf
        <select style="margin-bottom: 10px;" name="formula" id="select_ecu">
        <option value="-1" selected> Seleccionar</option>
        @foreach($f as $ecuacion)
        <option value="{{$ecuacion->id_formula}}">{{$ecuacion->nombre}}</option>
        @endforeach
        </select>

        <div id="ecu">
        </div>
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
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  
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
    event.preventDefault();
        var max_var = document.getElementsByName("max_var[]");
    var factor = document.getElementsByName("factor[]");
    var factor_max=document.getElementsByName("factor_max[]");
    sum=0;
for (var i = 0; i < max_var.length; i++) {
      sum=sum+parseInt(max_var[i].value);
     }     
for(var i=0;i<factor.length;i++){
sum=sum+parseInt(factor[i].value)*parseInt(factor_max[i].value);  
    } 
    if ($('#select_ecu').val()!='-1' && sum=='100') {
    document.formulario.submit();
    }else{
      alert('Seleccione una opción valida');
    }         
}
$('#select_ecu').on('change', function(e){
if ($('#select_ecu').val()!='-1') {
 document.getElementById("ecu").innerHTML = "";
 var content="<h6>Explicación</h6> <ul "+"style='list-style: disc; margin-left: 5%; text-align: left;'"+">";
 var content1="<br><h5>Ecuación</h5>";
 var content2="";
 var content_ecu="";
 var variables="";
$.ajax({
    type:"POST",
    url:"variables",
    data:{id_formula:$('#select_ecu').val()},
    success: function(re){

for (var i=0; i< re[0].length;i++) {
 var n=re[0][i].count;
  for (var j =0; j<re[1].length; j++) {
     
    if(re[0][i].vi==  re[1][j].vi){
      if (re[0][i].count==1) {
       variables=variables+re[0][i].vn+" ("+re[1][j].fn+" * "+re[1][j].fp+") (Valor maximo "+re[0][i].vp+") + ";
       content_ecu=content_ecu+re[0][i].vn+" ("+re[1][j].fn+" * <input type=\"number\" name=\"factor_variable[]\" style=\"width: 10%;\" onchange=\"cambiar()\" value=\""+re[1][j].fp+"\">) (Valor maximo <input type=\"number\" name=\"max_var[]\" style=\"width: 10%;\" onchange=\"cambiar()\" value=\""+re[0][i].vp+"\" >) + ";
       content=content+'<li>'+re[0][i].vn+' : '+re[0][i].vd+'</li>'+''+'<li>'+re[1][j].fn+' : '+re[1][j].fd+'</li>'+'';
      }else if(re[0][i].count>1){
      
      if (j===0 && n!=1) {
     variables=variables+re[0][i].vn+" ("+re[1][j].fn+" * "+re[1][j].fp+" + ";
     content_ecu=content_ecu+re[0][i].vn+" ("+re[1][j].fn+" * <input type=\"number\" name=\"factor_variable[]\"  style=\"width: 10%;\" onchange=\"cambiar()\" value=\""+re[1][j].fp+"\" >+ ";
     content=content+'<li>'+re[0][i].vn+' : '+re[0][i].vd+'</li>'+''+'<li>'+re[1][j].fn+' : '+re[1][j].fd+'</li>'+'';
     n=n-1;
   }else if(n==1){
    variables=variables+""+re[1][j].fn+" * "+re[1][j].fp+") (Valor maximo "+re[0][i].vp+") + ";
    content_ecu=content_ecu+""+re[1][j].fn+" * <input type=\"number\" style=\"width: 10%;\" name=\"factor_variable[]\" onchange=\"cambiar()\" value=\""+re[1][j].fp+"\" >) (Valor maximo <input type=\"number\" name=\"max_var[]\" style=\"width: 10%;\" onchange=\"cambiar()\" value=\""+re[0][i].vp+"\" >) + ";
     content=content+''+'<li>'+re[1][j].fn+' : '+re[1][j].fd+'</li>'+'';
   }
   else if(n!=1){
    variables=variables+""+re[1][j].fn+" * "+re[1][j].fp+" + ";
    content_ecu=content_ecu+""+re[1][j].fn+" * <input type=\"number\" style=\"width: 10%;\" onchange=\"cambiar()\" value=\""+re[1][j].fp+"\"> + ";
    content=content+''+'<li>'+re[1][j].fn+' : '+re[1][j].fd+'</li>'+'';
    n=n-1;
   }
 }
    }
  }
}


    $.ajax({
    type:"POST",
    url:"factores",
    data:{id_formula:$('#select_ecu').val()},
    success: function(re){
for (var i =0; i<re.length; i++) {
  if (i!=re.length-1) {
     content2=content2+(''+re[i]['nombre']+' * '+re[i]['peso']+' + ');
     content_ecu=content_ecu+""+re[i]['nombre']+" * <input onchange=\"cambiar()\" name=\"factor[]\" style=\"width: 10%;\" type=\"number\" value=\""+re[i]['peso']+"\"> +" +"<input style=\"width: 10%;\"  name=\"factor_max[]\" type=\"hidden\" value=\""+re[i]['fm']+"\">"+"<input name=\"f_i[]\" type=\"hidden\" value=\""+re[i]['id_factor']+"\">"+"";
   }else{
     content2=content2+(''+re[i]['nombre']+' * '+re[i]['peso']+' ');
     content_ecu=content_ecu+""+re[i]['nombre']+" * <input style=\"width: 10%;\" name=\"factor[]\" onchange=\"cambiar()\" type=\"number\" value=\""+re[i]['peso']+"\">"+"<input style=\"width: 10%;\"  name=\"factor_max[]\" type=\"hidden\" value=\""+re[i]['fm']+"\">"+"<input name=\"f_i[]\" type=\"hidden\" value=\""+re[i]['id_factor']+"\">"+"";
   }
 content=content+'<li>'+re[i]['nombre']+' : '+re[i]['descripcion']+'</li>'+'';
}
var finalcontent=content1+variables+content2;
document.getElementById("ecu").innerHTML ="<div id=\"Variables\">"+finalcontent+"</div><br>"+"<div id=\"Explicacion\">"+content+"</ul></div>"+"<div id=\"personalizar\" style=\"display:none;\"> <h6>Cambiar ecuación</h6>"+content_ecu+" <p style=\"margin-top:5px; color:green;\" id=\"porcentaje\">Porcentaje total 100%</p> </div>"+"<br><input type=\"button\" id=\"btp\" class=\"btn btn-info btn-block mb-4\"  value=\"Personalizar\" onclick=\"(mostrar())\"> ";
    }});

    }});

}
});
  function mostrar() {
        $('#personalizar').show();
         $('#btp').hide();

      } 
function cambiar(){ 
    var max_var = document.getElementsByName("max_var[]");
    var factor = document.getElementsByName("factor[]");
    var factor_max=document.getElementsByName("factor_max[]");
     sum=0;
for (var i = 0; i < max_var.length; i++) {
      sum=sum+parseInt(max_var[i].value);
     }     
for(var i=0;i<factor.length;i++){
sum=sum+parseInt(factor[i].value)*parseInt(factor_max[i].value);  
    } 
if (sum==100) {
$('#porcentaje').text("Porcentaje total "+sum+"%");
$("#porcentaje").css("color", "green");
}else{
$('#porcentaje').text("Porcentaje total "+sum+"%");
$("#porcentaje").css("color", "red"); 
}
}
</script>
@endsection