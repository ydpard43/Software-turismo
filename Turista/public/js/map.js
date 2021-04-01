
var map = L.map('map',{ zoomControl:false }).setView([4.343752163576473, -74.36196339964096],14);

L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> Contribuidores, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>,<a href="http://cloudmade.com">CloudMade</a>',
}).addTo(map);
 new L.Control.Zoom({ position: 'bottomright' }).addTo(map);

map.doubleClickZoom.disable();
