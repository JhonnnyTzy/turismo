<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrar Usuario</title>
  <!-- icheck bootstrap -->

  <link rel="icon" href="<?php echo URL_RESOURCES; ?>images/icono.jpg" type="image/png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/styles.css">

</head>

<body>

  <?php
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

  <div class="login_contenedor">
    <div class="fondo_login">
      <div class="formulario_registrar">
        <div class="redes_contenedor">
          <div class="redes">
            <div class="redes_titulo">
              <h2 class="redes_title">JOMI</h2>
              <h2 class="redes_title name"><b>WASI</b></h2>
            </div>
            <div class="redes_sociales">
              <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
              <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
              <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
            </div>

          </div>
        </div>
        <div class="form_registrar">
          <form action="/turismo/usuario/registrar" method="POST" class="formulario">
            <h2 style="text-align: center; font-size: 3rem;">Registrarse</h2>
            <div class="fila">
              <input type="text" name="nombre" placeholder="Nombre" class="box_login" required>
              <input type="text" name="apellido" placeholder="Apellido" class="box_login" required>
            </div>
            <div class="fila">
              <input type="email" name="email" placeholder="Email" class="box_login casilla" required>
            </div>
            <div class="fila">
              <input type="text" name="telefono" placeholder="Telefono" class="box_login casilla" required>
            </div>

            <div class="fila">
              <input type="text" name="direccion" placeholder="Direccion (opcional) " class="box_login casilla">
            </div>

            <div class="fila">
              <input type="text" name="usuario" placeholder="Usuario" class="box_login casilla" required>
            </div>

            <div class="fila">
              <input type="password" name="contrasena1" placeholder="Contraseña" class="box_login" required>
              <input type="password" name="contrasena2" placeholder="Verificar Contraseña" class="box_login" required>
            </div>

            <button type="submit" class="btn_login">Registrar</button>

            <div class="registrarse">
              <p>Ya tienes cuenta? </p>
              <a href="login" class="enlace"> Iniciar Sesión</a>
            </div>

          </form>
        </div>
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