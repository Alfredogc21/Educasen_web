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
    <link type="text/css" rel="stylesheet" href="views/materialize/css/materialize.min.css"  media="screen,projection"/>
</head>
<body>
<!-- Preloader -->
<div class="center section estiloLoading" id="circulo">
  <div class="preloader-wrapper big active">
    <div class="spinner-layer spinner-blue-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
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
    <a href="" class="brand-logo" >
      <img src="views/imagenes/logoIECentral-removebg.png" alt="logoIECentral" class="logoIECentral">
    </a>

    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa-solid fa-bars"></i></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="sidenav-close" routerLink="index.php">Inicio</a></li>
        <li><a class="sidenav-close" href="./login.php">Iniciar sesion</a></li>
        <li><a class="sidenav-close" href="./registrate.php">Registrarse</a></li>
        <li><a class="sidenav-close" href="#quienesSomos">Quienes somos</a></li>
      </ul>
  </div>
</nav>

<!-- Cabecera menus para pantallas pequeñas  -->
<ul class="sidenav" id="mobile-demo">
  <img class="" src="views/imagenes/file.png" width="300" height="120" alt="logoICFES">
  <li><a class="sidenav-close" href="index.php">Inicio</a></li>
  <li><a class="sidenav-close" href="./login.php">Iniciar sesion</a></li>
  <li><a class="sidenav-close" href="./registrate.php">Registrarse</a></li>
  <li><a class="sidenav-close" href="#quienesSomos">Quienes somos</a></li>
  <figure>
    <img src="views/imagenes/favicon.svg" alt="educasen" class="educasen" width="200" height="200">
  </figure>
</ul>

<!------------------------------------------------------------------------------------------------------------> 
<header class="header">
  <div class="header__contenido">
    <figure class="header__contenido--fondoLading">
      <lottie-player class="lottieLading" src="https://assets2.lottiefiles.com/packages/lf20_4rq0nvpt.json" speed="1" loop autoplay></lottie-player>
    </figure>

    <div class="tituloLading">
      <h2>Bienvenidos estudiantes</h2>
      <p>Hoy es un gran dia para reforzar tu conocimiento para el ICFES</p>
    </div>
  </div>

  <div class="wave" style="height: 150px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M-62.36,-65.61 C215.85,256.09 275.67,-55.73 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path></svg></div>
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
  <div class="parallax"><img src="views/imagenes/imgParallax.jpg"></div>
</div>
<!------------------------------------------------------------------------------------------------------------> 
<div class="div__quienessomos">
  <h3 class="tituloImportancia" id="quienesSomos">
    <i class="fa-solid fa-building-columns"></i> Quienes somos
  </h3>

  <iframe class="iframeUbicacion" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.4410658396846!2d-75.02000968255616!3d3.9290180000000072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e394b8fbba0d859%3A0x88675c1a7b436e16!2sINSTITUCION%20EDUCATIVA%20CENTRAL!5e0!3m2!1ses-419!2sco!4v1652790186490!5m2!1ses-419!2sco" 
  width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

  <div class="cardInformativa">
    <figure>
      <img src="views/imagenes/imgCentral.jpg" alt="Foto institucion" class="imgInstitucion materialboxed">
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

<script type="text/javascript" src="views/materialize/js/materialize.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<!-- Links iconos font-awesome -->
<script src="https://kit.fontawesome.com/3f592185f1.js" crossorigin="anonymous"></script>
<script src="views/js/jsMain.js"></script>
</html>