<!DOCTYPE html>
<html lang="es" class="light-style layout-menu-fixed">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#6A80C0">
  <link rel="shortcut icon" href="../views/imagenes/favicon.ico" type="image/x-icon">
  <title>Registro de usuarios</title>

  <link rel="stylesheet" href="views/estilos/registrarUsuario.css">

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

          <!-- Usuarios registrados -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Usuarios</span>
          </li>
          <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
              <div>Registrar</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item active">
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

        <div class="contenedor-card">
          <div class="card-registro">

            <!-- Formulario de registro -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="login">

              <fieldset>
                <legend class="tituloCard">Crear una cuenta</legend>
                <p class="contenedor-card__descripcion">Puedes crear usuarios para acceder a la plataforma</p>
                <figure class="fondoLading">
                  <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_jcikwtux.json" background="transparent" speed="1" loop autoplay></lottie-player>
                </figure>
              </fieldset>

              <fieldset class="input-group">
                <div class="input-container">
                  <label for="name">Nombre</label>
                  <input id="name" type="text" name="nombre" minlength="10" class="inputs" required value="<?php if (!empty($errores) && isset($nombre)) {
                                                                                                              echo $nombre;
                                                                                                            } ?>">
                </div>
                <div class="input-container">
                  <label for="email">Correo electronico</label>
                  <input id="email" type="email" name="correo" minlength="12" class="inputs" required value="<?php if (!empty($errores) && isset($correo)) {
                                                                                                                echo $correo;
                                                                                                              } ?>">
                </div>
              </fieldset>

              <fieldset class="input-group">
                <div class="input-container">
                  <label for="password">Contraseña</label>
                  <input id="password" type="password" name="password" minlength="7" class="inputs" required>
                </div>
                <div class="input-container">
                  <label for="confiPassword">Confirmar contraseña</label>
                  <input id="confiPassword" type="password" name="confipassword" class="inputs" minlength="7" required>
                </div>
              </fieldset>


              <fieldset>
                <select name="grado" class="inputs" required>
                  <option value="" disabled selected>Seleccione el grado</option>
                  <?php
                  // Se recorre el array de grados
                  foreach ($resultadoGrado as $gradoCurso) {
                    echo '<option value="' . $gradoCurso['id'] . '">' . $gradoCurso['nombre_grado'] . '</option>';
                  }
                  ?>
                </select>
                <select name="roles" class="inputs inputs--selects" required>
                  <option value="" disabled selected>Seleccione el rol</option>
                  <?php
                  // Se recorre el array de roles
                  foreach ($resultadoRol as $respRol) {
                    echo '<option value="' . $respRol['id'] . '">' . $respRol['nombre'] . '</option>';
                  }
                  ?>
                </select>
              </fieldset>

              <!-- recaptcha -->
              <fieldset class="contenedor__recaptcha">
                <div class="g-recaptcha" data-sitekey="6LfL90kgAAAAAESzVF-LUvSIl6RNVx13O3MsOD49">
                </div>
              </fieldset>
              <br>

              <div class="boton-container">
                <i class="menu-icono tf-icons bx bx-check" onclick="login.submit()">Registrar</i>
              </div>

              <?php if (!empty($errores)) : ?> <!-- Si hay errores los muestra -->
                <div class="error">
                  <ul>
                    <?php echo $errores; ?>
                  </ul>
                </div>
              <?php elseif (!empty($success)) : ?> <!-- Si no hay errores y si hay un mensaje de exito -->
                <div class="success">
                  <ul>
                    <?php echo $success; ?>
                  </ul>
                </div>
              <?php endif; ?>
            </form>

          </div>
        </div>


        <script src="views/js/default/jquery.js"></script>
        <script src="views/js/default/bootstrap.js"></script>
        <script src="views/js/default/perfect-scrollbar.js"></script>
        <script src="views/js/default/menu.js"></script>
        <script src="views/js/default/main.js"></script>

        <!-- JavaScript de la pagina de registos -->
        <script src="views/js/registrarUsuario.js"></script>
        <!--reCaptchat-->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <!-- Libreria: Lottie -->
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>

</html>