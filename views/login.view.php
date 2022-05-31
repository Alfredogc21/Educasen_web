<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="views/imagenes/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="views/estilos/registrarylogin.css">
  <title>Iniciar sesion</title>

  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="views/materialize/css/materialize.min.css"  media="screen,projection"/>
</head>
<body>
<!------------------------------------------------------------------------------------------------------------> 
<!-- Cabecera menu -->
<nav role="navigation">
  <div class="nav-wrapper">
    <a href="" class="brand-logo" >
      <img src="views/imagenes/logoIECentral-removebg.png" alt="logoIECentral" class="logoIECentral">
    </a>

    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa-solid fa-bars"></i></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="sidenav-close" href="./index.php">Inicio</a></li>
        <li><a class="sidenav-close" href="./login.php">Iniciar sesion</a></li>
        <li><a class="sidenav-close" href="./registrate.php">Registrarse</a></li>
      </ul>
  </div>
</nav>

<!-- Cabecera menus para pantallas pequeñas  -->
<ul class="sidenav" id="mobile-demo">
  <img class="" src="views/imagenes/file.png" width="300" height="120" alt="logoICFES">
  <li><a class="sidenav-close" href="index.php">Inicio</a></li>
  <li><a class="sidenav-close" href="./login.php">Iniciar sesion</a></li>
  <li><a class="sidenav-close" href="./registrate.php">Registrarse</a></li>
  <figure>
    <img src="views/imagenes/favicon.svg" alt="educasen" class="educasen" width="200" height="200">
  </figure>
</ul>
<!------------------------------------------------------------------------------------------------------------> 

<div class="contenedor-card">
  <div class="card-registro">

    <h1 class="tituloCard">Iniciar sesion</h1>
    <figure class="fondoLading">
        <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_mjlh3hcy.json"  background="transparent"  speed="1"  style="width: 200px; height: 200px;"  loop autoplay></lottie-player>
    </figure>

    <form class="col s12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="login">
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" name="correo" class="validate" required>
          <label for="email">Correo</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" name="password" class="validate" required>
          <label for="password">Contraseña</label>
        </div>
      </div>
      <div class="col s10 offset-s1 center-align">
        <i class="submit-btn fa fa-arrow-right" onclick="login.submit()"></i>
        <!-- <button class="botonRegistrar" type="submit">Iniciar sesion</button>
        <a class="linkTengoCuenta" href="./menuPrincipal.html">Iniciar sesion</a> -->
      </div>

    </form>
    <a class="linkTengoCuenta" href="registrate.php">¿No tienes una cuenta? Registrate</a>

  </div>
</body>
<script type="text/javascript" src="views/materialize/js/materialize.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<!-- Links iconos font-awesome -->
<script src="https://kit.fontawesome.com/3f592185f1.js" crossorigin="anonymous"></script>
<script src="views/js/jsRegistrar.js"></script>
</html>