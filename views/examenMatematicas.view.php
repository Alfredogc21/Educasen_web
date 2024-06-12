<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="views/estilos/pruebas.css">
  <link rel="shortcut icon" href="views/imagenes/favicon.ico" type="image/x-icon">
  <title>Examen - Matemáticas</title>

  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="views/materialize/css/materialize.min.css" media="screen,projection" />
  <!-- Libreria sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <!------------------------------------------------------------------------------------------------------------>

  <!-- Cabecera menu -->
  <nav role="navigation">
    <div class="nav-wrapper">
      <a href="" class="brand-logo">
        <img src="views/imagenes/logoIECentral-removebg.png" alt="logoIECentral" class="logoIECentral">
      </a>

      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa-solid fa-bars"></i></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="sidenav-close" href="menuPrincipal.php">Materias</a></li>
        <li><a class="sidenav-close" href="#"><?php echo 'Usuario: ' . $nombreUsuario; ?></a>
          <ul>
            <li><a class="sidenav-close" href="ajustes.php">Perfil</a></li>
            <li><a class="sidenav-close" href="#">Ayuda</a></li>
            <li><a class="sidenav-close" href="cerrar.php">Cerrar sesión</a></li>
          </ul>
        </li>
        <li><a class="sidenav-close" href="introduccionMatematicas.php">Regresar</a></li>
      </ul>
    </div>
  </nav>

  <!-- Cabecera menus para pantallas pequeñas  -->
  <ul class="sidenav" id="mobile-demo">
    <div class="logoMobile">
      <img src="views/imagenes/favicon.svg" class="logoMobile" alt="educasen" width="200" height="200">
    </div>
    <li><a class="sidenav-close" href="menuPrincipal.php">Materias</a></li>
    <li><a class="sidenav-close" href="ajustes.php"><?php echo 'Usuario: ' . $nombreUsuario; ?></a></li>
    <li><a class="sidenav-close" href="#">Ayuda</a></li>
    <li><a class="sidenav-close" href="introduccionMatematicas.php">Regresar</a></li>
    <li><a class="sidenav-close" href="cerrar.php">Cerrar sesión</a></li>
  </ul>

  <!------------------------------------------------------------------------------------------------------------>
  <h1 class="titulo">Prueba de Matemáticas</h1>
  <?php if ($errores) : ?>
    <div class="error">
      <?php echo $errores; ?>
    </div>
  <?php else : ?>
    <div class="contenedor">
      <h2 class="contenedor__Pregunta">Pregunta</h2>
      <img class="imagenEnunciadoPregunta materialboxed" src="views/imagenes/fotos/<?php echo $resultadoImagen[0]['imagen']; ?>" alt="Imagen de la pregunta">
      <div class="contenedor__Opciones">
        <h3 class="contenedor__parrafo"><?php echo $resultadoPregunta[0]['enunciado_pregunta'] . '<br>'; ?></h3> <!-- Mostrar la pregunta -->
        <form class="contenidoOpciones" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="preguntas">
          <?php
          $fila = '';
          //Recorre las respuestas de acuerdo a la pregunta
          foreach ($resultadoRespuestas as $fila) {
            echo '<p><label>
              <input class="with-gap" type="radio" name="respuesta" value="' . $fila['validacion_pregunta_id'] . '"/>
              <span class="enunciadoSpan">' . $fila['contenido_respuestas'] . '<br>' . '</span>
              </label> </p>';
          }
          ?>
          <input type="hidden" name="idd" value="<?php echo $idPregunta2 ?>">

          <!-- Boton de enviar los datos -->
          <div class="col s10 offset-s1 center-align">
            <i class="#7986cb indigo lighten-2 btn" onclick="preguntas.submit()">Siguiente</i>
          </div>
        </form>

      </div>
    </div>
  <?php endif; ?>


  <!-- Footer -->
  <footer class="colorFooter">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text"> <strong>Institución Educativa Central</strong></h5>
          <p class="grey-text text-lighten-4">Saldaña - Tolima</p>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text"><strong>Redes Sociales</strong></h5>
          <ul>
            <li><a class="grey-text text-lighten-3" href="#" target="_blank">Facebook</a></li>
            <li><a class="grey-text text-lighten-3" href="#">Twitter</a></li>
            <li><a class="grey-text text-lighten-3" href="#">Instagram</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        <p class="copy">Copyright © 2024 Alfredo Gomez Culma y el ICFES</p>
        <a> <img src="views/imagenes/logoIECentral-removebg.png" width="100px" height="90px" class="logoAbajo right"></a>
      </div>
    </div>
  </footer>

  <!-- Links iconos font-awesome -->
  <script src="https://kit.fontawesome.com/3f592185f1.js" crossorigin="anonymous"></script>
  <!-- Framework: Materialize -->
  <script type="text/javascript" src="views/materialize/js/materialize.min.js"></script>
  <!-- Script para el testLecturaView -->
  <script src="views/js/introduccionLectura.js"></script>
  <script src="views/js/bloquearDerecho.js"></script>
</body>

</html>