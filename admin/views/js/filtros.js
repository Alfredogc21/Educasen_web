document.addEventListener('DOMContentLoaded', function () {
    // Obtener referencias a los elementos de filtro
    const filtroNombre = document.getElementById('filtroNombre');
    const filtroAnio = document.getElementById('filtroAnio');
    const filtroEstado = document.getElementById('filtroEstado');
    const filtroGrado = document.getElementById('filtroGrado');

    // Función para guardar los valores de los filtros en el almacenamiento local
    function guardarFiltros() {
        localStorage.setItem('filtroNombre', filtroNombre.value);
        localStorage.setItem('filtroAnio', filtroAnio.value);
        localStorage.setItem('filtroEstado', filtroEstado.value);
        localStorage.setItem('filtroGrado', filtroGrado.value);
    }

    // Función para restaurar los valores de los filtros desde el almacenamiento local
    function restaurarFiltros() {
        filtroNombre.value = localStorage.getItem('filtroNombre') || '';
        filtroAnio.value = localStorage.getItem('filtroAnio') || '';
        filtroEstado.value = localStorage.getItem('filtroEstado') || '';
        filtroGrado.value = localStorage.getItem('filtroGrado') || '';
    }

    // Llamar a la función para restaurar los filtros cuando la página se carga
    restaurarFiltros();

    // Función para filtrar los registros
    function filtrarRegistros() {
        // Obtener valores de los filtros
        const nombre = filtroNombre.value.toLowerCase();
        const anio = filtroAnio.value;
        const estado = filtroEstado.value.toLowerCase();
        const grado = filtroGrado.value.toLowerCase();

        // Obtener todos los registros de la tabla
        const registros = document.querySelectorAll('#tablaEstudiantes tbody tr');

        // Recorrer los registros y mostrar solo aquellos que coincidan con los filtros
        registros.forEach(function (registro) {
            const mostrar = (
                registro.querySelector('td:nth-child(1)').textContent.toLowerCase().includes(nombre) &&
                (anio === '' || registro.querySelector('td:nth-child(2)').textContent.startsWith(anio)) &&
                (estado === '' || registro.querySelector('td:nth-child(4)').textContent.toLowerCase() === estado) &&
                (grado === '' || registro.querySelector('td:nth-child(3)').textContent.toLowerCase().includes(grado))
            );
            registro.style.display = mostrar ? 'table-row' : 'none';
        });
    }

    // Agregar eventos de cambio a los filtros para llamar a la función de filtrado y guardar los filtros
    filtroNombre.addEventListener('input', function () {
        filtrarRegistros();
        guardarFiltros();
    });
    filtroAnio.addEventListener('change', function () {
        filtrarRegistros();
        guardarFiltros();
    });
    filtroEstado.addEventListener('change', function () {
        filtrarRegistros();
        guardarFiltros();
    });
    filtroGrado.addEventListener('change', function () {
        filtrarRegistros();
        guardarFiltros();
    });

    // Llamar a la función de filtrado inicialmente para mostrar todos los registros
    filtrarRegistros();


    // Obtener referencia a los enlaces de "Editar"
    const enlacesEditar = document.querySelectorAll('#tablaEstudiantes tbody tr td:nth-child(6) a');

    // Obtener referencia a la ventana modal y al botón de cerrar modal
    const modalEditar = document.getElementById('modalEditar');
    const btnCerrarModalEditar = document.getElementById('cerrarModalEditar');

    // Obtener referencia al formulario de edición y a los campos del formulario
    const formularioEditar = document.getElementById('formularioEditar');
    const campoId = document.getElementById('id');
    const campoNombre = document.getElementById('nombre');
    const campoGrado = document.getElementById('grado');
    const campoEstado = document.getElementById('estados');
    const campoEmail = document.getElementById('email');

    // Función para abrir la ventana modal al hacer clic en el enlace de "Editar"
    enlacesEditar.forEach(function (enlace) {
        enlace.addEventListener('click', function (event) {
            event.preventDefault(); // Evitar que el enlace redirija

            // Obtener datos del estudiante para editar
            const fila = enlace.closest('tr');
            const id = enlace.dataset.id; // Obtener el ID del estudiante desde el atributo data del enlace
            const nombre = fila.querySelector('td:nth-child(1)').textContent;
            const grado = fila.querySelector('td:nth-child(3)').textContent;
            const estado = fila.querySelector('td:nth-child(4)').textContent;
            const email = fila.querySelector('td:nth-child(5)').textContent;

            // Llenar el formulario de edición con los datos del estudiante
            campoId.value = id;
            campoNombre.value = nombre;
            campoGrado.value = grado;
            campoEstado.value = estado;
            campoEmail.value = email;

            // Obtener el select de grado
            const selectGrado = document.getElementById('grado');
            // Recorrer las opciones del select y establecer el atributo selected en la opción correcta
            for (let i = 0; i < selectGrado.options.length; i++) {
                if (selectGrado.options[i].text === grado) {
                    selectGrado.options[i].selected = true;
                    break;
                }
            }

            // Obtener el select de estado
            const selectEstado = document.getElementById('estados');
            for (let i = 0; i < selectEstado.options.length; i++) {
                if (selectEstado.options[i].text === estado) {
                    selectEstado.options[i].selected = true;
                    break;
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


    // Eliminar estudiante
    const enlacesEliminar = document.querySelectorAll('.eliminar-estudiante');

    enlacesEliminar.forEach(function (enlace) {
        enlace.addEventListener('click', function (event) {
            event.preventDefault();

            const idEstudiante = parseInt(enlace.dataset.id);

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminara al estudiante. ¿Estás seguro de continuar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, marcar como eliminado',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar solicitud AJAX para cambiar el estado del estudiante
                    fetch('eliminarUsuarios.php?id=' + idEstudiante, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            Swal.fire(
                                'Estudiante marcado como eliminado',
                                '',
                                'success'
                            ).then(() => {
                                window.location.reload(); // Recargar la página después de cambiar el estado del estudiante
                            });
                        } else {
                            Swal.fire(
                                'Error',
                                'Hubo un error al marcar al estudiante como eliminado.',
                                'error'
                            );
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error',
                            'Hubo un error al marcar al estudiante como eliminado.',
                            'error'
                        );
                    });
                }
            });
        });
    });

});
