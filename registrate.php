<?php session_start();

// Validamos si hay una sesion
if (isset($_SESSION['usuarios'])) {
    header('Location: views/menuPrincipal.php');
}

//Hacemos la conexion a la base de datos
require 'conexion/conexion.php';

//Para obtener los datos del grado
$statementGrados = $conexion->prepare('SELECT id, nombre_grado FROM grados');
$statementGrados->execute();
$resultadoGrado = $statementGrados->fetchAll();

// Recibimos los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = filter_var(strtolower($_POST['correo']), FILTER_SANITIZE_EMAIL); // FILTER_SANITIZE_EMAIL -> filtra el correo
    $password = $_POST['password'];
    $confipassword = $_POST['confipassword'];
    $grado = isset($_POST['grado']) ? $grado = $_POST['grado'] : $grado = null;

    // Verificamos que los campos no esten vacios
    $errores = '';
    $success = '';
    if (empty($nombre) or empty($correo) or empty($password) or empty($confipassword) or empty($grado)) {
        $errores .= "<script> Swal.fire(
                    'Opps...',
                    'Por favor rellena todos los datos correctamente',
                    'error')</script>";
        $errores .= '<li class="#ef5350 red lighten-1">Por favor rellena todos los datos correctamente</li>';
    } else {
        // Verificamos que el correo no exista
        $statement = $conexion->prepare('SELECT * FROM usuarios WHERE correo = :correo LIMIT 1');
        $statement->execute(array(':correo' => $correo));
        $resultado = $statement->fetch();

        if ($resultado != false) {
            $errores .= "<script> Swal.fire(
                        'Opps...',
                        'El correo ya existe',
                        'error')</script>";
            $errores .= '<li class="#ef5350 red lighten-1">El correo ya existe</li>';
        }

        $password = hash('sha512', $password);
        $confipassword = hash('sha512', $confipassword);

        // Verificamos que las contraseñas coincidan
        if ($password != $confipassword) {
            $errores .= "<script> Swal.fire(
                        'Opps...',
                        'Las contraseñas no coinciden',
                        'error')</script>";
            $errores .= '<li class="#ef5350 red lighten-1">Las contraseñas no coinciden</li>';
        }

        // Verificamos que el captcha este correcto
        $ip = $_SERVER['REMOTE_ADDR'];
        $captcha = $_POST['g-recaptcha-response'];
        $secretkey = "6LfL90kgAAAAADdvH6SJ4K8Kb-7ho9JzExaKi-P7";

        $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");
        $atributos = json_decode($respuesta, true);

        if ($atributos['success'] == false) {
            $errores .= "<script> Swal.fire(
                        'Opps...',
                        'Por favor valida el reCaptcha',
                        'error')</script>";
            $errores .= '<li class="#ef5350 red lighten-1">Por favor verifica el captcha</li>';
        }

    }

    // Si no hay errores
    if ($errores == '') {
        $statement = $conexion->prepare('INSERT INTO usuarios (id, nombres_completos, grado_id, correo, password) VALUES (null, :nombre, :curso, :correo, :password)');
        $statement->execute(array(':nombre' => $nombre, ':curso' => $grado, ':correo' => $correo, ':password' => $password));
        $success .= "<script> Swal.fire(
                    'Bienvenido',
                    'Usuario registrado correctamente',
                    'success')</script>";
        $success .= '<li class="#00e676 green accent-3">Usuario registrado exitosamente</li>';
    }
    
}

// Llamamos la vista
require 'views/registrate.view.php';


?>