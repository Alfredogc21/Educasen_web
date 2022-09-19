<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="views/imagenes/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="views/estilos/registrarylogin.css">
  <title>Registrar</title>

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

    <h1 class="tituloCard">Crear una cuenta</h1>
    <figure class="fondoLading">
      <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_jcikwtux.json"  background="transparent"  speed="1"  loop autoplay></lottie-player>
    </figure>

    <!-- Formulario de registro -->
    <form class="col s12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="login">
      <div class="row">
        <div class="input-field col s6">
          <input id="name" type="text" name="nombre" class="validate" required>
          <label for="name">Nombre</label>
        </div>
        <div class="input-field col s6">
          <input id="email" type="email" name="correo" class="validate" required>
          <label for="email">Correo electronico</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" name="password" minlength="7" class="validate" required>
          <label for="password">Contraseña</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="confiPassword" type="password" name="confipassword" minlength="7" class="validate" required>
          <label for="confiPassword">Confirmar contraseña</label>
        </div>
      </div>

      <div class="row">  
        <label>Seleccione el grado</label>
        <select class="browser-default" name="grado" required>
          <option value="" disabled selected>Seleccione el grado</option>
          <?php
              // Se recorre el array de grados
              foreach($resultadoGrado as $gradoCurso) {
                echo '<option value="' . $gradoCurso['id'] . '">' . $gradoCurso['nombre_grado'] . '</option>';
              }
          ?>
        </select>
      </div>
      <br>

      <!-- recaptcha -->
      <div>
        <div class="g-recaptcha" data-sitekey="6LfL90kgAAAAAESzVF-LUvSIl6RNVx13O3MsOD49">
        </div>
      </div>
      <br>

      <div class=" row offset-s1 center-align">
      <i class="#7986cb indigo lighten-2 btn " onclick="login.submit()">Registrar</i>
      </div>

      <?php if(!empty($errores)): ?> <!-- Si hay errores los muestra -->
        <div class="error">
          <ul>
            <?php echo $errores; ?>
          </ul>
        </div>
        <?php elseif(!empty($success)): ?> <!-- Si no hay errores y si hay un mensaje de exito -->
          <div class="success">
            <ul>
              <?php echo $success; ?>
            </ul>
          </div>
      <?php endif; ?>
    </form>
    <a class="linkTengoCuenta" href="login.php">Tengo una cuenta</a>

  </div>
</div>

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
</body>
</html>