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

    //Hacemos la consulta para traer los grados
    $statementGrado = $conexion->prepare('SELECT * FROM grados');
    $statementGrado->execute();
    $resultadoGrado = $statementGrado->fetchAll();

    //Recibimos los datos del formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $confipassword = $_POST['confipassword'];
        $grado = isset($_POST['grado']) ? $grado = $_POST['grado'] : $grado = null;

        $errores = '';
        $success = '';
        //Validamos los datos
        if (empty($nombre) or empty($correo) or empty($password) or empty($confipassword) or empty($grado)) {
            $errores .= "<script> Swal.fire(
                        'Opps...',
                        'Por favor rellena todos los datos correctamente',
                        'error')</script>";
            $errores .= '<li class="#ef5350 red lighten-1">Por favor rellena todos los datos correctamente</li>';
        } else {
            if ($resultado != false) {
                $errores .= "<script> Swal.fire(
                            'Opps...',
                            'El correo ingresado ya existe',
                            'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">El correo ya existe</li>';
            }

            //Encriptamos la contraseña
            $password = hash('sha512', $password);
            $confipassword = hash('sha512', $confipassword);

            if ($password != $confipassword) {
                $errores .= "<script> Swal.fire(
                            'Opps...',
                            'Las contraseñas no son iguales',
                            'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">Las contraseñas no son iguales</li>';
            }
        }

        //Si no hay errores actualizamos los datos
        if ($errores == '') {
            $statement = $conexion->prepare('UPDATE usuarios SET nombres_completos = :nombre, correo = :correo, password = :password, grado_id = :grado WHERE id = :id');
            $statement->execute(array(':nombre' => $nombre, ':correo' => $correo, ':password' => $password, ':grado' => $grado, ':id' => $id));
            $success .= "<script> Swal.fire(
                        'Usuario actualizado',
                        'Inicie sesion con los nuevos datos',
                        'success')</script>";
            $success .= '<li class="#00e676 green accent-3">Usuario actualizado, inicie sesion con los nuevos datos</li>';
            $_SESSION['usuarios'] = $correo;

            //Esperar 0.2 segundos destruir sesion y redireccionar
            header("Refresh:0.2; url=login.php");
            session_destroy();
        }
    }
    
require 'views/actualizar.view.php';
} else {
    header('Location: login.php');
}

?>