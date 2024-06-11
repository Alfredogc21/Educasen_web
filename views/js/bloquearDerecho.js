document.addEventListener('DOMContentLoaded', (event) => {
    // Deshabilitar clic derecho
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        alert('Acción no permitida');
    });

    // Deshabilitar combinaciones de teclas comunes para traducción (Ctrl + Shift + L, Ctrl + Shift + S, Ctrl + U y F12 en Chrome)
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey && e.shiftKey && (e.key === 'L' || e.key === 'S')) || (e.ctrlKey && e.key === 'u') || (e.key === 'F12')) {
            e.preventDefault();
            alert('Acción no permitida');
        }
    });

    // Deshabilitar la copia de texto
    document.addEventListener('copy', function(e) {
        e.preventDefault();
        alert('Acción no permitida');
    });
});
