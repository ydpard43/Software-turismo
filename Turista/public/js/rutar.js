var poi_ant; 
var time; 
var seconds = 0; 
var minutes = 0; 
var hora=0; 
var band=0;
var estiloPopup = {'maxWidth': '300'};
var control; 
var n; var points; 
var pointa; 
var nm; 
var img; 
var estado;
var posicion;
var n= document.getElementById('r');
var pos = L.icon({
    iconUrl: 'img/ubicacion.png',
    iconSize:     [45, 45], 
    iconAnchor:   [30, 30], 
    popupAnchor:  [-7,-20] 
});
var check = L.icon({
    iconUrl: 'img/check.png',
    iconSize:     [45, 45], 
    iconAnchor:   [30, 30], 
    popupAnchor:  [-10,-20] 
});
var rst = new L.Icon({
  iconUrl: 'img/restaurante.png',
  iconSize: [50, 50],
  iconAnchor: [25, 50]
});
var ht = new L.Icon({
  iconUrl: 'img/hotel.png',
  iconSize: [50, 50],
  iconAnchor: [25, 50]
});
var gr = new L.Icon({
  iconUrl: 'img/gas.png',
  iconSize: [50, 50],
  iconAnchor: [25, 50]
});
var hsp = new L.Icon({
  iconUrl: 'img/hospital.png',
  iconSize: [50, 50],
  iconAnchor: [25, 50]
});
function icon(n_icon){
  var nic=n_icon+1;

 return new L.Icon({
  iconUrl: 'img/'+nic+'.png',
  iconSize: [45, 45],
  iconAnchor: [30, 30],
  popupAnchor:  [-10,-20] 
});
}
var startTime = function(){
        seconds++;
        time = setTimeout("startTime()",1000);
        if(seconds > 59)  {seconds = 0; minutes++;}
        if (minutes> 59)  {minutes=0;hora++;}
         $('#hora').text(hora);
        $('#minutes').text(minutes);
        $('#seconds').text(seconds);
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
    hora=0;
    minutes=0;
    seconds=0;
    $('#hora').text(hora);
    $('#minutes').text(minutes);
    $('#seconds').text(seconds);
    band=0;
     $.ajax({
    type:"POST",
    url:"reset",
    data:{id_ruta:poi_ant}
});
}
   
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
if ( !(n ===null)) {
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
    data:{id_ruta:poi_ant,minutes:minutes,seconds:seconds,hora:hora}
});
}
hora=result[0]['hora'];
minutes=result[0]['minutos'];
seconds=result[0]['segundos'];
band=0;
Start();
        points = [];
        nm=[];
        img=[];
        pointa=[];
        estado=[];

for (var i = 0; i < result.length; i++) {
    img.push(result[i]['imagen']);
    nm.push(result[i]['nombre']);
    points.push([result[i]['coordenadax'],result[i]['coordenaday']]);
    estado.push(result[i]['estado']);
    if (result[i]['estado']) {
    pointa.push([result[i]['coordenadax'],result[i]['coordenaday']]);
}
}
 document.getElementById("porcent").innerHTML =(1-(pointa.length/result.length))*100+"%";
 document.getElementById('restantes').innerHTML=pointa.length;
