    var estiloPopup = {'maxWidth': '300'};
    var sitios=[];
     
for (var i= 0; i < app.length; i++) {
  L.marker([t[app[i]]['cx'],t[app[i]]['cy']],{
    draggable: false}).bindPopup("<h1>"+t[app[i]]['nombre']+"</h1><input type='button' value='Punto de partida' onclick='(pp("+app[i]+"))'>",estiloPopup).addTo(map);
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