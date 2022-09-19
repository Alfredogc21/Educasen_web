<?php session_start();

if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];

    try {
        $conexion = new PDO('mysql:host=localhost;dbname=educasen', 'root', '');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    // Mostrar el nombre del usuario
    $statementUsername = $conexion->prepare('SELECT nombres_completos FROM usuarios WHERE correo = :correo');
    $statementUsername->execute(array(':correo' => $correo));
    $resultadoUsername = $statementUsername->fetch();
    
    $nombreUsuario = $resultadoUsername['nombres_completos'];

    //Saber cuantos datos hay en la tabla
    $statement = $conexion->prepare('SELECT SQL_CALC_FOUND_ROWS id FROM preguntas_introduccion');
    $statement->execute();
    $resultado = $statement->fetchAll();

    $totalPreguntas = $conexion->query('SELECT FOUND_ROWS() as total');
    $totalPreguntas = $totalPreguntas->fetch()['total'];

    // Mostrar las preguntas y respuestas al azar
    $azar = rand(1, $totalPreguntas);
    $statement = $conexion->prepare('SELECT preguntas_introduccion.enunciado_pregunta, opcion_respuesta_introduccion.contenido_respuestas, opcion_respuesta_introduccion.validacion_pregunta_id FROM opcion_respuesta_introduccion, preguntas_introduccion WHERE opcion_respuesta_introduccion.preguntas_introduccion_id = :azar AND opcion_respuesta_introduccion.preguntas_introduccion_id = preguntas_introduccion.id');
    $statement->execute(array(':azar' => $azar));
    $resultado = $statement->fetchAll();

    require 'views/testLectura.View.php';
} else {
    header('Location: login.php');
}


?>