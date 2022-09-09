<?php session_start();

// Validamos si hay una sesion
if (isset($_SESSION['usuarios'])) {
    header('Location: index.php');
}

$errores = '';

// Recibimos los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correoB = filter_var(strtolower($_POST['correo']), FILTER_SANITIZE_EMAIL); // FILTER_SANITIZE_EMAIL -> filtra el correo
    $passwordB = $_POST['password'];
    $passwordB= hash('sha512', $passwordB);

// Conexion a la base de datos
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=educasen', 'root', '');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die("Error en el servidor");
    }

// Verificamos que el captcha este correcto
     $ip = $_SERVER['REMOTE_ADDR'];
    $captcha = $_POST['g-recaptcha-response'];
    $secretkey = "6LfL90kgAAAAADdvH6SJ4K8Kb-7ho9JzExaKi-P7";
    
    $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");
    $atributos = json_decode($respuesta, true);
    
    if ($atributos['success'] == false) {
        $errores .= '<script>alert("Por favor valida el reCaptcha")</script>';
        $errores .= '<li class="#ef5350 red lighten-1">Por favor verifica el captcha</li>';
    }

// Verificamos que los campos no esten vacios
    if (empty($correoB) or empty($passwordB) or empty($captcha)) {
        $errores .= '<li class="#ef5350 red lighten-1">Por favor rellena todos los campos</li>';
        $errores .= '<script>alert("Por favor rellena todos los campos")</script>';
    } else {
// Verificamos que el correo y contraseña exista
    $statement = $conexion->prepare('SELECT correo, password FROM usuarios WHERE correo = :correo AND password = :password');
    $statement->execute(array(':correo' => $correoB, ':password' => $passwordB));
    $resultado = $statement->fetch(); // Almacenamos el resultado

//Creamos una session y enrutamos a la pagina principal
    if ($resultado !== false) {
        $_SESSION['usuarios'] = $correoB;
        header('Location: menuPrincipal.php');
    } else {
        $errores .= '<li class="#ef5350 red lighten-1">Datos Incorrectos</li>';
    }

    }
}

// Llamamos la vista
require 'views/login.view.php';

?>