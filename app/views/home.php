<?php


// Evitar almacenamiento en caché
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOMI WASI</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/footer-css.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/styles-user.css">

</head>

<body>
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?php echo URL_RESOURCES; ?>adminlte/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
    <!-- Navbar -->
    <?php include __DIR__ . '/partials/navbar.php'; ?>

    <div class="content" id="content">
        <?php include __DIR__ . '/partials/header.php'; ?>

        <section class="container-collage">
            <article class="item item-1" style="background-image: url('<?php echo URL_RESOURCES; ?>/images/ILLIMANI.jpg')">
                <div class="contenido">
                    <div class="texto">
                        <h3>El Majestuoso Illimani</h3>
                        <p>Ciudad Marravilla</p>
                    </div>

                    <a href="la-paz.html">Descubre La Paz</a>
                </div>
            </article>
            <article class="item item-2" style="background-image: url('<?php echo URL_RESOURCES; ?>/images/ILLIMANI.jpg')">
                <div class="contenido">
                    <div class="texto">
                        <h3>El Majestuoso Illimani</h3>
                        <p>Ciudad Marravilla</p>
                    </div>

                    <a href="la-paz.html">Descubre La Paz</a>
                </div>
            </article>
            <article class="item item-3" style="background-image: url('<?php echo URL_RESOURCES; ?>/images/ILLIMANI.jpg')">
                <div class="contenido">
                    <div class="texto">
                        <h3>El Majestuoso Illimani</h3>
                        <p>Ciudad Marravilla</p>
                    </div>

                    <a href="la-paz.html">Descubre La Paz</a>
                </div>
            </article>
            <article class="item item-4" style="background-image: url('<?php echo URL_RESOURCES; ?>/images/ILLIMANI.jpg')">
                <div class="contenido">
                    <div class="texto">
                        <h3>El Majestuoso Illimani</h3>
                        <p>Ciudad Marravilla</p>
                    </div>

                    <a href="la-paz.html">Descubre La Paz</a>
                </div>
            </article>
        </section>


    </div>



    <!-- jQuery -->
    <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- DataTables  & Plugins -->
    <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/jszip/jszip.min.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


    <!-- AdminLTE App -->
    <script src="<?php echo URL_RESOURCES; ?>adminlte/dist/js/adminlte.min.js"></script>

    <!-- Animacion footer -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script script src="<?php echo URL_RESOURCES; ?>js/scripts-user.js"></script>

    <script>
        // Añadir una entrada al historial al cargar la página
        window.history.pushState({
            page: 1
        }, "home", "/turismo/home");

        
    </script>


</body>

</html>