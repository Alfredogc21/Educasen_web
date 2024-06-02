<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="views/estilos/estilosMain.css">
  <link rel="shortcut icon" href="views/imagenes/favicon.ico" type="image/x-icon">
  <title>Educasen</title>

  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="views/materialize/css/materialize.min.css" media="screen,projection" />
</head>

<body>
  <!-- Preloader -->
  <div class="center section estiloLoading" id="circulo">
    <div class="preloader-wrapper big active">
      <div class="spinner-layer spinner-blue-only">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div>
        <div class="gap-patch">
          <div class="circle"></div>
        </div>
        <div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- div que encierra todo para el preloader -->
  <div class="hide" id="contenidoPagina">

    <!------------------------------------------------------------------------------------------------------------>
    <!-- Cabecera menu -->

    <nav role="navigation">
      <div class="nav-wrapper">
        <a href="" class="brand-logo">
          <img src="views/imagenes/logoIECentral-removebg.png" alt="logoIECentral" class="logoIECentral">
        </a>

        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa-solid fa-bars"></i></a>
        <ul class="right hide-on-med-and-down">
          <li><a class="sidenav-close" href="#">Inicio</a></li>
          <li><a class="sidenav-close" href="./login.php">Iniciar sesión</a></li>
          <li><a class="sidenav-close" href="#quienesSomos">Quienes somos</a></li>
        </ul>
      </div>
    </nav>

    <!-- Cabecera menus para pantallas pequeñas  -->
    <ul class="sidenav" id="mobile-demo">
      <div class="logoMobile">
        <img src="views/imagenes/favicon.svg" class="logoMobile" alt="educasen" width="200" height="200">
      </div>
      <li><a class="sidenav-close" href="index.php">Inicio</a></li>
      <li><a class="sidenav-close" href="./login.php">Iniciar sesión</a></li>
      <li><a class="sidenav-close" href="#quienesSomos">Quienes somos</a></li>
    </ul>

    <!------------------------------------------------------------------------------------------------------------>
    <header class="header">
      <div class="header__contenido">
        <figure class="header__contenido--fondoLading">
          <lottie-player class="lottieLading" src="https://assets2.lottiefiles.com/packages/lf20_4rq0nvpt.json" speed="1" loop autoplay></lottie-player>
        </figure>

        <div class="tituloLading">
          <h2>Bienvenidos estudiantes</h2>
          <p class="tituloLading__parrafo">Hoy es un gran dia para reforzar tu conocimiento para el ICFES</p>
        </div>
      </div>

      <div class="wave" style="height: 200px; overflow: hidden;">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
          <path d="M-62.36,-65.61 C215.85,256.09 275.67,-55.73 500.00,99.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
        </svg>
      </div>

    </header>
    <!------------------------------------------------------------------------------------------------------------>

    <h3 class="tituloImportancia">
      <i class="fa-solid fa-graduation-cap"></i> ¿Por que es importante el preicfes?
    </h3>
    <div class="descripcionImportancia">
      <p>El PreICFES es de gran utilidad ya son espacios extracurriculares en donde los docentes preparan a los estudiantes de grado undécimo, para presentar las pruebas saber 11, estas les otorgan las diferentes herramientas, buenas prácticas para reforzar tu conocimiento y así poder lograr buenos resultados.
        Esta plataforma a través del buen uso, busca potenciar lo aprendido en el colegio ya que estará a disposición de los estudiantes en cualquier momento en que deseen acceder a ella.</p>
    </div>
    <!------------------------------------------------------------------------------------------------------------>

    <div class="parallax-container">
      <div class="parallax"><img src="views/imagenes/imgParallax.jpg" alt="imagen parallax"></div>
    </div>
    <!------------------------------------------------------------------------------------------------------------>
    <div class="div__quienessomos">
      <h3 class="tituloImportancia" id="quienesSomos">
        <i class="fa-solid fa-building-columns"></i> Quienes somos
      </h3>

      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3980.43391444294!2d-75.0192265!3d3.9305165!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e394b8fbba0d859%3A0x88675c1a7b436e16!2sINSTITUCION%20EDUCATIVA%20CENTRAL!5e0!3m2!1ses-419!2sco!4v1705365832862!5m2!1ses-419!2sco" target="_blank" class="iframeUbicacion" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

      <div class="cardInformativa">
        <figure>
          <img src="views/imagenes/centralEntrada.jpg" alt="Foto institucion" class="imgInstitucion materialboxed">
        </figure>
        <h5>Institucion Educativa Central</h5>
        <p>La Institución Educativa Central, presta los servicios de educación básica PREESCOLAR, básica PRIMARIA, MEDIA ACADÉMICA (Secundaria) y Media TÉCNICA a través de un programa en articulación con el SENA. Esta institución se encuentra ubicada en el municipio de Saldaña, Tolima. Este municipio se ubica al sur del Departamento del Tolima, a una distancia de 86 Km de su capital Ibagué y tiene una población aproximada de 14.184 Habitantes (2019) según el DANE citado por ORMET Tolima</p>
      </div>
    </div>
    <!---------------------------------------------------Footer------------------------------------------------------>

    <footer class="colorFooter">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text"> <strong>Institución Educativa Central</strong></h5>
            <p class="grey-text text-lighten-4">Saldaña - Tolima</p>
          </div>
          <div class="col l4 offset-l2 s10">
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
          <a> <img src="views/imagenes/logoIECentral-removebg.png" width="100" height="90" class="logoAbajo right" alt="Logo de la institucion"></a>
        </div>
      </div>
    </footer>
  </div>

  <!-- Framework: Materialize -->
  <script type="text/javascript" src="views/materialize/js/materialize.min.js"></script>
  <!-- Libreria: Lottie -->
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <!-- Links iconos font-awesome -->
  <script src="https://kit.fontawesome.com/3f592185f1.js" crossorigin="anonymous"></script>
  <!-- Script para el index.view -->
  <script src="views/js/jsMain.js"></script>
</body>

</html>