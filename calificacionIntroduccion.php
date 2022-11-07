<?php session_start();

if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];

    //Hacemos la conexion a la base de datos
    require 'conexion/conexion.php';

    // Mostrar el nombre del usuario
    $statementUsername = $conexion->prepare('SELECT id, nombres_completos FROM usuarios WHERE correo = :correo');
    $statementUsername->execute(array(':correo' => $correo));
    $resultadoUsername = $statementUsername->fetch();
    
    $nombreUsuario = $resultadoUsername['nombres_completos'];
    $idUsuario = $resultadoUsername['id'];

    // Mostrar las materias
    $sql_Materias = $conexion->prepare('SELECT * FROM materias');
    $sql_Materias->execute();
    $resultadoMaterias = $sql_Materias->fetchAll();

    $resultadoCalificacion = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $materia = isset($_POST['materia']) ? $_POST['materia'] : null; // Para mostrar en el select

        $correctas = 0;
        $incorrectas = 0;
        
        // Mostrar las calificaciones
        $sql_calificacion = $conexion->prepare('SELECT nombres_materias, enunciado_pregunta, validacion_pregunta_id FROM calificacion, preguntas_introduccion, materias WHERE preguntas_introduccion_id = preguntas_introduccion.id AND preguntas_introduccion.materia_id = materias.id AND usuarios_id = :idUsuario AND materias.id = :materia');
        $sql_calificacion->execute(array(':idUsuario' => $idUsuario , ':materia' => $materia));
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



    require 'views/calificacionIntroduccion.view.php';
} else {
    header('Location: login.php');
}


?>