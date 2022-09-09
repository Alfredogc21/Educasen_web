<?php session_start();

if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];

    try {
        $conexion = new PDO('mysql:host=localhost;dbname=educasen', 'root', '');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    $statement = $conexion->prepare('SELECT nombres_completos FROM usuarios WHERE correo = :correo');
    $statement->execute(array(':correo' => $correo));
    $resultado = $statement->fetch();
    
    $nombreUsuario = $resultado['nombres_completos'];

    require 'views/introduccionLectura.View.php';
} else {
    header('Location: login.php');
}