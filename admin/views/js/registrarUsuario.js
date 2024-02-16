document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.inputs'); // Input del formulario
    const campoBusqueda = document.getElementById('searchInput'); // Input de búsqueda

    campoBusqueda.addEventListener('input', handleSearchInput);

    function handleSearchInput() {
        const valorBusqueda = this.value.toLowerCase();
        const elementosLista = document.querySelectorAll('.menu-link div');

        elementosLista.forEach(elemento => {
            const textoElemento = elemento.textContent.toLowerCase();
            const contenidoOriginal = elemento.dataset.originalContent || textoElemento;

            if (textoElemento.includes(valorBusqueda)) {
                resaltarCoincidencias(elemento, valorBusqueda, contenidoOriginal);
            } else {
                resetearElemento(elemento, contenidoOriginal);
            }
        });
    }

    // Funciones para resaltar coincidencias en la búsqueda
    function resaltarCoincidencias(elemento, valorBusqueda, contenidoOriginal) {
        const textoElemento = contenidoOriginal;
        const nuevoContenido = textoElemento.replace(new RegExp(valorBusqueda, 'gi'), match => `<span style="background-color: #FF9632; color: #000";>${match}</span>`);
        almacenarContenidoOriginal(elemento, contenidoOriginal);
        asignarNuevoContenido(elemento, nuevoContenido);
    }

    function resetearElemento(elemento, contenidoOriginal) {
        elemento.style.backgroundColor = '';
        asignarNuevoContenido(elemento, contenidoOriginal);
    }

    function almacenarContenidoOriginal(elemento, contenidoOriginal) {
        elemento.dataset.originalContent = contenidoOriginal;
    }

    function asignarNuevoContenido(elemento, nuevoContenido) {
        elemento.innerHTML = nuevoContenido;
    }

    // Verificar el estado inicial de los inputs al cargar la página
    inputs.forEach(input => {
        if (input.tagName.toLowerCase() !== 'select') {
            manejarEstadoInicialInput(input);
        }
    });

    // Agregar eventos de entrada para la validación en tiempo real de cada campo
    inputs.forEach(input => {
        if (input.tagName.toLowerCase() !== 'select') {
            agregarEventosInput(input);
        }
    });

    function manejarEstadoInicialInput(input) {
        if (input.value.trim() !== '') {
            actualizarEstiloLabel(input, true);
        }
    }

    function agregarEventosInput(input) {
        input.addEventListener('input', function () {
            manejarEntradaInput(this);
        });

        input.addEventListener('focus', function () {
            manejarFocusInput(this);
        });

        input.addEventListener('blur', function () {
            manejarBlurInput(this);
        });
    }

    function manejarEntradaInput(input) {
        if (input.value.trim() !== '') {
            actualizarEstiloLabel(input, true);
        } else {
            actualizarEstiloLabel(input, false);
        }
        validarCampo(input);
    }

    function manejarFocusInput(input) {
        if (input.value.trim() !== '') {
            actualizarEstiloLabel(input, true);
        }
    }

    function manejarBlurInput(input) {
        if (input.value === '') {
            actualizarEstiloLabel(input, false);
        }
        validarCampo(input);
    }

    function actualizarEstiloLabel(input, tieneTexto) {
        const label = input.previousElementSibling;
        if (tieneTexto) {
            label.style.top = '-5px';
            label.style.fontSize = '17px';
            label.style.color = '#697A8D';
        } else {
            label.style.top = '0';
            label.style.fontSize = '17px';
            label.style.color = '';
        }
    }

    // Función para validar cada campo
    function validarCampo(campo) {
        const valor = campo.value.trim();
        const etiqueta = campo.previousElementSibling;

        switch (campo.id) {
            case 'name':
                validarCampoNombre(valor, etiqueta, campo);
                break;

            case 'email':
                validarCampoEmail(valor, etiqueta, campo);
                break;

            case 'password':
                validarCampoPassword(valor, etiqueta, campo);
                break;

            case 'confiPassword':
                validarCampoConfirmarPassword(valor, etiqueta, campo);
                break;

            case 'grado':
                validarCampoSelect(valor, etiqueta, campo);
                break;

            default:
                // Otros campos no especificados
                break;
        }
    }

    function validarCampoNombre(valor, etiqueta, campo) {
        if (valor.length >= 10) {
            actualizarEstiloValidacion(etiqueta, campo, true);
        } else {
            actualizarEstiloValidacion(etiqueta, campo, false);
        }
    }

    function validarCampoEmail(valor, etiqueta, campo) {
        const correoValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor);
        if (correoValido) {
            actualizarEstiloValidacion(etiqueta, campo, true);
        } else {
            actualizarEstiloValidacion(etiqueta, campo, false);
        }
    }

    function validarCampoPassword(valor, etiqueta, campo) {
        if (valor.length >= 7) {
            actualizarEstiloValidacion(etiqueta, campo, true);
        } else {
            actualizarEstiloValidacion(etiqueta, campo, false);
        }
    }

    function validarCampoConfirmarPassword(valor, etiqueta, campo) {
        const password = document.getElementById('password').value.trim();
        if (valor === password && valor.length >= 7) {
            actualizarEstiloValidacion(etiqueta, campo, true);
        } else {
            actualizarEstiloValidacion(etiqueta, campo, false);
        }
    }

    function validarCampoSelect(valor, etiqueta, campo) {
        if (valor !== '') {
            actualizarEstiloValidacion(etiqueta, campo, true);
        } else {
            actualizarEstiloValidacion(etiqueta, campo, false);
        }
    }

    function actualizarEstiloValidacion(etiqueta, campo, esValido) {
        if (esValido) {
            etiqueta.style.color = 'green';
            campo.style.borderBottomColor = 'green';
        } else {
            etiqueta.style.color = 'crimson';
            campo.style.borderBottomColor = 'crimson';
        }
    }

});
