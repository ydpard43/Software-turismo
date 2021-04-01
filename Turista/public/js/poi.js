
 	
 	 var estiloPopup = {'maxWidth': '300'};
 	 var sitios=[];
 	 var radio;
 	 for (var i = 0; i < app.length; i++) {
 	 L.marker([app[i]['coordenadax'],app[i]['coordenaday']],{draggable: false})
   .bindPopup("<h1 style='text-align:center;'>"+app[i]['nombre']+"</h1><p><img style='width:100%;' src='img/"+app[i]['img']+"'></p>",estiloPopup).addTo(map);
 	 }

 map.on(L.Draw.Event.CREATED, function (e) {

   drawnItems.clearLayers();
   sitios=[];
   var layer = e.layer;
   
    drawnItems.addLayer(layer);
//obtener  el radio
    var a=(layer.getRadius()/1E3);
    var latLngs = layer.getLatLng();
    var lat=latLngs['lat'];
    var lon=latLngs['lng'];
    for (var i = 0; i < app.length; i++) {
    	var km=(getKilometros(lat,lon,app[i]['coordenadax'],app[i]['coordenaday']));
      if(km<=a){
sitios.push(app[i]['id_poi']);
   }
   }
});
 map.on(L.Draw.Event.EDITRESIZE, function(event) {
            if (L.Browser.mobile) {
                map.gestureHandling.disable();
            }
            var layer = event.layer;
            var a=(layer.getRadius()/1E3);
            var latLngs = layer.getLatLng(); 
            var lat=latLngs['lat'];
    		var lon=latLngs['lng'];
    		sitios=[];

    		    for (var i = 0; i < app.length; i++) {
      if((getKilometros(lat,lon,app[i]['coordenadax'],app[i]['coordenaday']))<= a){
     sitios.push(app[i]['id_poi']);
   }
   radio=a;
   } 
                
        });
  map.on(L.Draw.Event.EDITMOVE, function(event) {
            if (L.Browser.mobile) {
                map.gestureHandling.disable();
            }
            var layer = event.layer;
            var a=(layer.getRadius()/1E3);
            var latLngs = layer.getLatLng(); 
            var lat=latLngs['lat'];
    		var lon=latLngs['lng'];
    		sitios=[];
   console.clear();
    		    for (var i = 0; i < app.length; i++) {
      if((getKilometros(lat,lon,app[i]['coordenadax'],app[i]['coordenaday']))<= a){
     sitios.push(app[i]['id_poi']);
   }
   radio=a;
   }            
     });
map.on(L.Draw.Event.EDITED, function(event) {
            if (L.Browser.mobile) {
                map.gestureHandling.enable();
            }
            var layers = event.layers;
            layers.eachLayer(function(layer) {
            var a=(layer.getRadius()/1E3);
            var latLngs = layer.getLatLng(); 
            var lat=latLngs['lat'];
    		var lon=latLngs['lng'];
    		sitios=[];
               for (var i = 0; i < app.length; i++) {
      if((getKilometros(lat,lon,app[i]['coordenadax'],app[i]['coordenaday']))<=a){
     
     sitios.push(app[i]['id_poi']);
   }
   } radio=a; 
            });
        });
	

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


L.easyButton('<img src="img/enviar.png" style="width:15px;">', function(btn, map){
$('#pois').val(sitios);
document.formulario.submit();
}).addTo(map);
  console.clear(); 