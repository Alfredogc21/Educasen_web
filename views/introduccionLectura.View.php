<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/estilos/introduccionLectura.css">
    <link rel="shortcut icon" href="views/imagenes/favicon.ico" type="image/x-icon">
    <title>Introduccion a Lectura critica</title>

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="views/materialize/css/materialize.min.css"  media="screen,projection"/>
</head>
<body>
    <!-- Cabecera menu -->
<nav role="navigation">
    <div class="nav-wrapper">
      <a href="" class="brand-logo" >
        <img src="views/imagenes/logoIECentral-removebg.png" alt="logoIECentral" class="logoIECentral">
      </a>
  
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa-solid fa-bars"></i></a>
        <ul class="right hide-on-med-and-down">
          <li><a class="sidenav-close" href="menuPrincipal.php">Materias</a></li>
            <li><a class="sidenav-close" href="#"><?php echo 'Usuario: ' . $nombreUsuario; ?></a>
              <ul>
                <li><a class="sidenav-close" href="ajustes.php">Perfil</a></li>
                <li><a class="sidenav-close" href="#">Ayuda</a></li>
                <li><a class="sidenav-close" href="cerrar.php">Cerrar sesion</a></li>
              </ul>
            </li>
            <li><a class="sidenav-close" href="#video">Video explicativo</a></li>
            <li><a class="sidenav-close" href="menuPrincipal.php">Regresar</a></li>
        </ul>
    </div>
</nav>
  
  <!-- Cabecera menus para pantallas pequeñas  -->
<ul class="sidenav" id="mobile-demo">
    <img class="" src="views/imagenes/file.png" width="300" height="120" alt="logoICFES">
    <li><a class="sidenav-close" href="menuPrincipal.php">Materias</a></li>
    <li><a class="sidenav-close" href="ajustes.php"><?php echo $nombreUsuario; ?></a></li>
    <li><a class="sidenav-close" href="#video">Video explicativo</a></li>
    <li><a class="sidenav-close" href="#">Ayuda</a></li>
    <li><a class="sidenav-close" href="menuPrincipal.php">Regresar</a></li>
    <li><a class="sidenav-close" href="cerrar.php">Cerrar sesion</a></li>
    <figure>
      <img src="views/imagenes/favicon.svg" alt="educasen" class="educasen" width="200" height="200">
    </figure>
</ul>

<!-- Contenido -->
<section class="contenedorP1">
    <h1 class="tituloParrafo1">Lectura Critica<i class="fa-solid fa-book"></i></h1>
    <p class="parrafo1">La competencia de Lectura Crítica tiene que ver, por sobretodo, con comprensión lectora, o sea, la capacidad para comprender, no solo los vocablos y oraciones sino, la globalidad de un escrito, lo cual está escrito explícitamente o la que no está escrita, pero se puede deducir.</p>
</section>

<section class="about container2">
    <div class="about__evalua">
        <h2 class="title title--border">¿Cuáles competencias evalúa la prueba?</h2>
        <p class="about__paragraph">La prueba SABER 11 de Lectura Critica evalúa tres competencias que recogen, de manera general, las habilidades del conocimiento necesarias para leer de manera crítica:</p>
        <ol class="about__paragraph">
            <li>Comprensión lectora</li>
            <li>Comprensión escrita</li>
            <li>Comprensión oral</li>
        </ol>
        <p class="about__paragraph">Las dos primeras competencias se refieren a la comprensión del contenido de un texto y la tercera a tu propio criterio frente a este y de paso entender la intención del autor.</p>
        <p class="about__paragraph">El porcentaje de preguntas de cada tipo que vas a encontrar en la prueba lo veremos a continuación en la imagen derecha.</p>
    </div>
    <figure class="about__picture">
        <img src="views/imagenes/competenciasEvaluadas.png" class="about__img materialboxed">
    </figure>
</section>

<section class="afirmacionesEvidencia">
    <img src="views/imagenes/afirmacionesEvidencia.jpg" class="afirmacionesEvidencia__img materialboxed">
    <p class="about__paragraph">Esas tres competencias son en esencia comprensión lectora. </p>
    <p class="about__paragraph"> lo más simple que es entender palabras, frases, oraciones y párrafos; hasta lo más complejo que es entender la intención del autor del texto, formarte una posición crítica y lograr determinar la validez de lo que estás leyendo.</p>
</section>

<section class="contenedorP1">
    <h2 class="tituloParrafo1">¿Cuáles son los tipos de textos que puedes encontrar en la prueba?<i class="fa-solid fa-book-open-reader"></i></h2>
    <p class="parrafo1">Estas competencias se evalúan mediante textos de diferentes tipos. Se incluyen textos continuos y textos discontinuos. Esto se debe a que, si bien la Lectura Critica de todo texto exige el uso de las competencias mencionadas, estas se ejercitan de diferentes maneras según el tipo de texto. Mira el detalle de los tipos de texto de la prueba y sus porcentajes.</p>
    <figure class="about__picture2">
        <img src="views/imagenes/literarios.png" class="about__img2 materialboxed">
    </figure>
    <figure class="about__picture2">
        <img src="views/imagenes/tipoTextosProcentajes.png" class="about__img2 materialboxed">
    </figure>
</section>

<div class="contenedorVideo">
    <iframe class="contenedorVideo__iframe" width="1160" height="615" id="video" src="https://www.youtube.com/embed/vbtRJSWlZTk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

<div class="contenedorBotones">
    <a href="menuPrincipal.php" class="botones"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
    <a href="testLectura.php" class="botones botones__testIntroductorio"><i class="fa-solid fa-brain"></i>Test Introductorio</a>
    <a href="pruebaLecturaCritica.php" class="botones botones__testIntroductorio"><i class="fa-solid fa-person-walking-arrow-right"></i>Iniciar prueba</a>
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
    <p class="copy">Copyright © - 2022 Alfredo Gomez Culma Derechos Reservados</p>
    <a> <img src="views/imagenes/logoIECentral-removebg.png" width="100px" height="90px" class="logoAbajo right"></a>
    </div>
  </div>
</footer>

<!-- Links iconos font-awesome -->
<script src="https://kit.fontawesome.com/3f592185f1.js" crossorigin="anonymous"></script>
<!-- Framework: Materialize -->
<script type="text/javascript" src="views/materialize/js/materialize.min.js"></script>
<!-- Script para el introduccionLecturaView -->
<script src="views/js/introduccionLectura.js"></script>
</body>
</html>