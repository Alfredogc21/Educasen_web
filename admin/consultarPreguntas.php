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

    //Hacemos la consulta para traer el tipo de pregunta
    $sqlTipoPregunta = $conexion->prepare('SELECT * FROM opcion_pregunta');
    $sqlTipoPregunta->execute();
    $tipoPregunta = $sqlTipoPregunta->fetchAll();

    //Hacemos la consulta para traer las competencias
    $sqlCompetencias = $conexion->prepare('SELECT * FROM materias');
    $sqlCompetencias->execute();
    $competencias = $sqlCompetencias->fetchAll();

    //Hacemos la consulta para traer los datos de preguntas
    $sqlpreguntas = $conexion->prepare('SELECT preguntas.id AS id, preguntas.enunciado_pregunta AS preguntas, materias.nombres_materias AS competencias, opcion_pregunta.nombre_tipo_pregunta AS tipo_pregunta FROM preguntas INNER JOIN materias ON preguntas.materia_id = materias.id INNER JOIN opcion_pregunta ON preguntas.opcion_pregunta_id = opcion_pregunta.id ORDER BY preguntas.id DESC LIMIT 30');
    $sqlpreguntas->execute();
    $sqlQuestions = $sqlpreguntas->fetchAll();

    // Cantidad de registros por página
    $registrosPorPagina = 10;

    // Total de registros obtenidos de la consulta SQL
    $totalRegistros = count($sqlQuestions);

    // Calcular el número total de páginas
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    // Determinar la página actual
    $paginaActual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    // Calcular el índice de inicio para la consulta SQL
    $indiceInicio = ($paginaActual - 1) * $registrosPorPagina;

    // Obtener una porción de los resultados de la consulta SQL para mostrar en la página actual
    $sqlPreguntasPaginados = array_slice($sqlQuestions, $indiceInicio, $registrosPorPagina);

    //Actualizamos el nombre, el estado y el email
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar que se hayan recibido los datos necesarios
        if (isset($_POST["nombre"], $_POST["competencias"], $_POST['tipoPreguntaForm'] , $_POST["id"])) {
            try {

                // Sanitizar y validar los datos recibidos
                $nombre = htmlspecialchars(trim($_POST["nombre"]));
                $competencias = intval($_POST["competencias"]);
                $tipoPregunta = intval($_POST["tipoPreguntaForm"]);
                $id = intval($_POST["id"]);
                
                // Actualizar los datos de la pregunta
                $sqlActualizarPregunta = $conexion->prepare('UPDATE preguntas SET enunciado_pregunta = :nombre, materia_id = :competencias, opcion_pregunta_id = :tipoPregunta WHERE id = :id');
                $sqlActualizarPregunta->execute(array(':nombre' => $nombre, ':competencias' => $competencias, ':tipoPregunta' => $tipoPregunta, ':id' => $id));

                // Limpiar los valores de los campos del formulario al recargar la página
                echo "<script>
                    window.onload = function() {
                        document.getElementById('id').value = '';
                        document.getElementById('nombre').value = '';
                        document.getElementById('competencias').value = '';
                        document.getElementById('tipoPregunta').value = '';
                    }
                    </script>";

                // Redireccionar a la página principal o mostrar un mensaje de éxito
                $success .= "<script> 
                    Swal.fire({
                        title: 'Información actualizada',
                        text: 'Se actualizó la información de la pregunta',
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
        require 'views/consultarPreguntas.view.php';
    }
} else {
    header('Location: ../login.php');
}