n=points.length;
control = L.routing.control({
    waypoints: points,
    language:'es',
    serviceUrl: 'http://0.0.0.0:5000/route/v1',
     routeWhileDragging: false,
     addWaypoints: false,
      createMarker: function(i, wp, nWps) {
    if (estado[i]) {
      return L.marker(wp.latLng, {
        icon: icon(i) 
      }).bindPopup("<h5 style='text-align:center;'>"+nm[i]+"</h5 ><p><img style='width:100%;' src='img/"+img[i]+"'></p>",estiloPopup);
    } else {
      return L.marker(wp.latLng, {
        icon: check
      }).bindPopup("<h5 style='text-align:center;'>"+nm[i]+"</h5>Recorrido<p><img style='width:100%;' src='img/"+img[i]+"'></p>",estiloPopup);}}
}).addTo(map);
poi_ant=selectedOption;
       },
    error: function(){
                
            }
})}
  });}
 

    function onLocationFound(e) {
 if (posicion) {
          map.removeLayer(posicion);
      }
    if (!(typeof points =='undefined')) {
     for (var i =0; i< points.length; i++) {
     var km=getKilometros(points[i][0],points[i][1],e.latlng['lat'],e.latlng['lng']).toFixed(4);
       if( km<(0.015).toFixed(4)){
        if (!(control['_plan']['_markers'][i]['_icon'].getAttribute('src')=='img/check.png')) {
          control['_plan']['_markers'][i]['_icon'].setAttribute('src','img/check.png');
          $('#restantes').text((parseInt($('#restantes').text())-1));
          $('#porcent').text((1-parseInt($('#restantes').text())/points.length)*100+'%');
    $.ajax({
    type:"POST",
    url:"actuareco",
    data:{id_ruta:poi_ant,coordenadax:points[i][0],coordenaday:points[i][1]}
    
});

               }}
     }}
      posicion = L.marker(e.latlng,{icon: pos}).bindPopup("<h5>Mi posición</h5>").addTo(map);
      
    }
    map.on('locationfound', onLocationFound); 
    function locate() {
      map.locate({setView: false});
    }
    setInterval(locate, 3000);
     getKilometros = function(lat1,lon1,lat2,lon2)
 {
 rad = function(x) {return x*Math.PI/180;}
var R = 6378.137;
 var dLat = rad( lat2 - lat1 );
 var dLong = rad( lon2 - lon1 );
var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(rad(lat1)) * Math.cos(rad(lat2)) * Math.sin(dLong/2) * Math.sin(dLong/2);
 var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
 var d = R * c;
return d; 
 }



 L.control.custom({
    position: 'bottomleft',
    content : '<button type="button" id="mostrar" class="btn btn-success btn1" style="border-radius: 25px;width: 40px;height: 40px;">'+
              '    <i class="fas fa-search"></i>'+
              '</button>'+
              '<button type="button" id="restaurants" class="btn btn-info btnr" style="border-radius: 25px;width: 36px;height: 36px; margin-left: 2vh;">'+
              '    <i class="fas fa-utensils"></i>'+
              '</button>'+
              '<button type="button" id="hotel" class="btn btn-primary btnr" style="border-radius: 25px;width: 36px;height: 36px; margin-left: 2vh;">'+
              '    <i class="fa fa-hotel"></i>'+
              '</button>'+
              '<button type="button" id="gas" class="btn btn-danger btnr" style="border-radius: 25px;width: 36px;height: 36px; margin-left: 2vh;">'+
              '    <i class="fa fa-gas-pump"></i>'+
              '</button>'+
              '<button type="button" id="hospital" class="btnr btn btn-info btnr" style="border-radius: 25px;width: 36px;height: 36px; margin-left: 2vh;">'
              +'<i class="fa fa-ambulance"></i>'+ 
              '</button>'
              ,
    classes : 'btn-group-vertical btn-group',
    style   :
    {
           
        margin: '10px',
        cursor: 'pointer',
    }
})
.addTo(map);
var b= document.getElementById('mostrar');
var restaurants= document.getElementById('restaurants');
var hotel= document.getElementById('hotel');
var gas= document.getElementById('gas');
var hospital= document.getElementById('hospital');
var puntos;
b.addEventListener("click", function(){
    if (!$('#restaurants').is(':visible')) {
    $('.btnr').show();
  }else{
    $('.btnr').hide();
  }


});
restaurants.addEventListener("click", function(){
    if (sitios.length>0) {
    for (var i =0; i< sitios.length; i++) {
     map.removeLayer (sitios[i]);
     
    }
      sitios=[];
  }
$.ajax({
    type:"POST",
    url:"sites",
    data:{sites:'Restaurante'},
    success: function(result){
      for(var i=0;i<result.length;i++){
      var km=getKilometros(posicion._latlng.lat,posicion._latlng.lng,result[i].coordenadax,result[i].coordenaday);
        if (km<2) {
        var marcador=new L.marker([result[i].coordenadax,result[i].coordenaday],{icon:rst});
        sitios.push(marcador);
        map.addLayer(sitios[i]);
      }
    }}
    
});
});
hotel.addEventListener("click", function(){
    if (sitios.length>0) {
    for (var i =0; i< sitios.length; i++) {
     map.removeLayer (sitios[i]);
     
    }
      sitios=[];
  }
  $.ajax({
    type:"POST",
    url:"sites",
    data:{sites:'Hotel'},
    success: function(result){
      for(var i=0;i<result.length;i++){
        var km=getKilometros(posicion._latlng.lat,posicion._latlng.lng,result[i].coordenadax,result[i].coordenaday);
        if (km<2) {
        var marcador=new L.marker([result[i].coordenadax,result[i].coordenaday],{icon:ht});
        sitios.push(marcador);
        map.addLayer(sitios[i]);
       }
      }
    }
    
});

});
gas.addEventListener("click", function(){
    if (sitios.length>0) {
    for (var i =0; i< sitios.length; i++) {
     map.removeLayer (sitios[i]);
    }
      sitios=[];
  }
  $.ajax({
    type:"POST",
    url:"sites",
    data:{sites:'Gasolinera'},
    success: function(result){
      for(var i=0;i<result.length;i++){
                var km=getKilometros(posicion._latlng.lat,posicion._latlng.lng,result[i].coordenadax,result[i].coordenaday);
        if (km<5) {
        var marcador=new L.marker([result[i].coordenadax,result[i].coordenaday],{icon:gr});
        sitios.push(marcador);
        map.addLayer(sitios[i]);}
      }
    }
    
});

});
hospital.addEventListener("click", function(){
  if (sitios.length>0) {
    for (var i =0; i< sitios.length; i++) {
     map.removeLayer (sitios[i]);
    }
      sitios=[];
  }
  $.ajax({
    type:"POST",
    url:"sites",
    data:{sites:'Hospital'},
    success: function(result){
      for(var i=0;i<result.length;i++){
        var km=getKilometros(posicion._latlng.lat,posicion._latlng.lng,result[i].coordenadax,result[i].coordenaday);
        if (km<5) {
        var marcador=new L.marker([result[i].coordenadax,result[i].coordenaday],{icon:hsp});
        sitios.push(marcador);
        map.addLayer(sitios[i]);
      }
      }
    }
    
});
  

});

var sitios = new Array();

