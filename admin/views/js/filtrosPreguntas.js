document.addEventListener('DOMContentLoaded', function () {
    // Obtener referencias a los elementos de filtro
    const filtroNombre = document.querySelector('#filtroNombre');
    const filtroCompetencias = document.querySelector('#filtroCompetencias');
    const tipoPregunta = document.querySelector('#tipoPregunta');

    // Función para guardar los valores de los filtros en el almacenamiento local
    function guardarFiltros() {
        localStorage.setItem('filtroNombre', filtroNombre.value);
        localStorage.setItem('filtroCompetencias', filtroCompetencias.value);
        localStorage.setItem('tipoPregunta', tipoPregunta.value);
    }

    // Función para restaurar los valores de los filtros desde el almacenamiento local
    function restaurarFiltros() {
        filtroNombre.value = localStorage.getItem('filtroNombre') || '';
        filtroCompetencias.value = localStorage.getItem('filtroCompetencias') || '';
        tipoPregunta.value = localStorage.getItem('tipoPregunta') || '';
    }

    // Llamar a la función para restaurar los filtros cuando la página se carga
    restaurarFiltros();

    // Función para filtrar los registros
    function filtrarRegistros() {
        // Obtener valores de los filtros
        const nombre = filtroNombre.value.toLowerCase();
        const competencia = filtroCompetencias.value.toLowerCase();
        const tipo = tipoPregunta.value.toLowerCase();
    
        // Obtener todos los registros de la tabla
        const registros = document.querySelectorAll('#tablaPreguntas tbody tr');
    
        // Recorrer los registros y mostrar solo aquellos que coincidan con los filtros
        registros.forEach(function (registro) {
            const mostrar = (
                registro.querySelector('td:nth-child(1)').textContent.toLowerCase().includes(nombre) &&
                (competencia === '' || registro.querySelector('td:nth-child(2)').textContent.toLowerCase() === competencia) &&
                (tipo === '' || registro.querySelector('td:nth-child(3)').textContent.toLowerCase() === tipo)
            );
            registro.style.display = mostrar ? 'table-row' : 'none';
        });
    }
    

    // Agregar eventos de cambio a los filtros para llamar a la función de filtrado y guardar los filtros
    filtroNombre.addEventListener('input', function () {
        filtrarRegistros();
        guardarFiltros();
    });
    filtroCompetencias.addEventListener('change', function () {
        filtrarRegistros();
        guardarFiltros();
    });
    tipoPregunta.addEventListener('change', function () {
        filtrarRegistros();
        guardarFiltros();
    });

    // Llamar a la función de filtrado inicialmente para mostrar todos los registros
    filtrarRegistros();



    // Obtener referencia a los enlaces de "Editar"
    const enlacesEditar = document.querySelectorAll('#tablaPreguntas tbody tr td:nth-child(4) a');

    // Obtener referencia a la ventana modal y al botón de cerrar modal
    const modalEditar = document.getElementById('modalEditar');
    const btnCerrarModalEditar = document.getElementById('cerrarModalEditar');

    // Obtener referencia al formulario de edición y a los campos del formulario
    const formularioEditar = document.getElementById('formularioEditar');
    const campoId = document.getElementById('id');
    const campoNombre = document.getElementById('nombre');
    const campoCompetencia = document.getElementById('competencias');
    const campoTipo = document.getElementById('tipoPreguntaForm');

    // Función para abrir la ventana modal al hacer clic en el enlace de "Editar"
    enlacesEditar.forEach(function (enlace) {
        enlace.addEventListener('click', function (event) {
            event.preventDefault(); // Evitar que el enlace redirija

            // Obtener datos del administrador para editar
            const fila = enlace.closest('tr');
            const id = enlace.dataset.id; // Obtener el ID del administrador desde el atributo data del enlace
            const nombre = fila.querySelector('td:nth-child(1)').textContent;
            const competencia = fila.querySelector('td:nth-child(2)').textContent;
            const tipo = fila.querySelector('td:nth-child(3)').textContent;

            // Llenar el formulario de edición con los datos del administrador
            campoId.value = id;
            campoNombre.value = nombre;
            campoCompetencia.value = competencia;
            campoTipo.value = tipo;


            // Seleccionar la competencia correspondiente en el select de competencias
            if (campoCompetencia) {
                // Tu lógica para seleccionar la competencia correspondiente
                for (let i = 0; i < campoCompetencia.options.length; i++) {
                    if (campoCompetencia.options[i].text === competencia) {
                        campoCompetencia.options[i].selected = true;
                        break;
                    }
                }
            }

            // Seleccionar el tipo de pregunta correspondiente en el select de tipo de pregunta
            if (campoTipo) {
                for (let i = 0; i < campoTipo.options.length; i++) {
                    if (campoTipo.options[i].text === tipo) {
                        campoTipo.options[i].selected = true;
                        break;
                    }
                }
            }

            // Mostrar la ventana modal
            modalEditar.style.display = 'block';
        });
    });


    // Función para cerrar la ventana modal al hacer clic en el botón de cerrar modal
    btnCerrarModalEditar.addEventListener('click', function () {
        modalEditar.style.display = 'none';
    });

    // Cerrar la ventana modal al hacer clic fuera de ella (si se desea)
    window.addEventListener('click', function (event) {
        if (event.target === modalEditar) {
            modalEditar.style.display = 'none';
        }
    });

    // Evitar que el formulario se envíe
    formularioEditar.addEventListener('submit', function (event) {
        event.preventDefault();
        modalEditar.style.display = 'none';
    });


});
