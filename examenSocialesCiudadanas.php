<?php session_start();

if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];
    $errores = '';

    //Hacemos la conexion a la base de datos
    require 'conexion/conexion.php';

    // Mostrar el nombre del usuario
    $statementUsername = $conexion->prepare('SELECT id, nombres_completos, roles_id FROM usuarios WHERE correo = :correo LIMIT 1');
    $statementUsername->execute(array(':correo' => $correo));
    $resultadoUsername = $statementUsername->fetch();
    
    $nombreUsuario = $resultadoUsername['nombres_completos'];
    $idUsuario = $resultadoUsername['id'];

    $opcion_pregunta = 2;    //Variable para mostrar las preguntas examen
    $materiaSocialesCiudadanas = 4; //Variable para mostrar las preguntas de SocialesCiudadanas

    //Mostrar las preguntas
    $sqlPreguntas =$conexion->prepare('SELECT p.* FROM preguntas p JOIN usuarios u JOIN opcion_pregunta op LEFT JOIN calificacion c ON c.preguntas_id = p.id AND c.usuarios_id = u.id WHERE u.id = :idUsuario AND p.opcion_pregunta_id = :opcionPregunta AND p.materia_id = :materia AND c.id is null ORDER BY rand() LIMIT 1;');
    $sqlPreguntas->execute(array(':idUsuario' => $idUsuario , ':opcionPregunta' => $opcion_pregunta , ':materia' => $materiaSocialesCiudadanas));
    $resultadoPregunta = $sqlPreguntas->fetchAll();
    //id de la pregunta
    $idPregunta = isset($resultadoPregunta[0]['id']) ? $resultadoPregunta[0]['id'] : null;
    $idPregunta2 = $idPregunta;

    //Mostrar imagen
    $sql_Imagen = $conexion->prepare('SELECT * FROM imagenes_examen where preguntas_id = :idPregunta limit 1');
    $sql_Imagen->execute(array(':idPregunta' => $idPregunta2));
    $resultadoImagen = $sql_Imagen->fetchAll();

    //Mostrar las respuestas
    if ($resultadoPregunta != false && $idPregunta != null) {
        $sqlRespuestas = $conexion->prepare('SELECT r.* FROM opcion_respuesta r JOIN preguntas p ON r.preguntas_id = p.id WHERE p.id = :idPregunta');
        $sqlRespuestas->execute(array(':idPregunta' => $resultadoPregunta[0]['id']));
        $resultadoRespuestas = $sqlRespuestas->fetchAll();
    } else {
        $errores .= '<script>alert("Felicidades! Has terminado el test");</script>';
        header('Refresh: 0.1 ; URL=calificacion.php');
    }

    // Recibimos los datos del formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $respuesta = $_POST['respuesta'];
        
        $idd = $_POST['idd'];

        if ($resultadoPregunta != false) {
            $sql_calificacion = $conexion->prepare('INSERT INTO calificacion (id, usuarios_id, preguntas_id, validacion_pregunta_id, opcion_pregunta_id) VALUES (NULL, :usuarios_id, :preguntas_id, :validacion_pregunta_id, :opcion_pregunta_id)');
            $sql_calificacion->execute(array(':usuarios_id' => $idUsuario,':preguntas_id' => $idd,':validacion_pregunta_id' => $respuesta,':opcion_pregunta_id' => $opcion_pregunta));
        }

        //recargar la pagina
        header('Refresh: 0.1 ; URL=examenSocialesCiudadanas.php');
    }

    if($resultadoUsername['roles_id'] == 2){ // Si es estudiante
        require 'views/examenSocialesCiudadanas.view.php';
    } else if($resultadoUsername['roles_id'] == 1){ // Si es administrador
        header('Location: admin/dashboard.php');
    }
    
} else {
    header('Location: login.php');
}

