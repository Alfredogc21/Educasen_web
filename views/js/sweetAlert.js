//Recibir el evento onclick del boton eliminar
$('.btn-delete').on('click', function(e){
    e.preventDefault();
    //Obtener el valor del atributo href del boton
    var href = $(this).attr('href');
    //Mostrar el mensaje de alerta

Swal.fire({
    title: '¿Estás seguro?',
    text: "¡No podrás revertir esto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: '¡Sí, elimínalo!'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      )
    }
  })
});