<!DOCTYPE html>
<html lang="es" class="light-style layout-menu-fixed">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#6A80C0">
  <link rel="shortcut icon" href="../views/imagenes/favicon.ico" type="image/x-icon">
  <title>Dashboard</title>

  <link rel="stylesheet" href="views/estilos/estilosMainDashboard.css">

  <meta name="description" content="Prepárate para el ICFES con nuestra plataforma educativa. Ofrecemos recursos y prácticas para estudiantes de la Institución Educativa Central, ayudándote a alcanzar tus metas académicas en el examen ICFES y destacar en tu rendimiento académico." />

  <!-- Iconos y fuentes -->
  <link rel="stylesheet" href="views/estilos/default/boxicons.css" />
  <!-- Estilos por defecto - Core CSS -->
  <link rel="stylesheet" href="views/estilos/default/dashboard.css" />

  <!-- Helpers -->
  <script src="views/js/default/helpers.js"></script>
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
          <li class="menu-item active">
            <a href="dashboard.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div>Inicio</div>
            </a>
          </li>

          <!-- Usuarios registrados -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Usuarios</span>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link menu-toggle">
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
          <li class="menu-item">
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
                <input type="text" id="searchInput" class="form-control border-0 shadow-none" placeholder="Buscar..." aria-label="Buscar..." />
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

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-center row posicionCard">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Bienvenido estimado <?php echo $infoCorreo['nombres_completos']; ?> 🚀</h5>
                        <p class="mb-4">
                          Panel <span class="fw-bold">administrativo</span> de educasen. Aquí podrás gestionar los registros y consultas de la plataforma.
                        </p>

                        <a href="perfil.php" class="btn btn-sm btn-outline-primary">Mi perfil</a>
                      </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="card-body pb-0 px-0 px-md-4">
                        <img src="../views/imagenes/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <picture class="logoPrincipal">
            <img src="../views/imagenes/logoIECentral-removebg.png" class="logoPrincipal__img" alt="">
          </picture>


          <script src="views/js/default/jquery.js"></script>
          <script src="views/js/default/bootstrap.js"></script>
          <script src="views/js/default/perfect-scrollbar.js"></script>
          <script src="views/js/default/menu.js"></script>
          <script src="views/js/default/main.js"></script>
          <!-- JavaScript de la pagina de registos -->
          <script src="views/js/dashboard.js"></script>
</body>

</html>