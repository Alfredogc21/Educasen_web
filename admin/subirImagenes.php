<?php session_start();

// Validamos si hay una sesion
if (isset($_SESSION['usuarios'])) {

	$correo = $_SESSION['usuarios'];

	//Hacemos la conexion a la base de datos
	require '../conexion/conexion.php';

	//Hacemos la consulta para traer los datos del usuario y determinar el rol
	$sqlRolUser = $conexion->prepare('SELECT roles_id FROM usuarios WHERE correo = :correo LIMIT 1');
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

	//Mostrar las dos ultimas pregunta
	$sql_UltimaPregunta = $conexion->prepare('SELECT * FROM preguntas ORDER BY id DESC LIMIT 1');
	$sql_UltimaPregunta->execute();
	$resultadoUltimaPregunta = $sql_UltimaPregunta->fetchAll();

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES)) {

		$materia = $_POST['materia'];
		$Oppregunta = $_POST['Oppregunta'];
		$pregunta = $_POST['pregunta'];

		//Validar que no este vacio
		if (empty($materia) or empty($Oppregunta) or empty($pregunta)) {
			$errores = 'Por favor rellena todos los campos';
		}

		// La funcion getimagesize nos retorna un arreglo de propiedades de la imagen y si no es una imagen retorna false y un error notice.
		// Podemos utilizar el @ antes de la funcion para omitir el notice si no es una imagen.
		$check = @getimagesize($_FILES['foto']['tmp_name']);
		if ($check !== false) {
			$carpeta_destino = '../views/imagenes/fotos/';
			$archivo_subido = $carpeta_destino . $_FILES['foto']['name'];
			move_uploaded_file($_FILES['foto']['tmp_name'], $archivo_subido);

			$statement = $conexion->prepare('INSERT INTO imagenes_examen (id, imagen, materias_id, opcion_pregunta_id, preguntas_id) VALUES (null, :imagen, :materia, :Oppregunta, :pregunta)');
			$statement->execute(array(':imagen' => $_FILES['foto']['name'], ':materia' => $materia, ':Oppregunta' => $Oppregunta, ':pregunta' => $pregunta));

			$success .= "<script> Swal.fire(
			'Opeación exitosa',
			'La imagen se subio correctamente',
			'success')</script>";
		} else {
			$errores = "El archivo no es una imagen o el archivo es muy pesado";
			$errores .= "<script> Swal.fire(
			'Opps...',
			'El archivo no es una imagen o el archivo es muy pesado',
			'error')</script>";
		}
	}

	if ($infoCorreo['roles_id'] == 2) { // Si es estudiante
		header('Location: ../menuPrincipal.php');
	} else if ($infoCorreo['roles_id'] == 1) { // Si es administrador
		require 'views/subirImagenes.view.php';
	}
} else {
	header('Location: ../login.php');
}
