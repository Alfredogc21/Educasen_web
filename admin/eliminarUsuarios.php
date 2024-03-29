<?php
session_start();

// Validamos si hay una sesión
if (isset($_SESSION['usuarios'])) {
    $correo = $_SESSION['usuarios'];

    // Incluimos el archivo de conexión a la base de datos
    require '../conexion/conexion.php';

    // Obtenemos los datos del usuario y su rol
    $sqlRolUser = $conexion->prepare('SELECT id, roles_id FROM usuarios WHERE correo = :correo LIMIT 1');
    $sqlRolUser->execute(array(':correo' => $correo));
    $infoCorreo = $sqlRolUser->fetch();

    // Verificamos si se ha enviado el ID del estudiante y es un número válido
    if (isset($_GET['id'])) {
        $id_usuarios = $_GET['id'];

        if($infoCorreo['id'] == $id_usuarios) {
            echo 'No puedes eliminarte a ti mismo';
        } else {
            try {
                // Preparamos la consulta para actualizar el estado del estudiante a "inactivo" 
                $sqlActualizarEstado = $conexion->prepare("UPDATE usuarios SET estados_usuarios_id = 2 WHERE id = :id");
                $sqlActualizarEstado->execute(array(':id' => $id_usuarios));
    
            } catch (Exception $e) {
                $errores = $e->getMessage();
            }
        }
    }

    // Dependiendo del rol, se redirecciona al usuario
    if ($infoCorreo['roles_id'] == 2) { // Si es estudiante
        header('Location: ../menuPrincipal.php');
    }
} else {
    header('Location: ../login.php');
}

