<?php session_start();

// Validamos si hay una sesion
if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];

    //Hacemos la conexion a la base de datos
    require '../conexion/conexion.php';

    //Hacemos la consulta para traer los datos del usuario y determinar el rol
    $sqlRolUser = $conexion->prepare('SELECT nombres_completos, roles_id FROM usuarios WHERE correo = :correo LIMIT 1');
    $sqlRolUser->execute(array(':correo' => $correo));
    $infoCorreo = $sqlRolUser->fetch();

    try {
        // Recibimos los datos
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nuevaPassword = $_POST['nueva_password'];
            $confirmarPassword = $_POST['confirmar_password'];

            $errores = '';

            // Verificamos que el captcha este correcto
            $ip = $_SERVER['REMOTE_ADDR'];
            $captcha = $_POST['g-recaptcha-response'];
            $secretkey = "6LfL90kgAAAAADdvH6SJ4K8Kb-7ho9JzExaKi-P7";

            $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");
            $atributos = json_decode($respuesta, true);

            if ($atributos['success'] == false) {
                $errores .= "<script> Swal.fire(
                                'Por favor',
                                'Valida el reCaptcha',
                                'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">Por favor verifica el captcha</li>';
            }

            // Verificamos que los campos no esten vacios
            if (empty($nuevaPassword) || empty($confirmarPassword) || empty($captcha)) {
                $errores .= "<script> Swal.fire(
                                'Por favor',
                                'Rellena todos los campos',
                                'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">Por favor rellena todos los campos</li>';
            } else {
                $nuevaPassword = hash('sha512', $nuevaPassword);
                $confirmarPassword = hash('sha512', $confirmarPassword);

                // Verificamos que las contraseñas coincidan
                if ($nuevaPassword != $confirmarPassword) {
                    $errores .= "<script> Swal.fire(
                                'Opps...',
                                'Las contraseñas no coinciden',
                                'error')</script>";
                    $errores .= '<li class="#ef5350 red lighten-1">Las contraseñas no coinciden</li>';
                } else {
                    // Actualizar la contraseña del usuario
                    $statement = $conexion->prepare('UPDATE usuarios SET password = :password WHERE correo = :correo');
                    $statement->execute(array(':password' => $nuevaPassword, ':correo' => $correo));
                    $statement->fetch();

                    // Enviar correo electrónico notificando el cambio de contraseña
                    $subject = "Cambio de Contraseña Exitoso";
                    $message = "
                    <html>
                        <head>
                            <title>Cambio de Contraseña Exitoso</title>
                        </head>
                        <body style='font-family: Arial, sans-serif;'>
                            <div style='background-color: #6A80C0; color: #fff; padding: 10px; text-align: center;'>
                                <h2>Cambio de Contraseña Exitoso</h2>
                            </div>
                            <div style='padding: 20px;'>
                                <p>Su contraseña ha sido cambiada con éxito.</p>
                                <p>Si usted no realizó este cambio, por favor contacte con nuestro soporte técnico.</p>
                            </div>
                        </body>
                    </html>";

                    // El encabezado del correo
                    $headers = "From: no-reply@educasen.com\r\n";
                    $headers .= "Content-type: text/html; charset=UTF-8\r\n";

                    // Envía el correo electrónico
                    mail($correo, $subject, $message, $headers);

                    $errores .= "<script> Swal.fire({
                                            title: 'Cambio de Contraseña',
                                            text: 'Su contraseña ha sido cambiada con éxito.',
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = '../login.php'; // Redirige a la página de login.php
                                            }
                                        });
                                        </script>";
                    session_destroy();
                }
            }
        }
    } catch (Exception $e) {
        // Manejo de excepciones
        $errores .= "Error: " . $e->getMessage();
        // También puedes guardar esto en un archivo de registro
        error_log("Error al cambiar la contraseña " . $e->getMessage(), 0);
    }

    // Dependiendo del rol asi mismo es el enrutamiento
    if ($infoCorreo['roles_id'] == 2) { // Si es estudiante
        header('Location: ../menuPrincipal.php');
    } else if ($infoCorreo['roles_id'] == 1) { // Si es administrador
        require 'views/actualizarPassword.view.php';
    }
} else {
    header('Location: ../login.php');
}
