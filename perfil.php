<?php
session_start();

//si existe la sesion
if (isset($_SESSION['usuarios'])) {
    $correo = $_SESSION['usuarios'];
    
    //Hacemos la conexion a la base de datos
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=educasen', 'root', '');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    //Hacemos la consulta para traer los datos del usuario
    $statement = $conexion->prepare('SELECT id, nombres_completos, correo FROM usuarios WHERE correo = :correo');
    $statement->execute(array(':correo' => $correo));
    $resultado = $statement->fetch();

    //Guardamos los datos en variables
    if ($resultado != false) {
        $nombres_completos = $resultado['nombres_completos'];
        $correo = $resultado['correo'];
        $id = $resultado['id'];
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
        $grado = $_POST['grado'];

        $errores = '';
        $success = '';
        //Validamos los datos
        if (empty($nombre) or empty($correo) or empty($password) or empty($confipassword) or empty($grado)) {
            $errores .= '<li>Por favor rellena todos los datos correctamente</li>';
        } else {
            $statement = $conexion->prepare('SELECT * FROM usuarios WHERE correo = :correo LIMIT 1');
            $statement->execute(array(':correo' => $correo));
            $resultado = $statement->fetch();

            if ($resultado != false) {
                $errores .= '<li>El correo ya existe</li>';
            }

            //Encriptamos la contraseña
            $password = hash('sha512', $password);
            $confipassword = hash('sha512', $confipassword);

            if ($password != $confipassword) {
                $errores .= '<li>Las contraseñas no son iguales</li>';
            }
        }

        //Si no hay errores actualizamos los datos
        if ($errores == '') {
            $statement = $conexion->prepare('UPDATE usuarios SET nombres_completos = :nombre, correo = :correo, password = :password, grado_id = :grado WHERE id = :id');
            $statement->execute(array(':nombre' => $nombre, ':correo' => $correo, ':password' => $password, ':grado' => $grado, ':id' => $id));
            $success .= '<script>alert("Usuario actualizado, inicie sesion con los nuevos datos")</script>';
            $_SESSION['usuarios'] = $correo;

            //Esperar 0.2 segundos destruir sesion y redireccionar
            header("Refresh:0.2; url=login.php");
            session_destroy();
        }
    }
    
require 'views/perfil.View.php';
} else {
    header('Location: login.php');
}

?>