    var estiloPopup = {'maxWidth': '300'};
    var sitios=[];
     
for (var i= 0; i < app.length; i++) {
  L.marker([t[app[i]]['cx'],t[app[i]]['cy']],{
    draggable: false}).bindPopup("<h3 style='text-align:center;'>"+t[app[i]]['nombre']+"</h3><img style='width: 100%; margin:2px;' src='img/"+t[app[i]]['img']+"'><input type='button' style='text-align: ;' class='btn btn-primary' value='Punto de partida' onclick='(pp("+app[i]+"))'>",estiloPopup).addTo(map);
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