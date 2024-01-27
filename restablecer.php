<?php session_start();

// Validamos si hay una sesion
if (isset($_SESSION['usuarios'])) {
    header('Location: index.php');
}

$errores = '';
$resultado = 0;

try {
    // Recibimos los datos
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $correoB = filter_var(strtolower($_POST['correo']), FILTER_SANITIZE_EMAIL); // FILTER_SANITIZE_EMAIL -> filtra el correo

        //Hacemos la conexion a la base de datos
        require 'conexion/conexion.php';

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
        if (empty($correoB) or empty($captcha)) {
            $errores .= "<script> Swal.fire(
                    'Por favor',
                    'Ingrese el correo y verifica el captcha',
                    'error')</script>";
            $errores .= '<li class="#ef5350 red lighten-1">Por favor rellena todos los campos</li>';
        } else {
            // Verificamos que el correo y contraseña exista
            $statement = $conexion->prepare('SELECT id, correo, estados_usuarios_id FROM usuarios WHERE correo = :correo');
            $statement->execute(array(':correo' => $correoB));
            $resultado = $statement->fetch(); // Almacenamos el resultado

            if ($resultado !== false) { // Si hay datos en la base de datos

                //Aqui se hace el restablecimiento de contraseña
                $idUsuario = $resultado['id']; // Obtener el id del usuario

                // Aquí generas el token para el restablecimiento de contraseña
                $token = bin2hex(random_bytes(32));

                // Calcular la fecha y hora de expiración (10 minutos a partir de ahora)
                $tiempo_Expiracion = date('Y-m-d H:i:s', strtotime('+10 minutes'));

                // Insertar el token en la tabla reset_tokens junto con el id del usuario y la fecha de expiración
                $insertToken = $conexion->prepare('INSERT INTO reset_tokens (usuarios_id, token, tiempo_expiracion) VALUES (:usuarios_id, :token, :tiempo_Expiracion)');
                $insertToken->execute(array(':usuarios_id' => $idUsuario, ':token' => $token, ':tiempo_Expiracion' => $tiempo_Expiracion));

                // Enviar correo electrónico con el enlace de restablecimiento
                $subject = "Restablecimiento de Contraseña";
                $message = "
                    <html>
                    <head>
                        <title>Restablecimiento de Contraseña</title>
                    </head>
                    <body style='font-family: Arial, sans-serif;'>
                        <div style='background-color: #6A80C0; color: #fff; padding: 10px; text-align: center;'>
                            <h2>Restablecimiento de Contraseña</h2>
                        </div>
                        <div style='padding: 20px;'>
                            <p>Tienes 10 minutos para clic en el siguiente enlace y restablecer su contraseña:</p>
                            <a href='https://alfredohostg.online/web/actualizarPassword.php?email=$correoB&token=$token' style='background-color: #6A80C0; color: #fff; padding: 10px; text-decoration: none; display: inline-block; border-radius: 5px;'>Restablecer Contraseña</a>
                        </div>
                    </body>
                    </html>
                ";

                // Puedes personalizar el encabezado según tus necesidades
                $headers = "From: no-reply@educasen.com\r\n";
                $headers .= "Content-type: text/html; charset=UTF-8\r\n";

                // Envía el correo electrónico
                mail($correoB, $subject, $message, $headers);

                $errores .= "<script> Swal.fire({
                    title: 'Restablecimiento de Contraseña',
                    text: 'Se ha enviado un enlace de restablecimiento a su correo electrónico.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                    });
                </script>";
            } else { // Si no hay datos en la base de datos
                $errores .= "<script> Swal.fire(
                        'Se ha producido un problema',
                        'Comprueba el correo electrónico o crea una cuenta',
                        'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">Se ha producido un problema. Comprueba el correo electrónico o crea una cuenta.</li>';
            }
        }
    }
} catch (Exception $e) {
    // Manejo de excepciones
    $errores .= "Error: " . $e->getMessage();
    // También puedes guardar esto en un archivo de registro
    error_log("Error en restablecer la contraseña " . $e->getMessage(), 0);
}

// Llamamos la vista
require 'views/restablecerPassword.view.php';
