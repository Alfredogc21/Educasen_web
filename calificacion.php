<?php session_start();

if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];

    //Hacemos la conexion a la base de datos
    require 'conexion/conexion.php';

    // Mostrar el nombre del usuario
    $statementUsername = $conexion->prepare('SELECT id, nombres_completos, roles_id FROM usuarios WHERE correo = :correo');
    $statementUsername->execute(array(':correo' => $correo));
    $resultadoUsername = $statementUsername->fetch();
    
    $nombreUsuario = $resultadoUsername['nombres_completos'];
    $idUsuario = $resultadoUsername['id'];

    // Mostrar las materias
    $sql_Materias = $conexion->prepare('SELECT * FROM materias');
    $sql_Materias->execute();
    $resultadoMaterias = $sql_Materias->fetchAll();

    //Mostrar opcion pregunta
    $sql_opPregunta = $conexion->prepare('SELECT * FROM opcion_pregunta');
    $sql_opPregunta->execute();
    $resultadoOpPregunta = $sql_opPregunta->fetchAll();

    $resultadoCalificacion = null;
    $correctas = 0;
    $incorrectas = 0;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $materia = isset($_POST['materia']) ? $_POST['materia'] : null; // Lo que recibe el select de materias
        $oppreguntas = isset($_POST['oppreguntas']) ? $_POST['oppreguntas'] : null; // Lo que recibe el select de opcion pregunta
        
        // Mostrar las calificaciones
        $sql_calificacion = $conexion->prepare('SELECT nombres_materias, enunciado_pregunta, validacion_pregunta_id FROM calificacion, preguntas, materias WHERE preguntas_id = preguntas.id AND preguntas.materia_id = materias.id AND usuarios_id = :idUsuario AND materias.id = :materia AND calificacion.opcion_pregunta_id = :oppreguntas');
        $sql_calificacion->execute(array(':idUsuario' => $idUsuario , ':materia' => $materia , ':oppreguntas' => $oppreguntas));
        $resultadoCalificacion = $sql_calificacion->fetchAll();

        // contar las correctas e incorrectas
        for($i = 0; $i < count($resultadoCalificacion); $i++) {
            if ($resultadoCalificacion[$i]['validacion_pregunta_id'] == 1) {
                $correctas = $correctas + 1;
            } else {
                $incorrectas = $incorrectas + 1;
            }
        }
    }

    if($resultadoUsername['roles_id'] == 2){ // Si es estudiante
        require 'views/calificacion.view.php';
    } else if($resultadoUsername['roles_id'] == 1){ // Si es administrador
        header('Location: admin/dashboard.php');
    }
    
} else {
    header('Location: login.php');
}

