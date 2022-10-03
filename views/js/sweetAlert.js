function EliminarUsuario(id){
Swal.fire({
    title: '¿Estás seguro?',
    text: "¡No podrás revertir esto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: '¡Sí, elimínalo!',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {


      Swal.fire(
        'Usuario eliminado',
        'Ya no podrá acceder al sistema con este correo.',
        'success'

      )
    } else {
        Swal.fire(
            'Usuario no eliminado',
            'El usuario no ha sido eliminado.',
            'error'
          )
    }
  });
}


