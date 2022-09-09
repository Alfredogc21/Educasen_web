<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/estilos/testLectura.css">
    <link rel="shortcut icon" href="views/imagenes/favicon.ico" type="image/x-icon">
    <title>Examen introductorio</title>

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
          <li><a class="sidenav-close" href="cuentaInfo.html"><?php echo ucwords($_SESSION['usuarios']); ?></a></li>
          <li><a class="sidenav-close" href="cerrar.php">Cerrar sesion</a></li>
        </ul>
    </div>
</nav>
  
  <!-- Cabecera menus para pantallas pequeñas  -->
<ul class="sidenav" id="mobile-demo">
    <img class="" src="views/imagenes/file.png" width="300" height="120" alt="logoICFES">
    <li><a class="sidenav-close" href="cuentaInfo.html"><?php echo ucwords($_SESSION['usuarios']); ?></a></li>
    <li><a class="sidenav-close" href="cerrar.php">Cerrar sesion</a></li>
    <figure>
      <img src="views/imagenes/favicon.svg" alt="educasen" class="educasen" width="200" height="200">
    </figure>
</ul>
  
<!------------------------------------------------------------------------------------------------------------> 
<h1 class="titulo">Examen introductorio (Lectura Critica)</h1>
<div class="contenedor">
    <h2 class="contenedor__Pregunta">Pregunta 1</h2>
    <div class="contenedor__Opciones">
        <h3 class="contenedor__parrafo">Para mostrar textos en la consola usamos el comando</h3>
        <form action="#">

    <p>
      <label>
        <input name="group1" type="radio" />
        <span>Yellow</span>
      </label>
    </p>
    <p>
      <label>
        <input class="with-gap" name="group1" type="radio"  />
        <span>Green</span>
      </label>
    </p>
    <p>
      <label>
        <input name="group1" type="radio" />
        <span>Brown</span>
      </label>
    </p>
    <p>
      <label>
        <input name="group1" type="radio" />
        <span>Brown</span>
      </label>
    </p>
  </form>
    </div>
</div>

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
    <p class="copy">Copyright © - 2022 Alfredo Gomez Culma Derechos Reservados</p>
    <a> <img src="views/imagenes/logoIECentral-removebg.png" width="100px" height="90px" class="logoAbajo right"></a>
    </div>
  </div>
</footer>


</body>
<script src="https://kit.fontawesome.com/3f592185f1.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="views/materialize/js/materialize.min.js"></script>
<script src="views/js/introduccionLectura.js"></script>
</html>