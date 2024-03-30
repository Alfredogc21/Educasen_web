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

	// Mostrar las materias
	$sql_Materias = $conexion->prepare('SELECT * FROM materias');
	$sql_Materias->execute();
	$resultadoMaterias = $sql_Materias->fetchAll();

	// Mostrar las opciones de preguntas
	$sql_OpPreguntas = $conexion->prepare('SELECT * FROM opcion_pregunta');
	$sql_OpPreguntas->execute();
	$resultadoOpPregunta = $sql_OpPreguntas->fetchAll();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$materia = $_POST['materia'];
		$Oppregunta = $_POST['Oppregunta'];
		$pregunta = $_POST['pregunta'];

		//Validar que no este vacio
		if (empty($materia) or empty($Oppregunta) or empty($pregunta)) {
			$errores = 'Por favor rellena todos los campos';
			$errores .= "<script>
			Swal.fire({
				title: 'Opps...',
				text: 'Por favor rellena todos los campos',
				icon: 'error',
				confirmButtonText: 'Intentar de nuevo',
				showCancelButton: false,
			});
		</script>";
		}

		$pregunta = stripslashes($pregunta);
		$pregunta = htmlspecialchars($pregunta);

		//Insertar en la base de datos
		$sql = $conexion->prepare('INSERT INTO preguntas (enunciado_pregunta, materia_id, opcion_pregunta_id) VALUES (:pregunta, :materia, :Oppregunta)');
		$sql->execute(array(':pregunta' => $pregunta, ':materia' => $materia, ':Oppregunta' => $Oppregunta));

		$success .= "<script> 
			Swal.fire({
				title: 'Pregunta agregada correctamente',
				text: 'Haz clic en el botón para ingresar las opciones de respuesta',
				icon: 'success',
				confirmButtonText: 'Agregar respuestas',
				showCancelButton: false,
				allowOutsideClick: false,
				allowEscapeKey: false,
				allowEnterKey: false
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = 'insertarOPregunta.php';
				}
			});
		</script>";
	

	}

	if ($infoCorreo['roles_id'] == 2) { // Si es estudiante
		header('Location: ../menuPrincipal.php');
	} else if ($infoCorreo['roles_id'] == 1) { // Si es administrador
		require 'views/agregarPregunta.view.php';
	}
} else {
	header('Location: ../login.php');
}
