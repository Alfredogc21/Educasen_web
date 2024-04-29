<?php session_start();

if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];

    //Hacemos la conexion a la base de datos
    require 'conexion/conexion.php';
    
    $statement = $conexion->prepare('SELECT nombres_completos, roles_id FROM usuarios WHERE correo = :correo');
    $statement->execute(array(':correo' => $correo));
    $resultado = $statement->fetch();
    
    $nombreUsuario = $resultado['nombres_completos'];

    if($resultado['roles_id'] == 2){ // Si es estudiante
        require 'views/introduccionMatematicas.view.php';
    } else if($resultado['roles_id'] == 1){ // Si es administrador
        header('Location: admin/dashboard.php');
    }

} else {
    header('Location: login.php');
}