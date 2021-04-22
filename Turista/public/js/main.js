const grid = new Muuri('.grid',{
    layout: {
        rounding: false
      }
});

window.addEventListener('load', () => {
    grid.refreshItems().layout();
    document.getElementById('grid').classList.add('imagenes-cargadas');
    const enlaces = document.querySelectorAll('#categorias a');
    enlaces.forEach( (elemento) => {
        elemento.addEventListener('click', (evento) => {
            evento.preventDefault();
            enlaces.forEach((enlace) => enlace.classList.remove('activo'));
            evento.target.classList.add('activo');

            const categoria = evento.target.innerHTML.toLowerCase();
            categoria === 'todos' ? grid.filter('[data-categoria]') :
            grid.filter(`[data-categoria="${categoria}"]`);

        });
    } );
    document.querySelector('#barra-busqueda').addEventListener('input', (evento) => {
        const busqueda = evento.target.value;
        grid.filter( (item) => item.getElement().dataset.etiquetas.includes(busqueda) );
    });
});
var n= document.getElementById('rt');
var n2= document.getElementById('menu');
n.addEventListener("click", function(){
if (!$('#rt1').is(':visible')) {
    $('#rt1').show();
    $('#rt2').show();
}
else{
    $('#rt1').hide();
    $('#rt2').hide();
}

});

$('.dropdown-menu').on('click', function (e) {
  e.stopPropagation();
});
