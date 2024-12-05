<?php

use App\Models\Paquete;

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ' . HTTP_BASE . '/login');
    exit();
}



$paquete = new Paquete();
$ventas = $paquete->listarVentas();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES_ADM; ?>plugins/dropzone/min/dropzone.min.css" />

    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES_ADM; ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES_ADM; ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- DateRangePicker -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES_ADM; ?>plugins/daterangepicker/daterangepicker.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES_ADM; ?>plugins/bs-stepper/css/bs-stepper.min.css">

    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/style-contenido.css">

</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo URL_RESOURCES; ?>adminlte/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Sidebar -->
        <?php include __DIR__ . '/partials/sidebar.php'; ?>
        <!-- toast -->

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

        <div class="content-wrapper bg-white">
            <div class="toasts-center fixed">

                <div class="toast bg-danger text-white" role="alert" aria-live="assertive" data-delay="3000">
                    <div class="toast-header">
                        <strong class="mr-auto" id="toast-titulo">Notificacion</strong>
                        <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body" id="toast-mensaje">

                    </div>
                </div>
            </div>

            <div id="content" class="content_main">
                <?php require __DIR__ . '/admin/dashboard.php'; ?>
            </div>


        </div>

        <!-- Footer -->
        <div class="content-wrapper">

        </div>
    </div>



    <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="<?php echo URL_RESOURCES; ?>adminlte/dist/js/adminlte.min.js"></script>

    <!-- Dropzone -->
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/dropzone/min/dropzone.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/select2/js/select2.full.min.js"></script>
    <!-- DateRangePicker -->
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/moment/moment.min.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/moment/locale/es.js"></script>
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/daterangepicker/daterangepicker.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables/jquery.dataTables.min.js"></script>
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
    <script src="<?php echo URL_RESOURCES_ADM; ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- AdminLTE App -->
    <!-- BS-Stepper -->
    <script src="<?php echo URL_RESOURCES_ADM; ?>/plugins/bs-stepper/js/bs-stepper.min.js"></script>

    <!-- Animacion footer -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Model - bodys -->
    <script src="<?php echo URL_RESOURCES; ?>js/modal_body.js"></script>

    <script src="<?php echo URL_RESOURCES; ?>js/script_base.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $("#content")
                .find(".table")
                .DataTable({
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");
        })
    </script>


</body>

</html>