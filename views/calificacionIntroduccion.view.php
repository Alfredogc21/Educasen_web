<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/estilos/testLectura_calificaciones.css">
    <link rel="shortcut icon" href="views/imagenes/favicon.ico" type="image/x-icon">
    <title>Resultados</title>

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="views/materialize/css/materialize.min.css"  media="screen,projection"/>
    <!-- Libreria sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
          <li><a class="sidenav-close" href="menuPrincipal.php">Materias</a></li>
          <li><a class="sidenav-close" href="#"><?php echo 'Usuario: ' . $nombreUsuario; ?></a>
            <ul>
            <li><a class="sidenav-close" href="perfil.php">Perfil</a></li>
              <li><a class="sidenav-close" href="#">Ayuda</a></li>
              <li><a class="sidenav-close" href="cerrar.php">Cerrar sesion</a></li>
            </ul>
          </li>
          <li><a class="sidenav-close" href="introduccionLectura.php">Regresar</a></li>
        </ul>
    </div>
</nav>
  
  <!-- Cabecera menus para pantallas pequeñas  -->
<ul class="sidenav" id="mobile-demo">
    <img class="" src="views/imagenes/file.png" width="300" height="120" alt="logoICFES">
    <li><a class="sidenav-close" href="menuPrincipal.php">Materias</a></li>
    <li><a class="sidenav-close" href="perfil.php"><?php echo 'Usuario: ' . $nombreUsuario; ?></a></li>
    <li><a class="sidenav-close" href="#">Ayuda</a></li>
    <li><a class="sidenav-close" href="cerrar.php">Cerrar sesion</a></li>
    <li><a class="sidenav-close" href="introduccionLectura.php">Regresar</a></li>
    <figure>
      <img src="views/imagenes/favicon.svg" alt="educasen" class="educasen" width="200" height="200">
    </figure>
</ul>
  
<!------------------------------------------------------------------------------------------------------------>
<br>
<div class="row center">
  <form class="col s12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="buscar">
  <h2>Seleccione la competencia</h2>
    <select class="browser-default col s12" name="materia" required>
        <option value="" disabled selected>Seleccione la competencia</option>
        <?php
          foreach ($resultadoMaterias as $materia) {
                echo '<option value="' . $materia['id'] . '">' . $materia['nombres_materias'] . '</option>';
          }
        ?>
    </select>
    <div class=" row offset-s1 center-align">
      <i class="#7986cb indigo lighten-2 btn " onclick="buscar.submit()">Consultar</i>
    </div>
  </form>

</div>

<div class="contenedorPreguntas">
  <div class="contenedorPreguntas__Correstas preguntas"><!-- Mostrar enunciado de la pregunta cuando validacion es correcta -->
    <h3>Preguntas correctas</h3>
    <?php
        if($resultadoCalificacion):
          foreach ($resultadoCalificacion as $key => $value) {
            if ($value['validacion_pregunta_id'] == 1) {
              echo '<li>' . $value['enunciado_pregunta'] . '</li>';
            }
          }
        endif;

    ?>
  </div>
  <div class="contenedorPreguntas__Incorrectas preguntas"><!-- Mostrar enunciado de la pregunta cuando validacion es incorrecto -->
    <h3>Preguntas incorrectas</h3>
    <?php
      if($resultadoCalificacion):
        foreach ($resultadoCalificacion as $key => $value) {
          if ($value['validacion_pregunta_id'] == 2) {
             echo '<li>' . $enunciado = $value['enunciado_pregunta'] . '</li>';
          }
        }
      endif;
    ?>
</div>

<div class="contenedor__grafico center">
    <h3 class="center"><?php if($resultadoCalificacion) {echo "Resultados introductorios de " . $resultadoCalificacion[0]['nombres_materias'];} ?></h3>
    <?php if($resultadoCalificacion):?>
      <div class="contenedor__grafico1">
        <canvas class="graficosPosicion" id="myChart" width="400" height="400"></canvas>
      </div>
      <div class="contenedor__grafico2">
        <canvas class="graficosPosicion" id="myChart2" width="400" height="400"></canvas>
      </div>
    <?php else: ?>
      <h3 class="center">No hay resultados</h3>
    <?php endif; ?>
</div>



<!-- Links iconos font-awesome -->
<script src="https://kit.fontawesome.com/3f592185f1.js" crossorigin="anonymous"></script>
<!-- Framework: Materialize -->
<script type="text/javascript" src="views/materialize/js/materialize.min.js"></script>
<!-- Script para el testLecturaView -->
<script src="views/js/introduccionLectura.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"> </script>
<script>
  // Grafico de barras
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Correctas', 'Incorrectas'],
            datasets: [{
                label: 'Calificacion',
                data: [<?php echo $correctas; ?>, <?php echo $incorrectas; ?>],
                backgroundColor: [
                    'rgba(236, 47, 230, 0.538)',
                    'rgba(255, 166, 0, 0.577)'
                ],
                borderColor: [
                    'rgba(236, 47, 230, 0.538)',
                    'rgba(255, 166, 0, 0.577)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

//Grafico de torta
var ctx = document.getElementById('myChart2').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Correctas', 'Incorrectas'],
        datasets: [{
            label: 'Calificacion',
            data: [<?php echo $correctas; ?>, <?php echo $incorrectas; ?>],
            backgroundColor: [
                'rgba(220, 20, 60, 0.571)',
                'rgba(70, 131, 180, 0.653)'
            ],
            borderColor: [
                'rgba(220, 20, 60, 0.571)',
                'rgba(70, 131, 180, 0.653)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
</body>
</html>