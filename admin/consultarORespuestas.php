<?php session_start();

// Validamos si hay una sesion
if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];
    $errores = '';
    $success = '';

    //Hacemos la conexion a la base de datos
    require '../conexion/conexion.php';

    //Hacemos la consulta para traer los datos del usuario y determinar el rol
    $sqlRolUser = $conexion->prepare('SELECT id, nombres_completos, roles_id FROM usuarios WHERE correo = :correo LIMIT 1');
    $sqlRolUser->execute(array(':correo' => $correo));
    $infoCorreo = $sqlRolUser->fetch();

    //Hacemos la consulta para traer el tipo de validacion
    $sqlTipoValidacion = $conexion->prepare('SELECT * FROM validacion_pregunta');
    $sqlTipoValidacion->execute();
    $tipoValidaciones = $sqlTipoValidacion->fetchAll();

    //Hacemos la consulta para traer las preguntas
    $sqlpreguntas = $conexion->prepare('SELECT * FROM preguntas ORDER BY id DESC LIMIT 5');
    $sqlpreguntas->execute();
    $preguntas = $sqlpreguntas->fetchAll();

    //Hacemos la consulta para traer los datos de las opciones de respuesta
    $sqlORespuesta = $conexion->prepare('SELECT contenido.id AS id, contenido.contenido_respuestas AS contenido, preguntas.enunciado_pregunta AS preguntas, validacion_pregunta.nombre AS validacion, tipo_contenido.nombre AS tipo_contenido FROM opcion_respuesta AS contenido LEFT JOIN preguntas ON contenido.preguntas_id = preguntas.id LEFT JOIN validacion_pregunta ON contenido.validacion_pregunta_id = validacion_pregunta.id LEFT JOIN tipo_contenido ON contenido.tipo_contenido_id = tipo_contenido.id ORDER BY contenido.id DESC LIMIT 20');
    $sqlORespuesta->execute();
    $sqlORespuestas = $sqlORespuesta->fetchAll();

    // Cantidad de registros por página
    $registrosPorPagina = 10;

    // Total de registros obtenidos de la consulta SQL
    $totalRegistros = count($sqlORespuestas);

    // Calcular el número total de páginas
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    // Determinar la página actual
    $paginaActual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    // Calcular el índice de inicio para la consulta SQL
    $indiceInicio = ($paginaActual - 1) * $registrosPorPagina;

    // Obtener una porción de los resultados de la consulta SQL para mostrar en la página actual
    $sqlORespuestasPaginadas = array_slice($sqlORespuestas, $indiceInicio, $registrosPorPagina);

    //Actualizamos el nombre, el estado y el email
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar que se hayan recibido los datos necesarios
        if (isset($_POST["nombre"], $_POST["preguntas"], $_POST['validacionRespuesta'] , $_POST["id"])) {
            try {

                // Sanitizar y validar los datos recibidos
                $nombreRespuesta = htmlspecialchars(trim($_POST["nombre"]));
                $recibirPregunta = intval($_POST["preguntas"]);
                $recibirValidacion = intval($_POST["validacionRespuesta"]);
                $id = intval($_POST["id"]);
                
                // Actualizar los datos de la respuesta
                $sqlActualizarRespuesta = $conexion->prepare('UPDATE opcion_respuesta SET contenido_respuestas = :conRespuesta, preguntas_id = :pregunta, validacion_pregunta_id  = :validacion WHERE id = :id');
                $sqlActualizarRespuesta->execute(array(':conRespuesta' => $nombreRespuesta, ':pregunta' => $recibirPregunta, ':validacion' => $recibirValidacion, ':id' => $id));

                // Limpiar los valores de los campos del formulario al recargar la página
                echo "<script>
                    window.onload = function() {
                        document.getElementById('id').value = '';
                        document.getElementById('nombre').value = '';
                        document.getElementById('preguntas').value = '';
                        document.getElementById('validacionRespuesta').value = '';
                    }
                    </script>";

                // Redireccionar a la página principal o mostrar un mensaje de éxito
                $success .= "<script> 
                    Swal.fire({
                        title: 'Información actualizada',
                        text: 'Se actualizó la información de la respuesta',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = window.location.href; // Redireccionar a la misma página
                        }
                    });
                </script>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Error: Faltan datos necesarios.";
        }
    }

    // Dependiendo del rol asi mismo es el enrutamiento
    if ($infoCorreo['roles_id'] == 2) { // Si es estudiante
        header('Location: ../menuPrincipal.php');
    } else if ($infoCorreo['roles_id'] == 1) { // Si es administrador
        require 'views/consultarORespuestas.view.php';
    }
} else {
    header('Location: ../login.php');
}
