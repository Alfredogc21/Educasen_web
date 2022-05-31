<?php session_start();

// Validamos si hay una sesion
if (isset($_SESSION['usuarios'])) {
    header('Location: views/menuPrincipal.php');
}

// Recibimos los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = filter_var(strtolower($_POST['correo']), FILTER_SANITIZE_EMAIL); // FILTER_SANITIZE_EMAIL -> filtra el correo
    $password = $_POST['password'];
    $confipassword = $_POST['confipassword'];

    // Verificamos que los campos no esten vacios
    $errores = '';
    if (empty($nombre) or empty($correo) or empty($password) or empty($confipassword)) {
        $errores .= '<li class="#ef5350 red lighten-1">Por favor rellena todos los datos correctamente</li>';
        $errores .= '<script>alert("Por favor rellena todos los campos")</script>';
    } else {
        try {
            $conexion = new PDO('mysql:host=localhost;dbname=educasen', 'root', '');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Verificamos que el correo no exista
       $statement = $conexion->prepare('SELECT * FROM usuarios WHERE correo = :correo LIMIT 1');
       $statement->execute(array(':correo' => $correo));
       $resultado = $statement->fetch();

        if ($resultado != false) {
            $errores .= '<li class="#ef5350 red lighten-1">El correo ya existe</li>';
        }

        $password = hash('sha512', $password);
        $confipassword = hash('sha512', $confipassword);

        //echo "nombre: " . $nombre . "<br> correo: " . $correo . "<br> password: " . $password . "<br> confipassword: " . $confipassword;

        // Verificamos que las contraseñas coincidan
        if ($password != $confipassword) {
            $errores .= '<li class="#ef5350 red lighten-1">Las contraseñas no coinciden</li>';
        }
    }

    // Si no hay errores
    if ($errores == '') {
        $statement = $conexion->prepare('INSERT INTO usuarios (id, nombres_completos, correo, password) VALUES (null, :nombre, :correo, :password)');
        $statement->execute(array(':nombre' => $nombre, ':correo' => $correo, ':password' => $password));
        echo '<script>alert("Usuario registrado")</script>';
        header('Location: login.php');
    }
}


// Llamamos la vista
require 'views/registrate.view.php';


?>