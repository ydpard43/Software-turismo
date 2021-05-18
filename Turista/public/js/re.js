  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
   var band=0;
   var code;
   var correo;
        function funcionSubmit(event){
    event.preventDefault();
if (band==0) {
            $.ajax({
    type:"POST",
    url:"reepass",
    data:{email:$('#correo').val()},
    success: function(re){
      if (re.length>0) {
var letrasaceptadas = new Array('a', 'b', 'c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','x','y','z');
var numerosaceptados = new Array('1', '2', '3','4','5','6','7','8','9','10','11','12');
var combinacionl="";
var combinacionn="";
for (var i =0; i < (4+Math.floor(Math.random()*10)); i++) {
combinacionl=combinacionl+letrasaceptadas[Math.floor(Math.random()*letrasaceptadas.length)];
combinacionn=combinacionn+numerosaceptados[Math.floor(Math.random()*numerosaceptados.length)];
}
var combinacion= combinacionl+combinacionn;
$.ajax({
    type:"POST",
    url:"correo",
    data:{email:$('#correo').val(),codigo:combinacion},
    success: function(re){
    $('#correo').attr("id","codigo");
document.getElementById('codigo').type = 'text';
correo=$('#codigo').val();
$('#codigo').val('');
$('#label').contents().last()[0].textContent='Digita el codigo';
document.getElementById('button').type='';
code=combinacion;
band=1;
   $('#myAlert').fadeIn(1000); 
$('#myAlert').fadeOut(1000);
    }
  }
    );
      }else if (re.length==0){
        $('#correo').val('');
        $('#myAlert2').fadeIn(1000); 
        $('#myAlert2').fadeOut(1000);
    }
      }

});
}else if (band==1) {
if($('#codigo').val()== ''){
        $('#myAlert4').fadeIn(1000); 
        $('#myAlert4').fadeOut(1000);
}else if ($('#codigo').val()==code) {
        $('#myAlert3').fadeIn(1000); 
        $('#myAlert3').fadeOut(1000);
        $('#codigo').val('');
        $('#label').contents().last()[0].textContent='Digita una nueva contraseña';
        band=2;
         document.getElementById('codigo').minLength = 8;
}else if ($('#codigo').val()!=code) {
        $('#myAlert4').fadeIn(1000); 
        $('#myAlert4').fadeOut(1000);
}
}else if(band==2){
  if($('#codigo').val()== ''){
        $('#myAlert5').fadeIn(1000); 
        $('#myAlert5').fadeOut(1000);
  }else{
$.ajax({
    type:"POST",
    url:"cambiar",
    data:{email:correo,pass:$('#codigo').val()},
    success: function(re){
      $('#myAlert6').fadeIn(1000); 
      $('#myAlert6').fadeOut(1000);
      band=10;
      $('codigo').val('');
    }});
   }
}else if(band==10){
      $('#myAlert7').fadeIn(1000); 
      $('#myAlert7').fadeOut(10000);
}

}

