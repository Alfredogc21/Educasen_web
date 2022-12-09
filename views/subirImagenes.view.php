<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<title>Mi Increíble Galería en PHP</title>
	<link rel="stylesheet" href="views/estilos/foto.css">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="views/materialize/css/materialize.min.css"  media="screen,projection"/>

    <!-- Libreria sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
	<header>
		<div class="contenedor">
			<h1 class="titulo">Subir Foto</h1>
		</div>
	</header>

	<div class="contenedor">
		<form class="formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

        <!-- Mostramos la competencia -->
        <select class="browser-default col s6" name="materia" required>
            <option value="" disabled selected>Seleccione la competencia</option>
            <?php
            foreach ($resultadoMaterias as $materia) {
                echo '<option value="' . $materia['id'] . '">' . $materia['nombres_materias'] . '</option>';
            }
            ?>
        </select>

        <br>

        <!-- Mostrar la Opcion pregunta -->
        <select class="browser-default col s6" name="Oppregunta" required>
            <option value="" disabled selected>Seleccione la Opcion pregunta</option>
            <?php
            foreach ($resultadoOpPregunta as $Oppregunta) {
                echo '<option value="' . $Oppregunta['id'] . '">' . $Oppregunta['nombre_tipo_pregunta'] . '</option>';
            }
            ?>
        </select>

        <br>

        <!-- Mostrar la las ultimas dos preguntas -->
        <select class="browser-default col s6" name="pregunta" required>
            <option value="" disabled selected>Seleccione la ultima pregunta</option>
            <?php
            foreach ($resultadoUltimaPregunta as $pregunta) {
                echo '<option value="' . $pregunta['id'] . '">' . $pregunta['enunciado_pregunta'] . '</option>';
            }
            ?>
        </select>

        <br>

        <!-- Seleccionar la imagen -->
			<label for="foto">Seleciona tu foto</label>
			<input type="file" name="foto" id="foto" required>

			<?php if (isset($error)): ?>
				<p class="error"><?php echo $error; ?></p>
			<?php endif; ?>

			<input class="submit" type="submit" value="Subir Foto">

		</form>
	</div>

	<footer>
		<p class="copyright">Alfredo Gomez Culma</p>
	</footer>
</body>
</html>