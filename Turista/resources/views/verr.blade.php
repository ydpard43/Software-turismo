@extends('status')
@section('parts')
@include('routes')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('title','Nueva ruta')

@section('content')
<div id="map">@include('partials.nav')</div>


 <script src="{!! asset('js/map.js') !!}">
 </script>
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
    <script>
var poi_ant; var time; var seconds = 0; var minutes = 0; var band=0;

var startTime = function(){
        seconds++;
        time = setTimeout("startTime()",1000);
        if(seconds > 59)  {seconds = 0; minutes++;}
        document.getElementById("minutes").value = minutes;
        document.getElementById("seconds").value = seconds;
}

function Start(){
    if (band==0) {
         startTime();
          band=1;}
        }
function Stop(){
      clearTimeout(time);
      band=0;
}
function Reset(){
    clearTimeout(time);
    minutes=0;
    seconds=0;
    document.getElementById("minutes").value = minutes;
    document.getElementById("seconds").value = seconds;
    band=0;
}
        var control;
        var n;
        var points;
   var n= document.getElementById('r');
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
n.addEventListener('change',
  function(){
    var selectedOption = $('#r').val();
    if (selectedOption!='-1'){
    $.ajax({
    type:"POST",
    url:"verr",
    data:{id_ruta:selectedOption},
    success: function(result){
if (!(typeof control =='undefined')) {
     control.spliceWaypoints(0,n);
     map.removeControl(control);
     Stop();
     $.ajax({
    type:"POST",
    url:"actuat",
    data:{id_ruta:poi_ant,time:minutes,seconds:seconds},
    success: function(re){
        console.log(re);
    }

});
}
minutes=result[0]['tiempo'];
seconds=result[0]['seconds'];
band=0;
Start();
        points = [];
for (var i = 0; i < result.length; i++) {
    if (result[i]['estado']) {
    points.push([result[i]['coordenadax'],result[i]['coordenaday']]);
}else{
    console.log('poi ya recorrido o saltado'+result[i]['nombre']);
}

}
 document.getElementById("porcent").innerHTML =(1-(points.length/result.length))*100+" %";
 document.getElementById('restantes').innerHTML=points.length;

n=points.length;
control = L.routing.control({
    waypoints: points,
    language:'es',
        serviceUrl: 'http://0.0.0.0:5000/route/v1'
}).addTo(map);
poi_ant=selectedOption;
       },
    error: function(){
                console.log('Error');
            }
})}
  });
    </script>
    <script src="{!! asset('js/rutar.js') !!}"></script>
@endsection