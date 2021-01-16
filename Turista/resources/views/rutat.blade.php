@extends('status')
@section('title','Nueva ruta')

@section('content')
<style>
    .leaflet-routing-container-hide {display: none;}
</style>
<div id="map"></div>
   <form  action="{{route('rutat')}}" name="formulario" method="POST">
    @csrf
    <input type="text" name="pois" id="pois">
    <input type="text" name="pp" id="pp">
   </form>
 <script src="{!! asset('js/map.js') !!}">
 </script>
 <script>
    var app = @json($pun);
    var t= @json($t);
    var tt=@json(session('time'));
    var tt=500;
    var estiloPopup = {'maxWidth': '300'};
    var sitios=[];
    var sitios2=[];
    var distancias=[];
    var long;
    var ruta;
    var band=0;
    var cx;
    var cy;
    var poi=new Array;
    var resta;
    var rt=[];
     
     for (var i =0; i < app.length; i++) {
        for(var j in t){
        if (app[i]==j) {
        if (band==0) {
        cx=t[j]['cx'];
        cy=t[j]['cy'];
        band=1;
        }else {
    L.Routing.control({
    waypoints: [
        L.latLng(cx, cy),
        L.latLng(t[j]['cx'],t[j]['cy'])
    ],show: false,
    addWaypoints: false,
    routeWhileDragging: false,
      lineOptions: {
      styles: [{color: 'white', opacity: 0, weight: 0}]
   },
     createMarker: function() { return null;},
    timeTemplate:'{time}'
            }).on('routesfound', function (e) {
            var routes = e.routes;
             var summary = routes[0].summary;
            rt.push(Math.ceil(summary.totalTime/60));
                       }).addTo(map); 
        }

    
        }
        }

     }
function pp(e) {
    $('#pp').val(e);
    sitios2=[];
    distancias=[];
  for (var i=0; i < sitios.length; i++) {
    if (i==0) {
      sitios2.push(e);
    if (sitios[i]!=e) {
       sitios2.push(sitios[i]); 
    }
      
  }else if(sitios[i]!=e){

     sitios2.push(sitios[i]);

  }
  }
   poi=new Array(sitios.length);
    for (var i =0; i < poi.length; i++) {
    poi[i]=new Array(sitios.length);
    }
    for (var b =0; b < poi.length; b++) {
    for (var c =0; c < poi.length; c++) {
    if (b==c) {
    poi[b][c]=-1;
    }else{
    L.Routing.control({
    waypoints: [
        L.latLng(t[sitios2[b]]['cx'],t[sitios2[b]]['cy']),
        L.latLng(t[sitios2[c]]['cx'],t[sitios2[c]]['cy'])
    ],show: false,
  
    routeWhileDragging: false,
       lineOptions: {
       addWaypoints: false
   },
     createMarker: function() { return null;}
            }).on('routesfound', function (e) {
            var routes = e.routes;
             var summary = routes[0].summary;
            distancias.push(summary.totalDistance);
                       }).addTo(map);
    
    }
    }
    }
   console.log(poi);
}

L.easyButton('<img src="img/enviar.png" style="width:15px;">', function(btn, map){

if (rt.length==(app.length-1)) {
for (var i = 0; i < app.length; i++) {
if (i=='0'){
tt=tt-t[app[i]]['tiempo'];
}else{
var sum=parseInt(t[app[i]]['tiempo'])+parseInt(rt[i-1]);
tt=tt-sum;
}if (tt>=0) {
sitios.push(app[i]);
L.marker([t[app[i]]['cx'],t[app[i]]['cy']],{draggable: false}).bindPopup("<h1>"+t[app[i]]['nombre']+"</h1><p>Ni idea de que poner aqui.</p><input type='button' value='Punto de partida' onclick='(pp("+app[i]+"))'>",estiloPopup).addTo(map);   
}
}
$('#pois').val(sitios);
}else{
alert('La pagina aun no se ha cargado');
}

//document.formulario.submit();

}).addTo(map);
L.easyButton('<img src="img/enviar.png" style="width:15px;">', function(btn, map){
var a=0;
if (!(typeof poi == 'undefined')) {
    for (var b =0; b < poi.length; b++) {
    for (var c =0; c < poi.length; c++) {
      if (b!=c) {
      poi[b][c]=distancias[a];
      console.log('posicion b'+b+' en c '+c+' a '+a);
      a=a+1;
      
      }

    }}



//document.formulario.submit();

}}).addTo(map);
 </script>
@endsection