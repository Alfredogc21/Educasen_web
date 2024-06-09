document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.getElementById('add-option');
    const optionsContainer = document.getElementById('options');
    const tipoContenidoSelect = document.getElementById('tipo_contenido');

    addButton.addEventListener('click', function() {
        const newOption = createOption(optionsContainer.childElementCount);
        optionsContainer.appendChild(newOption);
        reindexOptions();
    });

    function createOption(index) {
        const newOption = document.createElement('div');
        newOption.classList.add('option');

        const input = document.createElement('input');
        input.classList.add('option__input');
        input.name = 'option[]'; // Usamos corchetes para que PHP procese los datos como un array
        setInputType(input);
        if (input.type === 'text') {
            input.placeholder = 'Opción ' + String.fromCharCode(65 + index);
        }

        const select = document.createElement('select');
        select.classList.add('option__select');
        select.name = 'validation[]';
        select.required = true;
        select.addEventListener('change', handleSelectChange); // Agrega el evento change

        const option1 = document.createElement('option');
        option1.value = '';
        option1.textContent = 'Seleccione si es correcta o incorrecta';
        option1.disabled = true;
        option1.selected = true;

        const option2 = document.createElement('option');
        option2.value = '1';
        option2.textContent = 'Correcto';

        const option3 = document.createElement('option');
        option3.value = '2';
        option3.textContent = 'Incorrecto';

        select.appendChild(option1);
        select.appendChild(option2);
        select.appendChild(option3);

        const removeButton = document.createElement('button');
        removeButton.type = 'button'; // Asegúrate de que el botón no envíe el formulario
        removeButton.textContent = 'Eliminar';
        removeButton.classList.add('option__remove');
        removeButton.addEventListener('click', function() {
            newOption.remove();
            reindexOptions();
        });

        newOption.appendChild(input);
        newOption.appendChild(select);
        newOption.appendChild(removeButton);

        return newOption;
    }

    function reindexOptions() {
        const options = document.querySelectorAll('.option__input');
        options.forEach((input, index) => {
            if (input.type === 'text') {
                input.placeholder = 'Opción ' + String.fromCharCode(65 + index);
            }
        });
    }

    function handleSelectChange(event) {
        if (event.target.value === '1') { // Si se selecciona "Correcto"
            const selects = document.querySelectorAll('.option__select');
            selects.forEach(select => {
                if (select !== event.target) { // Si no es el select que se cambió
                    select.value = '2'; // Marca como "Incorrecto"
                }
            });
        }
    }

    function updateOptionInputs(tipo) {
        const optionInputs = document.querySelectorAll('.option__input');
        optionInputs.forEach(input => {
            setInputType(input);
        });
    }

    function setInputType(input) {
        const tipo = tipoContenidoSelect.value;
        if (tipo === '1') { // Texto
            input.type = 'text';
        } else if (tipo === '2') { // Imagen
            input.type = 'file';
            input.placeholder = ''; // Limpiar el placeholder
        }
    }

    tipoContenidoSelect.addEventListener('change', function() {
        updateOptionInputs(tipoContenidoSelect.value);
    });

    const removeButtons = document.querySelectorAll('.option__remove');
    removeButtons.forEach(removeButton => {
        removeButton.addEventListener('click', function() {
            const option = removeButton.parentNode;
            option.remove();
            reindexOptions();
        });
    });

    const selects = document.querySelectorAll('.option__select');
    selects.forEach(select => {
        select.addEventListener('change', handleSelectChange);
    });

    reindexOptions(); // Inicializa la numeración de las opciones al cargar la página
});
