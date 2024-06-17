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

    // Mostrar las materias
    $sql_Materias = $conexion->prepare('SELECT * FROM materias');
    $sql_Materias->execute();
    $resultadoMaterias = $sql_Materias->fetchAll();

    //Mostrar si es introductorio o examen
    $sql_opPregunta = $conexion->prepare('SELECT * FROM opcion_pregunta');
    $sql_opPregunta->execute();
    $resultadoOpPregunta = $sql_opPregunta->fetchAll();

    // Consultar Estudiantes
    $sqlEstudiantes = $conexion->prepare('SELECT id, nombres_completos FROM usuarios WHERE roles_id = 2');
    $sqlEstudiantes->execute();
    $resultadoEstudiantes = $sqlEstudiantes->fetchAll();

    // Inicializamos las variables
    $resultadoCalificacion = null;
    $correctas = 0;
    $incorrectas = 0;

    // Validamos si se envio el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $materia = isset($_POST['materia']) ? $_POST['materia'] : null; // Lo que recibe el select de materias
        $oppreguntas = isset($_POST['tipopregunta']) ? $_POST['tipopregunta'] : null; // Lo que recibe el select de opcion pregunta
        $estudiante = isset($_POST['estudiante']) ? $_POST['estudiante'] : null; // Lo que recibe el select de estudiantes

        // Mostrar las calificaciones
        $sql_calificacion = $conexion->prepare('SELECT preguntas.enunciado_pregunta, opcion_pregunta.nombre_tipo_pregunta, calificacion.fecharegistro AS fecha_contestada, calificacion.validacion_pregunta_id, materias.nombres_materias, validacion_pregunta.nombre AS nombre_validacion FROM calificacion INNER JOIN preguntas ON calificacion.preguntas_id = preguntas.id INNER JOIN opcion_pregunta ON calificacion.opcion_pregunta_id = opcion_pregunta.id INNER JOIN materias ON preguntas.materia_id = materias.id INNER JOIN validacion_pregunta ON calificacion.validacion_pregunta_id = validacion_pregunta.id WHERE calificacion.usuarios_id = :idUsuario AND preguntas.materia_id = :materia AND calificacion.opcion_pregunta_id = :oppreguntas');
        $sql_calificacion->execute(array(':idUsuario' => $estudiante, ':materia' => $materia, ':oppreguntas' => $oppreguntas));
        $resultadoCalificacion = $sql_calificacion->fetchAll();

        // contar las correctas e incorrectas
        for ($i = 0; $i < count($resultadoCalificacion); $i++) {
            if ($resultadoCalificacion[$i]['validacion_pregunta_id'] == 1) {
                $correctas = $correctas + 1;
            } else {
                $incorrectas = $incorrectas + 1;
            }
        }

        //Nombre estudiante
        $sql_nombreEstudiante = $conexion->prepare('SELECT nombres_completos FROM usuarios WHERE id = :idUsuario');
        $sql_nombreEstudiante->execute(array(':idUsuario' => $estudiante));
        $nombreEstudiante = $sql_nombreEstudiante->fetch();

        //Nombre de la materia
        $sql_nombreMateria = $conexion->prepare('SELECT nombres_materias FROM materias WHERE id = :idMateria');
        $sql_nombreMateria->execute(array(':idMateria' => $materia));
        $nombreMateria = $sql_nombreMateria->fetch();

        //Nombre de opcion pregunta
        $sql_nombreOpPregunta = $conexion->prepare('SELECT nombre_tipo_pregunta FROM opcion_pregunta WHERE id = :idOpPregunta');
        $sql_nombreOpPregunta->execute(array(':idOpPregunta' => $oppreguntas));
        $nombreOpPregunta = $sql_nombreOpPregunta->fetch();

        //Total de preguntas contestadas
        $totalPreguntas = $correctas + $incorrectas;

        // Guardar los parámetros en variables de sesión para el PDF
        $_SESSION['estudiante'] = $nombreEstudiante['nombres_completos'];
        $_SESSION['materia'] = $nombreMateria['nombres_materias'];
        $_SESSION['correctas'] = $correctas;
        $_SESSION['incorrectas'] = $incorrectas;
        $_SESSION['nombreOpPregunta'] = $nombreOpPregunta['nombre_tipo_pregunta'];
        $_SESSION['totalPreguntas'] = $totalPreguntas;

        $_SESSION['tipopregunta'] = $oppreguntas;
        $_SESSION['resultadoCalificacion'] = $resultadoCalificacion;

        // Renderizar la vista con los resultados y el botón para generar el PDF
        require 'views/resultadosEstudiantes.view.php';
        exit();
    }

    // Dependiendo del rol asi mismo es el enrutamiento
    if ($infoCorreo['roles_id'] == 2) { // Si es estudiante
        header('Location: ../menuPrincipal.php');
    } else if ($infoCorreo['roles_id'] == 1) { // Si es administrador
        require 'views/resultadosEstudiantes.view.php';
    }
} else {
    header('Location: ../login.php');
}
