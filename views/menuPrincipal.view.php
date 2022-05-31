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
    <link type="text/css" rel="stylesheet" href="views/materialize/css/materialize.min.css"  media="screen,projection"/>
</head>
<body class="welcome">
<!------------------------------------------------------------------------------------------------------------> 
<!-- Animacion inicial -->
<span id="splash-overlay" class="splash"></span>
<span id="welcome" class="z-depth-4"></span>

<!-- Cabecera menu -->
<nav role="navigation">
    <div class="nav-wrapper">
      <a href="" class="brand-logo" >
        <img src="views/imagenes/logoIECentral-removebg.png" alt="logoIECentral" class="logoIECentral">
      </a>
  
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa-solid fa-bars"></i></a>
        <ul class="right hide-on-med-and-down">
          <li><a class="sidenav-close" routerLink="/">Pruebas</a></li>
          <li><a class="sidenav-close" href="cuenta.html">Cuenta</a></li>
          <li><a class="sidenav-close" href="cerrar.php">Cerrar sesion</a></li>
        </ul>
    </div>
  </nav>
  
  <!-- Cabecera menus para pantallas pequeñas  -->
  <ul class="sidenav" id="mobile-demo">
    <img class="" src="views/imagenes/file.png" width="300" height="120" alt="logoICFES">
    <li><a class="sidenav-close" routerLink="/">Pruebas</a></li>
    <li><a class="sidenav-close" href="cuentaInfo.html">Cuenta</a></li>
    <li><a class="sidenav-close" href="#">Cerrar sesion</a></li>
    <figure>
      <img src="views/imagenes/favicon.svg" alt="educasen" class="educasen" width="200" height="200">
    </figure>
  </ul>
  
<!------------------------------------------------------------------------------------------------------------> 

<div class="carousel">
  <a class="carousel-item" href="#">
      <div class="testi">
          <div class="img-area">
              <img src="views/imagenes/lecturaCritica.jpg"> <!-- Foto de Annie Spratt en Unsplash -->
          </div>
          <p>"Antes de empezar a responder, es importante leer cada pregunta cuidadosamente. Por favor responde todas las preguntas de..."</p>
          <h5>Lectura Critica</h5>
      </div>
  </a>
  <a class="carousel-item" href="#">
      <div class="testi">
          <div class="img-area">
              <img src="views/imagenes/cienciasNaturales.jpg"> <!-- Foto de Dave Hoefler en Unsplash -->
          </div>
          <p>"Antes de empezar a responder, es importante leer cada pregunta cuidadosamente. Por favor responde todas las preguntas de..."</p>
          <h5>Ciencias Naturales</h5>
      </div>
  </a>
  <a class="carousel-item" href="#">
      <div class="testi">
          <div class="img-area">
              <img src="views/imagenes/competenciasCiudadanas.jpg"> <!-- Foto de Nick Night en Unsplash -->
          </div>
          <p>"Antes de empezar a responder, es importante leer cada pregunta cuidadosamente. Por favor responde todas las preguntas de..."</p>
          <h5>Competencias Ciudadanas</h5>
      </div>
  </a>
  <a class="carousel-item" href="#">
      <div class="testi">
          <div class="img-area">
              <img src="views/imagenes/matematicas.jpg"> <!-- Foto de Annie Spratt en Unsplash -->
          </div>
          <p>"Antes de empezar a responder, es importante leer cada pregunta cuidadosamente. Por favor responde todas las preguntas de..."</p>
          <h5>Matematicas</h5>
      </div>
  </a>
  <a class="carousel-item" href="#">
      <div class="testi">
          <div class="img-area">
              <img src="views/imagenes/ingles2.jpg"> <!-- Foto de Sigmund en Unsplash -->
          </div>
          <p>"Antes de empezar a responder, es importante leer cada pregunta cuidadosamente. Por favor responde todas las preguntas de..."</p>
          <h5>Ingles</h5>
      </div>
  </a>

</div>











  







 













</body>
<script type="text/javascript" src="views/materialize/js/materialize.min.js"></script>
<script src="views/js/jsMenuPrincipal.js"></script>
<!-- Links iconos font-awesome -->
<script src="https://kit.fontawesome.com/3f592185f1.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</html>