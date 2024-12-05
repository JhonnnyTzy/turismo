<?php


// Evitar almacenamiento en caché
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['rol'] == 'ADMIN') {
        header('Location: ' . HTTP_BASE . '/admin');
        exit();
    }
}



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
    <link rel="icon" href="<?php echo URL_RESOURCES; ?>images/icono.jpg" type="image/png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/footer-css.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/styles-user.css">

</head>

<body>
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?php echo URL_RESOURCES; ?>adminlte/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <div class="modal fade" id="modal-default" style="transition: transform 0.5s ease-out, opacity 0.5s ease-out;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="modal-header">
                    <h4 class="modal-title" id="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <p>Contenido dinámico aquí...</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="modal-confirm">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <?php include __DIR__ . '/partials/navbar.php'; ?>



    <div class="content" id="content">
        <?php include __DIR__ . '/partials/header.php'; ?>

        <h2 style="text-align: center; font-size: 5rem; margin-top: 50px"> <b>RESERVA TU VIAJE</b></h2>
        <section class="container-collage">
            <article class="item item-1" style="background-image: url('<?php echo URL_RESOURCES; ?>/images/valle_luna.jpg')">
                <div class="fondo">
                    <div class="contenido">
                        <div class="texto">
                            <h3>Valle de la Luna</h3>
                            <p>Un paisaje surrealista de formaciones rocosas únicas, perfecto para explorar.</p>
                        <a href="" class="menu_item menu-link"
                    data-url="view/paquetes"
                    data-ajax="true">Descrube La Paz</a>
                    </div>
                        </div>

                        
                </div>

            </article>
            <article class="item item-2" style="background-image: url('<?php echo URL_RESOURCES; ?>/images/cataratas.jpeg')">
                <div class="fondo">
                    <div class="contenido">
                        <div class="texto">
                            <h3>Cataratas de Espejillos</h3>
                            <p>Una joya escondida con cascadas cristalinas rodeadas de exuberante vegetación</p>
                            <a href="" class="menu_item menu-link"
                    data-url="view/paquetes"
                    data-ajax="true">Descubre Santa Cruz</a>
                        </div>

                        
                    </div>
                </div>

            </article>
            <article class="item item-3" style="background-image: url('<?php echo URL_RESOURCES; ?>/images/laguna_corani.jpg')">
                <div class="fondo">
                    <div class="contenido">
                        <div class="texto">
                            <h3>Laguna Corani</h3>
                            <p>Un lugar tranquilo para relajarse y disfrutar de deportes acuáticos en medio de montañas.</p>
                            <a href="" class="menu_item menu-link"
                    data-url="view/paquetes"
                    data-ajax="true">Descrube Cochabamba</a>
                        </div>

                        
                    </div>
                </div>

            </article>
            <article class="item item-4" style="background-image: url('<?php echo URL_RESOURCES; ?>/images/riberalta.jpeg')">
                <div class="fondo">
                    <div class="contenido">
                        <div class="texto">
                            <h3>Riberalta: Ciudad de los Castaños</h3>
                            <p>Conocida por sus ríos y tradición castañera, ideal para un viaje cultural y natural</p>
                            <a href="" class="menu_item menu-link"
                    data-url="view/paquetes"
                    data-ajax="true">Descubre Beni</a>
                        </div>

                        
                    </div>
                </div>

            </article>

            <article class="vides">
                
            </article>
        </section>

        <?php include __DIR__ . '/partials/footer.php'; ?>
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