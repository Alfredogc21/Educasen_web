<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/estilos/introduccionSociales.css">
    <link rel="shortcut icon" href="views/imagenes/favicon.ico" type="image/x-icon">
    <title>Introduccion a ciencias naturales</title>

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="views/materialize/css/materialize.min.css" media="screen,projection" />
</head>

<body>
    <!-- Cabecera menu -->
    <nav role="navigation">
        <div class="nav-wrapper">
            <a href="" class="brand-logo">
                <img src="views/imagenes/logoIECentral-removebg.png" alt="logoIECentral" class="logoIECentral">
            </a>

            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa-solid fa-bars"></i></a>
            <ul class="right hide-on-med-and-down">
                <li><a class="sidenav-close" href="menuPrincipal.php">Materias</a></li>
                <li><a class="sidenav-close" href="inteligenciaArtificial.php">Inteligencia Artificial</a></li>
                <li><a class="sidenav-close" href="#"><?php echo 'Usuario: ' . $nombreUsuario; ?></a>
                    <ul>
                        <li><a class="sidenav-close" href="ajustes.php">Perfil</a></li>
                        <li><a class="sidenav-close" href="cerrar.php">Cerrar sesión</a></li>
                    </ul>
                </li>
                <li><a class="sidenav-close" href="#video">Vídeo explicativo</a></li>
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
        <li><a class="sidenav-close" href="inteligenciaArtificial.php">Inteligencia Artificial</a></li>
        <li><a class="sidenav-close" href="ajustes.php"><?php echo $nombreUsuario; ?></a></li>
        <li><a class="sidenav-close" href="#video">Vídeo explicativo</a></li>
        <li><a class="sidenav-close" href="menuPrincipal.php">Regresar</a></li>
        <li><a class="sidenav-close" href="cerrar.php">Cerrar sesión</a></li>
    </ul>

    <!-- Contenido -->
    <section class="contenedorP1">
        <h1 class="tituloParrafo1">Ciencias Naturales <i class="fa-solid fa-book"></i></h1>
        <p class="parrafo1">La prueba de Ciencias Naturales evalúa la habilidad para entender y aplicar conceptos científicos en el razonamiento y la resolución de problemas, así como para explicar fenómenos naturales. También incluye el proceso de indagación sobre la naturaleza.</p>
    </section>

    <section class="about container2">
        <div class="about__evalua">
            <h2 class="title title--border">¿Cuáles competencias evalúa la prueba?</h2>
            <p class="about__paragraph">La prueba de Ciencias Naturales evalúa tres competencias que están alineadas con lo propuesto en los Estándares Básicos de Competencias (EBC):</p>
            <ol class="about__paragraph">
                <li>Explicación de fenómenos: Evalúa la capacidad para construir explicaciones y comprender argumentos y modelos que den razón de fenómenos, así como para establecer la validez o coherencia de afirmaciones o argumentos relacionados con problemas científicos.</li>

                <li>Uso comprensivo del conocimiento científico: Evalúa la capacidad de comprender y aplicar conceptos científicos en la resolución de problemas, así como establecer relaciones entre el conocimiento y los fenómenos observados.</li>

                <li>Indagación: Implica comprender cómo se construyen explicaciones del mundo natural mediante la investigación científica. Incluye formular preguntas, realizar experimentos y analizar resultados, destacando la importancia de que los estudiantes diseñen sus propios procedimientos.</li>
            </ol>
        </div>
        <figure class="about__picture">
            <img src="views/imagenes/cienciasNaturalesCompetenciasEvaluadas.png" class="about__img materialboxed">
        </figure>
    </section>

    <section class="afirmacionesEvidencia">
        <p class="parrafo1">Para entender cómo se desarrollan las tres competencias, es clave considerar los contextos y temas relevantes. La prueba se diseña con base en escenarios conceptuales y temáticas específicas en los que se involucran estas competencias. Los componentes que se derivan de lo establecido en los Estándares Básicos de Competencias (EBC) abordan:</p>
        <img src="views/imagenes/cienciasNaturalesComponentesEvaluadas.png" class="afirmacionesEvidencia__img materialboxed">
    </section>

    <section class="contenedorP1">
        <h2 class="tituloParrafo1">Distribución de preguntas por competencias <i class="fa-solid fa-book-open-reader"></i></h2>
        <figure class="about__picture2">
            <img src="views/imagenes/cienciasNaturalesPreguntasPorCompetencias.png" class="about__img2 materialboxed">
        </figure>
    </section>


    <div class="contenedorVideo">
        <iframe class="contenedorVideo__iframe" width="1160" height="615" id="video" src="https://www.youtube.com/embed/7K8t5zHB-Vc?si=odt99pqeS9nALU8S" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p class="contenedorVideo__parrafo">Video por <a href="https://www.youtube.com/@icfescol" target="_blank">icfescol</a> en YouTube.</p>
    </div>

    <div class="contenedorDescarga">
        <p>Descargar Guía de orientación del Examen Saber 11.º</p>
        <a href="views/documentos/Guia_de_Orientacion_Saber_11_2024-1.pdf" download="Guia_de_Orientacion_Saber_11_2024-1.pdf" class="botones"><i class="fa-solid fa-download"></i> 2024-1
        </a>
        <a href="views/documentos/Guia_de_Orientacion_Saber_11_2024-2.pdf" download="Guia_de_Orientacion_Saber_11_2024-2.pdf" class="botones"><i class="fa-solid fa-download"></i> 2024-2
        </a>
    </div>

    <div class="contenedorBotones">
        <a href="menuPrincipal.php" class="botones"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
        <a href="testCienciasNaturales.php" class="botones botones__testIntroductorio"><i class="fa-solid fa-brain"></i>Test Introductorio</a>
        <a href="examenCienciasNaturales.php" class="botones botones__testIntroductorio"><i class="fa-solid fa-person-walking-arrow-right"></i>Iniciar prueba</a>
        <a href="calificacion.php" class="botones botones__testIntroductorio"><i class="fa-solid fa-star"></i>Calificaciones</a>
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

    <!-- Links iconos font-awesome -->
    <script src="https://kit.fontawesome.com/3f592185f1.js" crossorigin="anonymous"></script>
    <!-- Framework: Materialize -->
    <script type="text/javascript" src="views/materialize/js/materialize.min.js"></script>
    <!-- Script para el introduccionLecturaView -->
    <script src="views/js/introduccionLectura.js"></script>
</body>

</html>