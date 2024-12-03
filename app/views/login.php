<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/dist/css/adminlte.min.css">

  <style>
    .toast-container {
      
      position: fixed;
      width: 100%;
      top: 10px;
      margin: auto;
      z-index: 10;
      /* Asegura que el toast esté encima de otros elementos */
      .toast-header	{
        background-color: #c94848 !important;
      }
    }

  </style>
</head>

<body class="hold-transition login-page">

  <?php
  session_start();
  if (isset($_SESSION['toast'])):
  ?>
    <div class="toast-container d-flex justify-content-center">
      <div class="toast bg-danger text-white" role="alert" aria-live="assertive" data-delay="2000">
        <div class="toast-header ">
          <strong class="mr-auto">Error al iniciar sesión</strong>
          <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          <?php echo htmlspecialchars($_SESSION['toast']['message']); ?>
        </div>
      </div>
    </div>
  <?php endif; 
  session_unset();
  ?>

  <div class="login-box">
    <div class="login-logo">
      <h1>Iniciar Sesión</h1>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        
        <form action="login" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Usuario" name="usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Contraseña" name="contrasena">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">Remember Me</label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
        <p class="mb-0">
          <a href="view/registrar" class="text-center">Registrar nuevo miembro</a>
        </p>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo URL_RESOURCES; ?>adminlte/dist/js/adminlte.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.toast').toast('show');
    });
  </script>

</body>

</html>