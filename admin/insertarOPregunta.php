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

    $errores = '';
    $success = '';

    // Mostrar la ultima pregunta
    $sql_pregunta = $conexion->prepare('SELECT id, enunciado_pregunta FROM preguntas ORDER BY id DESC LIMIT 1');
    $sql_pregunta->execute();
    $resultado_pregunta = $sql_pregunta->fetch();

    // Mostrar las validaciones (Correcta, Incorrecta)
    $sql_validaciones = $conexion->prepare('SELECT * FROM validacion_pregunta');
    $sql_validaciones->execute();
    $resultado_validaciones = $sql_validaciones->fetchAll();

    // Verificar si se ha enviado un formulario POST y que no esté vacío
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        // Hacemos la conexión a la base de datos
        require '../conexion/conexion.php';
    
        // Verificar si se ha seleccionado una pregunta
        if (isset($_POST['pregunta'])) {
            // Obtener los datos del formulario
            $pregunta_id = $_POST['pregunta'];
            $tipo_contenido = $_POST['tipo_contenido'];
    
            // Verificar el tipo de contenido
            if ($tipo_contenido == 1) { // Si el contenido es texto
                // Definir el abecedario
                $letras = range('A', 'Z');
    
                // Verificar si se han enviado opciones y validaciones
                if (isset($_POST['option']) && isset($_POST['validation'])) {
                    $options = $_POST['option'];
                    $validations = $_POST['validation'];
    
                    // Iterar sobre las opciones y sus validaciones
                    for ($i = 0; $i < count($options); $i++) {
                        $option = $options[$i];
                        $validation = $validations[$i];
    
                        // Agregar la letra correspondiente a la opción
                        $opcion_letra = $letras[$i] . ') ' . $option;
    
                        // Insertar la opción en la base de datos
                        $sqlInsertOption = $conexion->prepare('INSERT INTO opcion_respuesta (contenido_respuestas, preguntas_id, validacion_pregunta_id, tipo_contenido_id) VALUES (:contenido, :pregunta_id, :validacion_id, :tipo_contenido_id)');
                        $sqlInsertOption->execute(array(':contenido' => $opcion_letra, ':pregunta_id' => $pregunta_id, ':validacion_id' => $validation, ':tipo_contenido_id' => 1)); // 1 para texto
                    }
    
                    // Mostrar mensaje de éxito
                    $success = 'Las opciones de respuesta han sido agregadas correctamente.';
                    $success .= "<script> 
                            Swal.fire({
                                title: 'Opciones de respuesta agregadas correctamente',
                                text: 'Haz clic en uno de los botones para continuar',
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Agregar nueva pregunta',
                                cancelButtonText: 'Salir',
                                footer: '<a href=\"subirImagenes.php\" style=\"display:inline-block; padding: 10px 20px; background-color: #6A80C0; color: #fff; text-decoration: none; border-radius: 5px;\">Subir imagen</a>'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'agregarPregunta.php';
                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    window.location.href = 'dashboard.php';
                                }
                            });
                        </script>";
                } else {
                    $errores = 'Debes ingresar al menos una opción de respuesta.';
                    $errores .= "<script>
                                Swal.fire({
                                    title: 'Opps...',
                                    text: 'Debes ingresar al menos una opción de respuesta',
                                    icon: 'error',
                                    confirmButtonText: 'Intentar de nuevo',
                                    showCancelButton: false,
                                });
                            </script>";
                }
            } elseif ($tipo_contenido == 2) { // Si el contenido es imagen
                // Verificar si se han enviado archivos y validaciones
                if (isset($_FILES['option']) && isset($_POST['validation'])) {
                    $validations = $_POST['validation'];
                    $files = $_FILES['option'];
    
                    // Iterar sobre los archivos y sus validaciones
                    for ($i = 0; $i < count($files['name']); $i++) {
                        $validation = $validations[$i];
                        $file_name = $files['name'][$i];
                        $file_tmp_name = $files['tmp_name'][$i];
    
                        // Verificar si es una imagen válida
                        $check = @getimagesize($file_tmp_name);
                        if ($check !== false) {
                            $carpeta_destino = '../views/imagenes/fotosORespuestas/';
                            $archivo_subido = $carpeta_destino . basename($file_name);
                            move_uploaded_file($file_tmp_name, $archivo_subido);
    
                            // Insertar la imagen en la base de datos
                            $sqlInsertOption = $conexion->prepare('INSERT INTO opcion_respuesta (contenido_respuestas, preguntas_id, validacion_pregunta_id, tipo_contenido_id) VALUES (:contenido, :pregunta_id, :validacion_id, :tipo_contenido_id)');
                            $sqlInsertOption->execute(array(':contenido' => $file_name, ':pregunta_id' => $pregunta_id, ':validacion_id' => $validation, ':tipo_contenido_id' => 2)); // 2 para imagen
    
                            // Mostrar mensaje de éxito
                            $success = 'La imagen ha sido agregada correctamente.';
                            $success .= "<script> 
                                Swal.fire({
                                    title: 'Imagen agregada correctamente',
                                    text: 'Haz clic en uno de los botones para continuar',
                                    icon: 'success',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Agregar nueva pregunta',
                                    cancelButtonText: 'Salir',
                                    footer: '<a href=\"subirImagenes.php\" style=\"display:inline-block; padding: 10px 20px; background-color: #6A80C0; color: #fff; text-decoration: none; border-radius: 5px;\">Subir imagen</a>'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'agregarPregunta.php';
                                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                                        window.location.href = 'dashboard.php';
                                    }
                                });
                            </script>";
                        } else {
                            $errores = 'El archivo subido no es una imagen válida';
                            $errores .= "<script> Swal.fire(
                                'Opps...',
                                'El archivo subido no es una imagen válida',
                                'error')</script>";
                        }
                    }
                } else {
                    $errores = "<script>
                            Swal.fire({
                                title: 'Opps...',
                                text: 'Debes seleccionar una imagen y proporcionar una validación',
                                icon: 'error',
                                confirmButtonText: 'Intentar de nuevo',
                            });
                          </script>";
                }
            }
        }
    }


    if ($infoCorreo['roles_id'] == 2) { // Si es estudiante
        header('Location: ../menuPrincipal.php');
    } else if ($infoCorreo['roles_id'] == 1) { // Si es administrador
        require 'views/insertarOPregunta.view.php';
    }
} else {
    header('Location: ../login.php');
}
