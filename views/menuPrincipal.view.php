<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="views/estilos/menuPrincipal.css">
  <link rel="shortcut icon" href="views/imagenes/favicon.ico" type="image/x-icon">
  <title>Principal</title>

  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="views/materialize/css/materialize.min.css" media="screen,projection" />
</head>

<body class="welcome">
  <!------------------------------------------------------------------------------------------------------------>
  <!-- Animacion inicial -->
  <span id="splash-overlay" class="splash"></span>
  <span id="welcome" class="z-depth-4"></span>

  <!-- Cabecera menu -->
  <nav role="navigation">
    <div class="nav-wrapper">
      <a href="" class="brand-logo">
        <img src="views/imagenes/logoIECentral-removebg.png" alt="logoIECentral" class="logoIECentral">
      </a>

      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa-solid fa-bars"></i></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="sidenav-close" href="ajustes.php"><?php echo 'Usuario: ' . $nombreUsuario; ?></a></li>
        <li><a class="sidenav-close" href="#">Ayuda</a></li>
        <li><a class="sidenav-close" href="cerrar.php">Cerrar sesión</a></li>
      </ul>
    </div>
  </nav>

  <!-- Cabecera menus para pantallas pequeñas  -->
  <ul class="sidenav" id="mobile-demo">
    <div class="logoMobile">
      <img src="views/imagenes/favicon.svg" class="logoMobile" alt="educasen" width="200" height="200">
    </div>
    <li><a class="sidenav-close" href="ajustes.php"><?php echo $nombreUsuario; ?></a></li>
    <li><a class="sidenav-close" href="#">Ayuda</a></li>
    <li><a class="sidenav-close" href="cerrar.php">Cerrar sesión</a></li>
  </ul>

  <!------------------------------------------------------------------------------------------------------------>
  <!-- Contenido de competencias -->
  <div class="contenedorMaterias">
    <main class="page-content">
      <div class="card">
        <div class="content">
          <h2 class="title">Lectura crítica</h2>
          <a href="introduccionLectura.php" class="botonCard">Introducción</a><br>
          <a href="examenLecturaCritica.php" class="botonCard">Practicar</a><br>
        </div>
      </div>
      <div class="card">
        <div class="content">
          <h2 class="title">Matemáticas</h2>
          <a href="introduccionMatematicas.php" class="botonCard">Introducción</a><br>
          <a href="" class="botonCard">Practicar</a><br>
        </div>
      </div>
      <div class="card">
        <div class="content">
          <h2 class="title">Sociales y Ciudadanas</h2>
          <a href="introduccionSociudadanas.php" class="botonCard">Introducción</a><br>
          <a href="" class="botonCard">Practicar</a><br>
        </div>
      </div>
      <div class="card">
        <div class="content">
          <h2 class="title">Ciencias Naturales</h2>
          <a href="introduccionNaturales.php" class="botonCard">Introducción</a><br>
          <a href="" class="botonCard">Practicar</a><br>
        </div>
      </div>
      <div class="card">
        <div class="content">
          <h2 class="title">Inglés</h2>
          <a href="introduccionIngles.php" class="botonCard">Introducción</a><br>
          <a href="" class="botonCard">Practicar</a><br>
        </div>
      </div>
    </main>
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

  <!-- Framework: Materialize -->
  <script type="text/javascript" src="views/materialize/js/materialize.min.js"></script>
  <!-- Script para el menu -->
  <script src="views/js/jsMenuPrincipal.js"></script>
  <!-- Links iconos font-awesome -->
  <script src="https://kit.fontawesome.com/3f592185f1.js" crossorigin="anonymous"></script>
  <!-- Script para la animacion inicial -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>