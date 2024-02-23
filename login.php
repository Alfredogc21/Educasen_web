<?php session_start();

//Hacemos la conexion a la base de datos
require 'conexion/conexion.php';
$errores = '';
$resultado = 0;
$email = '';

// Validamos si hay una sesion
if (isset($_SESSION['usuarios'])) {
    $email = $_SESSION['usuarios'];
    $consultarROl = $conexion->prepare('SELECT roles_id FROM usuarios WHERE correo = :correo');
    $consultarROl->execute(array(':correo' => $email));
    $resultadoConsulta = $consultarROl->fetch();

    if($resultadoConsulta['roles_id'] == 2){ // Si es estudiante
        header('Location: menuPrincipal.php');
    } else if($resultadoConsulta['roles_id'] == 1){ // Si es administrador
        header('Location: admin/dashboard.php');
    }
}

// Recibimos los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correoB = filter_var(strtolower($_POST['correo']), FILTER_SANITIZE_EMAIL); // FILTER_SANITIZE_EMAIL -> filtra el correo
    $passwordB = $_POST['password'];
    $passwordB = hash('sha512', $passwordB);

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
    if (empty($correoB) or empty($passwordB) or empty($captcha)) {
        $errores .= "<script> Swal.fire(
                    'Por favor',
                    'Rellena todos los campos',
                    'error')</script>";
        $errores .= '<li class="#ef5350 red lighten-1">Por favor rellena todos los campos</li>';
    } else {
        // Verificamos que el correo y contraseña exista
        $statement = $conexion->prepare('SELECT correo, password, estados_usuarios_id, roles_id FROM usuarios WHERE correo = :correo AND password = :password');
        $statement->execute(array(':correo' => $correoB, ':password' => $passwordB));
        $resultado = $statement->fetch(); // Almacenamos el resultado

        if ($resultado !== false) { // Si hay datos en la base de datos
            if ($resultado['estados_usuarios_id'] == 1) { //Creamos una session y enrutamos a la pagina principal
                $_SESSION['usuarios'] = $correoB;

                // Obtener información sobre la IP y ubicación
                $ip_info = json_decode(file_get_contents("https://ipinfo.io/{$_SERVER['REMOTE_ADDR']}"));

                // Envío de correo con la hora actual de Colombia, IP y ubicación
                $to = $correoB;
                $subject = "Alerta de seguridad Educasen";
                $headers = "From: Educasen <noreply@educasen.com>\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                // Configuramos la zona horaria de Colombia
                date_default_timezone_set('America/Bogota');

                // Obtenemos la hora actual de Colombia
                $horaColombia = date('Y-m-d H:i:s');

                // Obtenemos la IP y ubicación del usuario
                $ip = $_SERVER['REMOTE_ADDR'];
                $ubicacion = isset($ip_info->city) ? $ip_info->city . ', ' : '';
                $ubicacion .= isset($ip_info->region) ? $ip_info->region . ', ' : '';
                $ubicacion .= isset($ip_info->country) ? $ip_info->country : '';

                // Cuerpo del mensaje en formato HTML
                $message = "
                <html>
                <head>
                <title>Alerta de seguridad Educasen</title>
                </head>
                <body>
                <p>Hola $correoB,</p>
                <p>Detectamos un nuevo acceso a tu cuenta de Educasen, Si fuiste tú, no tienes que hacer nada. De lo contrario cambia la contraseña</p>
                <p>Hora de inicio de sesión: $horaColombia (Hora de Colombia).</p>
                <p>IP de inicio de sesión: $ip</p>
                <p>Ubicación: $ubicacion</p>
                </body>
                </html>";

                mail($to, $subject, $message, $headers);

                if ($resultado['roles_id'] == 2 ) { // Si es estudiante
                    header('Location: menuPrincipal.php');
                } else if ( $resultado['roles_id'] == 1 ) { // Si es administrador
                    header('Location: admin/dashboard.php');
                }

            } else if ($resultado['estados_usuarios_id'] == 2) { // Si el usuario esta inactivo
                $errores .= "<script> Swal.fire(
                            'Lo sentimos',
                            'El usuario esta deshabilitado',
                            'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">El usuario esta deshabilitado</li>';
            }
        } else { // Si no hay datos en la base de datos
            $errores .= "<script> Swal.fire(
                        'Se ha producido un problema al iniciar sesión',
                        'Comprueba el correo electrónico y la contraseña o crea una cuenta',
                        'error')</script>";
            $errores .= '<li class="#ef5350 red lighten-1">Se ha producido un problema al iniciar sesión. Comprueba el correo electrónico y la contraseña o crea una cuenta.</li>';
        }
    }
}

// Llamamos la vista
require 'views/login.view.php';
