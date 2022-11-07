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

    //Saber cuantos datos hay en la tabla
    $statement = $conexion->prepare('SELECT SQL_CALC_FOUND_ROWS id FROM preguntas_introduccion');
    $statement->execute();
    $resultado = $statement->fetchAll();
    $totalPreguntas = $conexion->query('SELECT FOUND_ROWS() as total');
    $totalPreguntas = $totalPreguntas->fetch()['total'];

    //Sql de la tabla calificacion
    $datosCalificacion_id = $conexion->prepare('SELECT preguntas_introduccion_id FROM calificacion WHERE usuarios_id = :idUsuario');
    $datosCalificacion_id->execute(array(':idUsuario' => $idUsuario));
    $resultadoCalificacion_id = $datosCalificacion_id->fetchAll();

    // Mostrar las preguntas y respuestas al azar
    $azar = rand(1, $totalPreguntas);
    $statement = $conexion->prepare('SELECT preguntas_introduccion.enunciado_pregunta, opcion_respuesta_introduccion.contenido_respuestas, opcion_respuesta_introduccion.validacion_pregunta_id FROM opcion_respuesta_introduccion, preguntas_introduccion WHERE opcion_respuesta_introduccion.preguntas_introduccion_id = :azar AND opcion_respuesta_introduccion.preguntas_introduccion_id = preguntas_introduccion.id');
    $statement->execute(array(':azar' => $azar));
    $resultado = $statement->fetchAll();

    // Recibimos los datos del formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $respuesta = $_POST['respuesta'];
        echo $nombreUsuario . "<br>";
        echo $respuesta . "<br>";
        echo $azar . "<br>";

        

        
        $sql_calificacion = $conexion->prepare('INSERT INTO calificacion (id, usuarios_id, preguntas_introduccion_id, validacion_pregunta_id) VALUES (NULL, :usuarios_id, :preguntas_introduccion_id, :validacion_pregunta_id)');
        $sql_calificacion->execute(array(':usuarios_id' => $idUsuario,':preguntas_introduccion_id' => $azar,':validacion_pregunta_id' => $respuesta));

    }






    require 'views/testLectura.View.php';
} else {
    header('Location: login.php');
}


?>