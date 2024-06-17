<!DOCTYPE html>
<html lang="es" class="light-style layout-menu-fixed">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#6A80C0">
    <link rel="shortcut icon" href="../views/imagenes/favicon.ico" type="image/x-icon">
    <title>Resultados de estudiantes</title>

    <link rel="stylesheet" href="views/estilos/resultadosEstudiantes.css">

    <meta name="description" content="Prepárate para el ICFES con nuestra plataforma educativa. Ofrecemos recursos y prácticas para estudiantes de la Institución Educativa Central, ayudándote a alcanzar tus metas académicas en el examen ICFES y destacar en tu rendimiento académico." />

    <!-- Iconos y fuentes -->
    <link rel="stylesheet" href="views/estilos/default/boxicons.css" />
    <!-- Estilos por defecto - Core CSS -->
    <link rel="stylesheet" href="views/estilos/default/dashboard.css" />

    <!-- Helpers -->
    <script src="views/js/default/helpers.js"></script>

    <!-- Libreria sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="dashboard.php" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="../views/imagenes/logoDibujo.svg" class="imgLogo" alt="Brand Logo" class="img-fluid" />
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Educasen</span>
                    </a>

                    <a href="#" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item">
                        <a href="dashboard.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Inicio</div>
                        </a>
                    </li>

                    <!-- Registros y consultas de cuenta -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Registros y consultas</span>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-dock-top"></i>
                            <div>Registrar</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="registrarUsuario.php" class="menu-link">
                                    <div>Usuarios</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Consultas miembros de cada rol -->
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-search"></i>
                            <div>Consultar</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="consultarAdministradores.php" class="menu-link">
                                    <div>Administradores</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="consultarEstudiantes.php" class="menu-link">
                                    <div>Estudiantes</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Agregar preguntas -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Preguntas ICFES</span>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div>Agregar</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="agregarPregunta.php" class="menu-link">
                                    <div>Pregunta</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="insertarOPregunta.php" class="menu-link">
                                    <div>Opcion de respuesta</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="subirImagenes.php" class="menu-link">
                                    <div>Imagen pregunta</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Consultar preguntas -->
                    <li class="menu-item">
                        <a href="consultarPreguntas.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-file-find"></i>
                            <div>Consultar preguntas</div>
                        </a>
                    </li>

                    <!-- Consultar respuesta -->
                    <li class="menu-item">
                        <a href="consultarORespuestas.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div>Consultar respuestas</div>
                        </a>
                    </li>

                    <!-- Resultados de estudiantes -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Resultados de estudiantes</span></li>
                    <li class="menu-item active open active">
                        <a href="resultadosEstudiantes.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div>Consultar</div>
                        </a>
                    </li>

                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Diseño del contenedor -->
            <div class="layout-page">

                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="#">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Buscador -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input id="searchInput" type="text" class="form-control border-0 shadow-none" placeholder="Buscar..." aria-label="Buscar..." />
                            </div>
                        </div>
                        <!-- /Buscador -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            <!-- Perfil -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="../views/imagenes/logoDibujo.svg" alt="Logo dibujo" class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="../views/imagenes/logoDibujo.svg" alt="Logo dibujo" class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block"><?php echo $infoCorreo['nombres_completos']; ?></span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="perfil.php">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">Mi perfil</span>
                                        </a>
                                    </li>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../cerrar.php">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Cerrar sesión</span>
                                </a>
                            </li>
                        </ul>
                        </li>
                        <!--/ Perfil -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <section class="contenedor">
                    <div class="contenedor__consulta">
                        <h1 class="contenedor__titulo">Resultados de los estudiantes</h1>
                        <p class="contenedor__descripcion">Consulte aquí los resultados de los estudiantes del grado 11</p>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="buscar">

                            <section class="filters">
                                <!-- Filtro por competencia -->
                                <select name="materia" required>
                                    <option value="" disabled selected>Seleccione la competencia</option>
                                    <?php
                                    foreach ($resultadoMaterias as $materia) {
                                        echo '<option value="' . $materia['id'] . '">' . $materia['nombres_materias'] . '</option>';
                                    }
                                    ?>
                                </select>

                                <!-- Filtro por opcion_pregunta -->
                                <select name="tipopregunta" required>
                                    <option value="" disabled selected>Seleccione el tipo de pregunta</option>
                                    <?php
                                    foreach ($resultadoOpPregunta as $opPregunta) {
                                        echo '<option value="' . $opPregunta['id'] . '">' . $opPregunta['nombre_tipo_pregunta'] . '</option>';
                                    }
                                    ?>
                                </select>

                                <!-- Filtro por opcion_pregunta -->
                                <select name="estudiante" required>
                                    <option value="" disabled selected>Seleccione el estudiante</option>
                                    <?php
                                    foreach ($resultadoEstudiantes as $estudiante) {
                                        echo '<option value="' . $estudiante['id'] . '">' . $estudiante['nombres_completos'] . '</option>';
                                    }
                                    ?>
                                </select>

                                <!-- Boton de consulta -->
                                <div class="boton-container">
                                    <input class="submit menu-icono" type="submit" value="Consultar">
                                </div>

                            </section>
                        </form>

                        <!-- Mostramos el enunciado de las preguntas correctas en una tabla -->
                        <table class="titulosTabla" id="tablaCorrectas">
                            <thead>
                                <tr>
                                    <th colspan="7">Preguntas correctas <?php echo ' (' . $correctas . ')'; ?> </th>
                                </tr>
                                <tr>
                                    <th>enunciado de la pregunta</th>
                                    <th>Opcion pregunta</th>
                                    <th>Fecha contestada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($resultadoCalificacion && count($resultadoCalificacion) > 0) : ?>
                                    <?php foreach ($resultadoCalificacion as $key => $value) : ?>
                                        <?php if ($value['validacion_pregunta_id'] == 1) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($value['enunciado_pregunta'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($value['nombre_tipo_pregunta'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($value['fecha_contestada'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="3">No hay datos por el momento.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <!-- Mostramos el enunciado de las preguntas incorrectas en una tabla -->
                        <table class="titulosTabla" id="tablaIncorrectas">
                            <thead>
                                <tr>
                                    <th colspan="7">Preguntas incorrectas <?php echo ' (' . $incorrectas . ')'; ?> </th>
                                </tr>
                                <tr>
                                    <th>enunciado de la pregunta</th>
                                    <th>Opcion pregunta</th>
                                    <th>Fecha contestada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($resultadoCalificacion && count($resultadoCalificacion) > 0) : ?>
                                    <?php foreach ($resultadoCalificacion as $key => $value) : ?>
                                        <?php if ($value['validacion_pregunta_id'] == 2) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($value['enunciado_pregunta'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($value['nombre_tipo_pregunta'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($value['fecha_contestada'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="3">No hay datos por el momento.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div>
                            <h3 class="contenedor__titulograf">
                                <?php if ($resultadoCalificacion) {
                                    echo "Resultados graficados de " . $resultadoCalificacion[0]['nombres_materias'];
                                } ?>
                            </h3>

                            <section class="contenedor__graficos">
                                <?php if ($resultadoCalificacion) : ?>
                                    <aside class="contenedor__grafico1">
                                        <canvas class="graficosPosicion" id="myChart" width="400" height="400"></canvas>
                                    </aside>
                                    <aside class="contenedor__grafico2">
                                        <canvas class="graficosPosicion" id="myChart2" width="400" height="400"></canvas>
                                    </aside>
                                <?php else : ?>
                                    <h3 class="center">No hay resultados</h3>
                                <?php endif; ?>
                            </section>

                            <p class="contenedor__totalizador">Total de preguntas contestadas: <?php echo isset($resultadoCalificacion) ? count($resultadoCalificacion) : 0; ?></p>
                        </div>

                        <!-- Boton imprimir pdf -->
                        <a href="generar_pdf.php" target="_blank">
                            <button class="menu-icono">
                                <i class='bx bxs-file-pdf'></i> Imprimir PDF
                            </button>
                        </a>
                        
                    </div>
                </section>
            </div>

            <script src="views/js/default/jquery.js"></script>
            <script src="views/js/default/bootstrap.js"></script>
            <script src="views/js/default/perfect-scrollbar.js"></script>
            <script src="views/js/default/menu.js"></script>
            <script src="views/js/default/main.js"></script>

            <!-- Libreria chart para graficos -->
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