<?php session_start();

if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];

    //Hacemos la conexion a la base de datos
    require 'conexion/conexion.php';
    
    $statement = $conexion->prepare('SELECT nombres_completos FROM usuarios WHERE correo = :correo');
    $statement->execute(array(':correo' => $correo));
    $resultado = $statement->fetch();
    
    $nombreUsuario = $resultado['nombres_completos'];


    require 'views/menuPrincipal.view.php';
} else {
    header('Location: login.php');
}

?>