var map2 = L.map('map2',{ zoomControl:false }).setView([4.343752163576473, -74.36196339964096],12);
L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> Contribuidores, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>,<a href="http://cloudmade.com">CloudMade</a>',
}).addTo(map2);
 new L.Control.Zoom({ position: 'bottomright' }).addTo(map2);
$('#modalmap').on('shown.bs.modal', function(){
    setTimeout(function() {
        map2.invalidateSize();
        if (!(typeof pointa =='undefined')) {
        map2.setView(new L.LatLng(pointa[0][0],pointa[0][1]),12);
    	}

    }, 10);
});