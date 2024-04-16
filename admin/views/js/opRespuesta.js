document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.getElementById('add-option');
    const optionsContainer = document.getElementById('options');

    addButton.addEventListener('click', function() {
        const newOption = createOption(optionsContainer.childElementCount);
        optionsContainer.appendChild(newOption);
    });

    function createOption(index) {
        const newOption = document.createElement('div');
        newOption.classList.add('option');

        const input = document.createElement('input');
        input.type = 'text';
        input.classList.add('option__input');
        input.name = 'option[]'; // Usamos corchetes para que PHP procese los datos como un array
        input.placeholder = 'Opción ' + String.fromCharCode(65 + index);

        const select = document.createElement('select');
        select.classList.add('option__select');
        select.name = 'validation[]';
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
            input.placeholder = 'Opción ' + String.fromCharCode(65 + index);
        });
    }

    // Inicializar funcionalidad de eliminar opción
    const removeButtons = document.querySelectorAll('.option__remove');
    removeButtons.forEach(removeButton => {
        removeButton.addEventListener('click', function() {
            const option = removeButton.parentNode;
            option.remove();
            reindexOptions();
        });
    });
});
