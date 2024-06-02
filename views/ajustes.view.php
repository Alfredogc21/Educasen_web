<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="views/imagenes/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="views/estilos/perfil.css">
  <title>Perfil de usuario</title>

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
            <li><a class="sidenav-close" href="cerrar.php">Cerrar sesion</a></li>
          </ul>
        </li>
        <li><a class="sidenav-close" href="menuPrincipal.php">Regresar</a></li>
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
        <li><a class="sidenav-close" href="menuPrincipal.php">Regresar</a></li>
        <li><a class="sidenav-close" href="cerrar.php">Cerrar sesion</a></li>
      </ul>
    </li>
  </ul>
  <!------------------------------------------------------------------------------------------------------------>
  <section class="contenedor-card">
    <div class="card-registro">
      <figure class="contenedor-figure">
        <img src="views/imagenes/logoDibujo.svg" class="contenedor-figure--img" alt="Imagen perfil">
      </figure>

      <div class="contenedor-title">
        <h2 class="contenedor-title--h2"><?php echo $nombres_completos; ?></h2>
      </div>

      <div class="contenedor-info">
        <p class="contenedor-info--parrafo">Se unio el: <?php echo $fechaRegistro ?> </p>
        <p class="contenedor-info--parrafo">Correo: <?php echo $correo; ?> </p>
        <p class="contenedor-info--parrafo">Rol: Estudiante </p>
        <p class="contenedor-info--parrafo">Estado: Activo </p>
      </div>

      <div class="contenedor-btn">
        <a href="actualizarCorreo.php" class="contenedor-btn--link">Actualizar correo</a>
        <a href="actualizarDatos.php" class="contenedor-btn--link">Actualizar contraseña</a>
      </div>
    </div>
  </section>
  </div>


  <!-- Footer -->
  <footer class="colorFooter">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text"> <strong>Institucion Educativa Central</strong></h5>
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
        <p class="copy">Copyright © - 2024 Alfredo Gomez Culma Derechos Reservados</p>
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
  <!-- Script para el SideNav -->
  <script src="views/js/jsRegistrar.js"></script>
</body>

</html>