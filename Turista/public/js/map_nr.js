
var map = L.map('map',{ zoomControl:true }).setView([4.344426, -74.358292],14);

L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>,<a href="http://cloudmade.com">CloudMade</a>',
}).addTo(map);
// Marcar la posicion 
var drawnItems = new L.FeatureGroup()
map.addLayer(drawnItems);
function a(){
map.featureGroup.removeLayer(e.layer);
}
L.drawLocal = {

        draw: {
            toolbar: {

                actions: {
                    title: '',
                    text: 'Cancelar'
                },
                finish: {
                    title: '',
                    text: 'Finish'
                },
                undo: {
                    title: '',
                    text: 'Limpiar el último punto'
                },
                buttons: {
                    polyline: 'Draw a polyline',
                    polygon: 'Draw a polygon',
                    rectangle: 'Draw a rectangle',
                    circle: 'Dibuja un Circulo',
                    marker: 'Draw a marker',
                    circlemarker: 'Draw a circlemarker'
                }
            },
            handlers: {
                circle: {
                    tooltip: {
                        start: 'Haz clic y arrastra para dibujar'
                    },
                    radius: 'Radio'
                },
                circlemarker: {
                    tooltip: {
                        start: 'Click map to place circle marker.'
                    }
                },
                marker: {
                    tooltip: {
                        start: 'Click map to place marker.'
                    }
                },
                polygon: {
                    tooltip: {
                        start: 'Click to start drawing shape.',
                        cont: 'Click to continue drawing shape.',
                        end: 'Click first point to close this shape.'
                    }
                },
                polyline: {},
                rectangle: {
                    tooltip: {
                        start: 'Click and drag to draw rectangle'
                    }
                },
                simpleshape: {
                    tooltip: {
                        end: 'Suelte el mouse para terminar de dibujar'
                    }
                }
            }
        },
        edit: {
            toolbar: {
                actions: {
                    save: {
                        title: '',
                        text: ' OK '
                    },
                    cancel: {
                        title: '',
                        text: 'Cancelar'
                    },
                    clearAll: {
                        title: '',
                        text: 'Borrar todo'
                    }
                },
                buttons: {
                    edit: 'Edit layers',
                    editDisabled: 'No layers to edit',
                    remove: 'Delete layers',
                    removeDisabled: 'No layers to delete'
                }
            },
            handlers: {
                edit: {
                    tooltip: {
                        text: 'Cuando termine, haga clic en OK',
                        subtext: 'Cambiar el tamaño o mover'
                    }
                },
                remove: {
                    tooltip: {
                        text: 'Haga clic para eliminar'
                    }
                }
            }
        }
    };


var drawControl = new L.Control.Draw({
	//definir botones
  draw:{polygon: false,
        rectangle: false,
        polyline:false,
        marker:false,
        circle   : {
            metric: 'metric'
        }
    },
//permitir que se editen el circulo
  edit: {
    featureGroup: drawnItems,
   
  }
},);

map.addControl(drawControl);
