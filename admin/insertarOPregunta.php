<?php session_start();

// Validamos si hay una sesion
if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];

    //Hacemos la conexion a la base de datos
    require '../conexion/conexion.php';

    //Hacemos la consulta para traer los datos del usuario y determinar el rol
    $sqlRolUser = $conexion->prepare('SELECT nombres_completos, roles_id FROM usuarios WHERE correo = :correo LIMIT 1');
    $sqlRolUser->execute(array(':correo' => $correo));
    $infoCorreo = $sqlRolUser->fetch();

    $errores = '';
    $success = '';

    // Mostrar la ultima pregunta
    $sql_pregunta = $conexion->prepare('SELECT id, enunciado_pregunta FROM preguntas ORDER BY id DESC LIMIT 1');
    $sql_pregunta->execute();
    $resultado_pregunta = $sql_pregunta->fetch();

    // Mostrar las validaciones (Correcta, Incorrecta)
    $sql_validaciones = $conexion->prepare('SELECT * FROM validacion_pregunta');
    $sql_validaciones->execute();
    $resultado_validaciones = $sql_validaciones->fetchAll();

    // Si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verificamos que se haya seleccionado una pregunta
        if (isset($_POST['pregunta'])) {
            $pregunta_id = $_POST['pregunta'];

            // Definimos el abecedario
            $letras = range('A', 'Z');

            // Iteramos sobre las opciones de respuesta y sus validaciones
            if (isset($_POST['option']) && isset($_POST['validation'])) {
                $options = $_POST['option'];
                $validations = $_POST['validation'];

                for ($i = 0; $i < count($options); $i++) {
                    $option = $options[$i];
                    $validation = $validations[$i];

                    // Agregamos la letra correspondiente a la opción
                    $opcion_letra = $letras[$i] . ') ' . $option;

                    // Insertamos la opción de respuesta en la base de datos
                    $sqlInsertOption = $conexion->prepare('INSERT INTO opcion_respuesta (contenido_respuestas, preguntas_id, validacion_pregunta_id) VALUES (:contenido, :pregunta_id, :validacion_id)');
                    $sqlInsertOption->execute(array(':contenido' => $opcion_letra, ':pregunta_id' => $pregunta_id, ':validacion_id' => $validation));
                }

                // Mostrar mensaje de éxito
                $success = 'Las opciones de respuesta han sido agregadas correctamente.';
                $success .= "<script> 
                Swal.fire({
                    title: 'Opciones de respuesta agregadas correctamente',
                    text: 'Haz clic en uno de los botones para continuar',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Agregar nueva pregunta',
                    cancelButtonText: 'Salir',
                    footer: '<a href=\"subirImagenes.php\" style=\"display:inline-block; padding: 10px 20px; background-color: #6A80C0; color: #fff; text-decoration: none; border-radius: 5px;\">Subir imagen</a>'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'agregarPregunta.php';
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = 'dashboard.php';
                    }
                });
            </script>";
            
            } else {
                $errores = 'Debes ingresar al menos una opción de respuesta.';
                $errores .= "<script>
                Swal.fire({
                    title: 'Opps...',
                    text: 'Debes ingresar al menos una opción de respuesta',
                    icon: 'error',
                    confirmButtonText: 'Intentar de nuevo',
                    showCancelButton: false,
                });
            </script>";
            }
        } else {
            $errores = 'Debes seleccionar una pregunta.';
            $errores .= "<script>
            Swal.fire({
                title: 'Opps...',
                text: 'Debes seleccionar una pregunta',
                icon: 'error',
                confirmButtonText: 'Intentar de nuevo',
                showCancelButton: false,
            });
        </script>";
        }
    }

    if ($infoCorreo['roles_id'] == 2) { // Si es estudiante
        header('Location: ../menuPrincipal.php');
    } else if ($infoCorreo['roles_id'] == 1) { // Si es administrador
        require 'views/insertarOPregunta.view.php';
    }
} else {
    header('Location: ../login.php');
}
