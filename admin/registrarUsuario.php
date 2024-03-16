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

    //Para obtener los datos del grado
    $statementGrados = $conexion->prepare('SELECT id, nombre_grado FROM grados');
    $statementGrados->execute();
    $resultadoGrado = $statementGrados->fetchAll();

    //Para obtener los roles
    $statementRoles = $conexion->prepare('SELECT id, nombre FROM roles');
    $statementRoles->execute();
    $resultadoRol = $statementRoles->fetchAll();

    // Recibimos los datos
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $correo = filter_var(strtolower($_POST['correo']), FILTER_SANITIZE_EMAIL); // FILTER_SANITIZE_EMAIL -> filtra el correo
        $password = $_POST['password'];
        $confipassword = $_POST['confipassword'];
        $grado = isset($_POST['grado']) ? $grado = $_POST['grado'] : $grado = null;
        $rol = isset($_POST['roles']) ? $rol = $_POST['roles'] : $rol = null;

        // Verificamos que los campos no esten vacios
        $errores = '';
        $success = '';
        if (empty($nombre) or empty($correo) or empty($password) or empty($confipassword) or empty($rol)) {
            $errores .= "<script> Swal.fire(
                    'Opps...',
                    'Por favor rellena todos los datos correctamente',
                    'error')</script>";
            $errores .= '<li class="#ef5350 red lighten-1">Por favor rellena todos los datos correctamente</li>';
        } else {
            // Verificamos que el correo no exista
            $statement = $conexion->prepare('SELECT * FROM usuarios WHERE correo = :correo LIMIT 1');
            $statement->execute(array(':correo' => $correo));
            $resultado = $statement->fetch();

            if ($resultado != false) {
                $errores .= "<script> Swal.fire(
                        'Opps...',
                        'El correo ya existe',
                        'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">El correo ya existe</li>';
            }

            $password = hash('sha512', $password);
            $confipassword = hash('sha512', $confipassword);

            // Verificamos que las contraseñas coincidan
            if ($password != $confipassword) {
                $errores .= "<script> Swal.fire(
                        'Opps...',
                        'Las contraseñas no coinciden',
                        'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">Las contraseñas no coinciden</li>';
            }

            // Verificamos el rol
            if ($rol == null) {
                $errores .= "<script> Swal.fire(
                        'Opps...',
                        'Por favor selecciona un rol',
                        'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">Por favor selecciona un rol</li>';
            }

            // Verificamos que el captcha este correcto
            $ip = $_SERVER['REMOTE_ADDR'];
            $captcha = $_POST['g-recaptcha-response'];
            $secretkey = "6LfL90kgAAAAADdvH6SJ4K8Kb-7ho9JzExaKi-P7";

            $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");
            $atributos = json_decode($respuesta, true);

            if ($atributos['success'] == false) {
                $errores .= "<script> Swal.fire(
                        'Opps...',
                        'Por favor valida el reCaptcha',
                        'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">Por favor verifica el captcha</li>';
            }
        }

        // Si no hay errores
        if ($errores == '') {
            $statement = $conexion->prepare('INSERT INTO usuarios (id, nombres_completos, grado_id, roles_id, correo, password) VALUES (null, :nombre, :curso, :rol, :correo, :password)');
            $statement->execute(array(':nombre' => $nombre, ':curso' => $grado, ':correo' => $correo, ':password' => $password, ':rol' => $rol));
            $success .= "<script> Swal.fire(
                    'Bienvenido',
                    'Usuario registrado correctamente',
                    'success')</script>";
            $success .= '<li>Usuario registrado exitosamente</li>';

            // Envío de correo electrónico
            $to = $correo;
            $subject = "Bienvenido a Educasen - Registro Exitoso";
            $headers = "From: Educasen <noreply@educasen.com>\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            // Cuerpo del mensaje en formato HTML
            $message = '
        <html>
        <head>
        <title>Bienvenido a Educasen</title>
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #eaeaea;
            color: #333;
            margin: 0;
            padding: 0;
            }
            .container {
            max-width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            }
            h1 {
            color: #6a80c0;
            }
            p {
            color: #555;
            }
            .image {
            max-width: 100%; /* La imagen ocupará el 100% del ancho del contenedor */
            height: auto; /* Mantiene la proporción original de la imagen */
            display: block; /* Centra la imagen */
            margin: 20px auto; /* Ajusta el espacio alrededor de la imagen */
            }
        </style>
        </head>
        <body>
        <div class="container">
            <h1>Bienvenido(a) a Educasen</h1>
            <p>Hola ' . $nombre . ',</p>
            <p>Tu cuenta en Educasen ha sido creada exitosamente. ¡Gracias por registrarte!</p>
            <p>¡Esperamos que disfrutes de nuestra plataforma!</p>
            <img src="https://alfredohostg.online/web/views/imagenes/logoIECentral-removebg.png" alt="ImagenInstitucion" class="image">
            <a href="https://alfredohostg.online/web" style="background-color: #6A80C0; color: #fff; padding: 10px 20px; text-decoration: none; display: inline-block; margin-top: 15px; border-radius: 5px;">Iniciar sesión</a>
        </div>
        </body>
        </html>';

            if (mail($to, $subject, $message, $headers)) {
                $success .= "<script> Swal.fire(
            'Bienvenido',
            'Usuario registrado correctamente. Se ha enviado un correo de confirmación.',
            'success')</script>";
                $success .= '<li>Se ha enviado un correo de confirmación.</li>';
            } else {
                $errores .= "<script> Swal.fire(
            'Opps...',
            'Error al enviar el correo de confirmación',
            'error')</script>";
                $errores .= '<li class="#ef5350 red lighten-1">Error al enviar el correo de confirmación</li>';
            }
        }
    }

    // Dependiendo del rol asi mismo es el enrutamiento
    if ($infoCorreo['roles_id'] == 2) { // Si es estudiante
        header('Location: ../menuPrincipal.php');
    } else if ($infoCorreo['roles_id'] == 1) { // Si es administrador
        require 'views/registrarUsuario.view.php';
    }
} else {
    header('Location: ../login.php');
}
