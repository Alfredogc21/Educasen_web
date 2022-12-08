<?php session_start();

if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];
    $errores = '';

    //Hacemos la conexion a la base de datos
    require 'conexion/conexion.php';

    // Mostrar el nombre del usuario
    $statementUsername = $conexion->prepare('SELECT id, nombres_completos FROM usuarios WHERE correo = :correo LIMIT 1');
    $statementUsername->execute(array(':correo' => $correo));
    $resultadoUsername = $statementUsername->fetch();
    
    $nombreUsuario = $resultadoUsername['nombres_completos'];
    $idUsuario = $resultadoUsername['id'];

    //Mostrar las preguntas
    $sqlPreguntas =$conexion->prepare('SELECT p.* FROM preguntas_introduccion p JOIN usuarios u LEFT JOIN calificacion c ON c.preguntas_introduccion_id = p.id AND c.usuarios_id = u.id WHERE u.id = :idUsuario AND c.id is null ORDER BY rand() LIMIT 1');
    $sqlPreguntas->execute(array(':idUsuario' => $idUsuario));
    $resultadoPregunta = $sqlPreguntas->fetchAll();
    //id de la pregunta
    $idPregunta = isset($resultadoPregunta[0]['id']) ? $resultadoPregunta[0]['id'] : null;
    $idPregunta2 = $idPregunta;

    //Mostrar las respuestas
    if ($resultadoPregunta != false && $idPregunta != null) {
        $sqlRespuestas = $conexion->prepare('SELECT r.* FROM opcion_respuesta_introduccion r JOIN preguntas_introduccion p ON r.preguntas_introduccion_id = p.id WHERE p.id = :idPregunta');
        $sqlRespuestas->execute(array(':idPregunta' => $resultadoPregunta[0]['id']));
        $resultadoRespuestas = $sqlRespuestas->fetchAll();
    } else {
        $errores .= '<script>alert("Felicidades! Has terminado el test");</script>';
        header('Refresh: 0.1 ; URL=calificacionIntroduccion.php');
    }

    // Recibimos los datos del formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $respuesta = $_POST['respuesta'];
        
        $idd = $_POST['idd'];

        if ($resultadoPregunta != false) {
            $sql_calificacion = $conexion->prepare('INSERT INTO calificacion (id, usuarios_id, preguntas_introduccion_id, validacion_pregunta_id) VALUES (NULL, :usuarios_id, :preguntas_introduccion_id, :validacion_pregunta_id)');
            $sql_calificacion->execute(array(':usuarios_id' => $idUsuario,':preguntas_introduccion_id' => $idd,':validacion_pregunta_id' => $respuesta));
        }

        //recargar la pagina
        header('Refresh: 0.1 ; URL=testLectura.php');

    }

    require 'views/examenLecturaCritica.view.php';
} else {
    header('Location: login.php');
}

?>