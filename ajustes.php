<?php
session_start();

//si existe la sesion
if (isset($_SESSION['usuarios'])) {
    $correo = $_SESSION['usuarios'];

    //Hacemos la conexion a la base de datos
    require 'conexion/conexion.php';

    //Hacemos la consulta para traer los datos del usuario
    $statement = $conexion->prepare('SELECT id, nombres_completos, estados_usuarios_id, fecharegistro, correo, roles_id FROM usuarios WHERE correo = :correo LIMIT 1');
    $statement->execute(array(':correo' => $correo));
    $resultado = $statement->fetch();

    //Guardamos los datos en variables
    if ($resultado != false) {
        $nombres_completos = $resultado['nombres_completos'];
        $correo = $resultado['correo'];
        $id = $resultado['id'];
        $estados_usuarios_id = $resultado['estados_usuarios_id'];
        $fechaRegistro = $resultado['fecharegistro'];
    }

    if($resultado['roles_id'] == 2){ // Si es estudiante
        require 'views/ajustes.view.php';
    } else if($resultado['roles_id'] == 1){ // Si es administrador
        header('Location: admin/dashboard.php');
    }
} else {
    header('Location: login.php');
}