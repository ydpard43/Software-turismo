var estiloPopup = {'maxWidth': '300'};
var sitios=[];
var mark_pos = L.icon({
    iconUrl: 'img/marcador-de-posicion.png',
    iconSize:     [35, 35], 
    iconAnchor:   [28, 28], 
    popupAnchor:  [-6,-20] 
});
$('#info').modal('show');
function cerrar() {
$('#info').modal('hide');
}     
for (var i= 0; i < app.length; i++) {
  L.marker([t[app[i]]['cx'],t[app[i]]['cy']],{
    icon:mark_pos,draggable: false}).bindPopup("<h3 style='text-align:center;'>"+t[app[i]]['nombre']+"</h3><img style='width: 100%; margin:2px;' src='img/"+t[app[i]]['img']+"'><input type='button' style='text-align: ; margin-top:7px;' class='btn btn-primary' value='Punto de partida' onclick='(pp("+app[i]+"))'>",estiloPopup).addTo(map);
}
function pp(e) {
    sitios=[];
  for (var i=0; i < app.length; i++) {
    if (i==0) {
      sitios.push(e);
    if (app[i]!=e) {
       sitios.push(app[i]); 
    }
      
  }else if(app[i]!=e){
     sitios.push(app[i]);
  }
  }
  $('#pois').val(sitios);
}
L.easyButton('<img src="img/enviar.png" style="width:15px;">', function(btn, map){
document.formulario.submit();
}).addTo(map);
L.easyButton('<img src="img/ayuda.png" style="width:20px; margin: -2px;">', function(btn, map){
$('#info').modal('show');
}).addTo(map);