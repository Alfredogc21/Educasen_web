<?php
session_start();

//si existe la sesion
if (isset($_SESSION['usuarios'])) {
    $correo = $_SESSION['usuarios'];

    //Hacemos la conexion a la base de datos
    require 'conexion/conexion.php';

    //Hacemos la consulta para traer los datos del usuario
    $statement = $conexion->prepare('SELECT id, nombres_completos, estados_usuarios_id, correo FROM usuarios WHERE correo = :correo LIMIT 1');
    $statement->execute(array(':correo' => $correo));
    $resultado = $statement->fetch();

    //Guardamos los datos en variables
    if ($resultado != false) {
        $nombres_completos = $resultado['nombres_completos'];
        $correo = $resultado['correo'];
        $id = $resultado['id'];
        $estados_usuarios_id = $resultado['estados_usuarios_id'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idRecibido = isset($_POST['usuario']) ? $idRecibido = $_POST['usuario'] : $idRecibido = null;

        $errores = '';
        $success = '';
        if (empty($idRecibido)) {
            $errores .= "<script> Swal.fire(
                        'Opps...',
                        'Por favor seleccione su usuario',
                        'error')</script>";
            $errores .= '<li class="#ef5350 red lighten-1">Por favor seleccione su usuario</li>';
        } else {
        //Actualizamos el estado_usuario_id a 2
        $statement = $conexion->prepare('UPDATE usuarios SET estados_usuarios_id = 2 WHERE id = :id');
        $statement->execute(array(':id' => $idRecibido));
        $success .= "<script> Swal.fire(
                    'Eliminado!',
                    'El usuario ha sido eliminado correctamente',
                    'success')</script>";
        $success .= '<li class="#00e676 green accent-3">El usuario ha sido eliminado correctamente</li>';
        $_SESSION['usuarios'] = $correo;

        //Esperar 2 segundos destruir sesion y redireccionar
        header("Refresh: 4; url=login.php");
        session_destroy();

        }
    }


    require 'views/eliminar.view.php';
} else {
    header('Location: login.php');
}