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

    //Recibimos los datos del formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $correo = $_POST['correo'];

        $errores = '';
        $success = '';
        //Validamos los datos
        if (empty($correo)) {
            $errores .= "<script> Swal.fire(
                        'Opps...',
                        'Por favor ingrese un correo',
                        'error')</script>";
            $errores .= '<li class="#ef5350 red lighten-1">Por favor ingrese un correo</li>';
        } else {
            if ($correo == $resultado['correo']) {
                $errores .= "<script> Swal.fire(
                            'Opps...',
                            'El correo ingresado ya existe',
                            'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">El correo ya existe</li>';
            }
        }

        //Si no hay errores actualizamos los datos
        if ($errores == '') {
            $statement = $conexion->prepare('UPDATE usuarios SET correo = :correo WHERE id = :id');
            $statement->execute(array(':correo' => $correo, ':id' => $id));
            $success .= "<script> Swal.fire(
                        'Correo actualizado',
                        'Inicie sesion con el nuevo correo',
                        'success')</script>";
            $success .= '<li class="#00e676 green accent-3">Correo actualizado, inicie sesion con el nuevo correo</li>';
            $_SESSION['usuarios'] = $correo;

            //Esperar 0.2 segundos destruir sesion y redireccionar
            header("Refresh:0.5; url=login.php");
            session_destroy();
        }
    }
    
require 'views/actualizarCorreo.view.php';
} else {
    header('Location: login.php');
}

?>