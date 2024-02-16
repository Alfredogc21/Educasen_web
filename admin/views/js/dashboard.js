document.addEventListener('DOMContentLoaded', function () {
    const campoBusqueda = document.getElementById('searchInput');

    campoBusqueda.addEventListener('input', function () {
        const valorBusqueda = this.value.toLowerCase();
        const elementosLista = document.querySelectorAll('.menu-link div');

        elementosLista.forEach(elemento => {
            const textoElemento = elemento.textContent.toLowerCase();
            const contenidoOriginal = elemento.dataset.originalContent || textoElemento;

            if (textoElemento.includes(valorBusqueda)) {
                // Si el texto del elemento contiene el valor de búsqueda, resalta cada letra
                resaltarCoincidencias(elemento, valorBusqueda, contenidoOriginal);
            } else {
                // Si no coincide, restablece el color de fondo y elimina resaltado
                elemento.style.backgroundColor = '';
                elemento.innerHTML = contenidoOriginal;
            }
        });
    });

    function resaltarCoincidencias(elemento, valorBusqueda, contenidoOriginal) {
        // Obtiene el texto del elemento
        const textoElemento = contenidoOriginal;

        // Crea un nuevo contenido con cada letra coincidente resaltada en amarillo
        const nuevoContenido = textoElemento.replace(new RegExp(valorBusqueda, 'gi'), match => `<span style="background-color: #FF9632; color: #000;">${match}</span>`);

        // Almacena el contenido original en el atributo 'data-original-content'
        // para restaurarlo cuando sea necesario
        elemento.dataset.originalContent = contenidoOriginal;

        // Asigna el nuevo contenido al elemento
        elemento.innerHTML = nuevoContenido;
    }
});
