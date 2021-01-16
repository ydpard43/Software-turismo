
var map = L.map('map',{ zoomControl:false }).setView([4.344426, -74.358292],14);

L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> Contribuidores, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>,<a href="http://cloudmade.com">CloudMade</a>',
}).addTo(map);
map.doubleClickZoom.disable();