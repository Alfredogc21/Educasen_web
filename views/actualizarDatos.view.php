<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="views/imagenes/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="views/estilos/actualizarInfo.css">
  <title>Actualizar contraseña</title>

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
        <li><a class="sidenav-close" href="#"><?php echo 'Usuario: ' .  $nombres_completos; ?></a>
          <ul>
            <li><a class="sidenav-close" href="#">Ayuda</a></li>
            <li><a class="sidenav-close" href="cerrar.php">Cerrar sesión</a></li>
          </ul>
        </li>
        <li><a class="sidenav-close" href="ajustes.php">Regresar</a></li>
      </ul>
    </div>
  </nav>

  <!-- Cabecera menus para pantallas pequeñas  -->
  <ul class="sidenav" id="mobile-demo">
    <div class="logoMobile">
      <img src="views/imagenes/favicon.svg" class="logoMobile" alt="educasen" width="200" height="200">
    </div>
    <li><a class="sidenav-close" href="menuPrincipal.php">Materias</a></li>
    <li><a class="sidenav-close" href="#"><?php echo 'Usuario: ' .  $nombres_completos; ?></a>
      <ul>
        <li><a class="sidenav-close" href="#">Ayuda</a></li>
        <li><a class="sidenav-close" href="ajustes.php">Regresar</a></li>
        <li><a class="sidenav-close" href="cerrar.php">Cerrar sesión</a></li>
      </ul>
    </li>
  </ul>
  <!------------------------------------------------------------------------------------------------------------>

  <div class="contenedor-card">
    <div class="card-registro">

      <h1 class="tituloCard">Actualizar contraseña</h1>
      <figure class="fondoLading">
        <lottie-player class="fondoLading__lottie" src="https://assets9.lottiefiles.com/packages/lf20_md7jx0xq.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
      </figure>

      <!-- Formulario de registro -->
      <form class="col s12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="actualizar">
        <div class="row">
          <br>
          <div class="row__input input-field col s6">
            <input id="password" type="password" name="nueva_password" minlength="7" class="validate" required>
            <label for="password">Contraseña</label>
          </div>
          <div class="input-field col s6">
            <input id="confiPassword" type="password" name="confirmar_password" minlength="7" class="validate" required>
            <label for="confiPassword">Confirmar contraseña</label>
          </div>
        </div>

        <!-- recaptcha -->
        <div class="contenedor__recaptcha">
          <div class="g-recaptcha" data-sitekey="6LfL90kgAAAAAESzVF-LUvSIl6RNVx13O3MsOD49"></div>
        </div>
        <br>

        <div class=" row offset-s1 center-align">
          <i class="#7986cb indigo lighten-2 btn " onclick="actualizar.submit()">Actualizar</i>
        </div>

        <?php if (!empty($errores)) : ?> <!-- Si hay errores los muestra -->
          <div class="error">
            <ul>
              <?php echo $errores; ?>
            </ul>
          </div>
        <?php elseif (!empty($success)) : ?> <!-- Si no hay errores y si hay un mensaje de exito -->
          <div class="success">
            <ul>
              <?php echo $success; ?>
            </ul>
          </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
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

  <!--reCaptchat-->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- Framework: Materialize -->
  <script type="text/javascript" src="views/materialize/js/materialize.min.js"></script>
  <!-- Libreria: Lottie -->
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <!-- Links iconos font-awesome -->
  <script src="https://kit.fontawesome.com/3f592185f1.js" crossorigin="anonymous"></script>
  <!-- Script para el registrarView -->
  <script src="views/js/jsRegistrar.js"></script>
  <!-- Archivo js de alertas -->
  <script src="views/js/sweetAlert.js"></script>
</body>

</html>