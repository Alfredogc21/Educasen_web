<?php session_start();

// Validamos si hay una sesion
if (isset($_SESSION['usuarios'])) {

    $correo = $_SESSION['usuarios'];
    $errores = '';
    $success = '';

    //Hacemos la conexion a la base de datos
    require '../conexion/conexion.php';

    //Hacemos la consulta para traer los datos del usuario y determinar el rol
    $sqlRolUser = $conexion->prepare('SELECT nombres_completos, roles_id FROM usuarios WHERE correo = :correo LIMIT 1');
    $sqlRolUser->execute(array(':correo' => $correo));
    $infoCorreo = $sqlRolUser->fetch();

    //Hacemos la consulta para traer los datos de los estudiantes
    $sqlEstudiantes = $conexion->prepare('SELECT usuarios.id AS id, usuarios.nombres_completos as Nombre, usuarios.fecharegistro AS fecha_registro, grados.nombre_grado AS grado, estados_usuarios.nombres_estados AS estados, usuarios.correo AS email FROM usuarios INNER JOIN grados ON usuarios.grado_id = grados.id INNER JOIN estados_usuarios ON usuarios.estados_usuarios_id = estados_usuarios.id ORDER BY usuarios.id DESC LIMIT 50');
    $sqlEstudiantes->execute();
    $sqlEstudiante = $sqlEstudiantes->fetchAll();

    //Consulta para traer los grados
    $sqlGrados = $conexion->prepare('SELECT * FROM grados');
    $sqlGrados->execute();
    $resultadoGrado = $sqlGrados->fetchAll();

    //Consultar estados
    $sqlEstados = $conexion->prepare('SELECT * from estados_usuarios');
    $sqlEstados->execute();
    $resultadoEstados = $sqlEstados->fetchAll();

    // Cantidad de registros por página
    $registrosPorPagina = 10;

    // Total de registros obtenidos de la consulta SQL
    $totalRegistros = count($sqlEstudiante);

    // Calcular el número total de páginas
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    // Determinar la página actual
    $paginaActual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    // Calcular el índice de inicio para la consulta SQL
    $indiceInicio = ($paginaActual - 1) * $registrosPorPagina;

    // Obtener una porción de los resultados de la consulta SQL para mostrar en la página actual
    $sqlEstudiantesPaginados = array_slice($sqlEstudiante, $indiceInicio, $registrosPorPagina);

    //Actualizamos el nombre, el grado y el email
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar que se hayan recibido los datos necesarios
        if (isset($_POST["nombre"], $_POST["grado"], $_POST["email"], $_POST['estados'] , $_POST["id"])) {
            try {

                // Sanitizar y validar los datos recibidos
                $nombre = htmlspecialchars(trim($_POST["nombre"]));
                $grado = intval($_POST["grado"]);
                $estados = intval($_POST["estados"]);
                $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
                $id = intval($_POST["id"]);

                // Realizar la consulta de actualización en la base de datos
                $actualizarInfo = $conexion->prepare("UPDATE usuarios SET nombres_completos = :nombre, grado_id = :grado, estados_usuarios_id = :estados, correo = :email WHERE id = :id");
                $actualizarInfo->execute(array(':nombre' => $nombre, ':grado' => $grado, ':email' => $email, ':estados' => $estados, ':id' => $id));

                // Limpiar los valores de los campos del formulario al recargar la página
                echo "<script>
                    window.onload = function() {
                        document.getElementById('id').value = '';
                        document.getElementById('nombre').value = '';
                        document.getElementById('grado').value = '';
                        document.getElementById('email').value = '';
                    }
                    </script>";

                // Redireccionar a la página principal o mostrar un mensaje de éxito
                $success .= "<script> 
                    Swal.fire({
                        title: 'Información actualizada',
                        text: 'Se actualizó la información del estudiante',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = window.location.href; // Redireccionar a la misma página
                        }
                    });
                </script>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Error: Faltan datos necesarios.";
        }
    }

    // Dependiendo del rol asi mismo es el enrutamiento
    if ($infoCorreo['roles_id'] == 2) { // Si es estudiante
        header('Location: ../menuPrincipal.php');
    } else if ($infoCorreo['roles_id'] == 1) { // Si es administrador
        require 'views/consultarEstudiantes.view.php';
    }
} else {
    header('Location: ../login.php');
}
