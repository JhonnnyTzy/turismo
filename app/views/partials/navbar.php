<!-- Navbar -->
<nav class="menu_main topbar" id="navbar">
    <!-- Left navbar links -->
    <div class="logo_container">
        <h2>JOMI WASI</h2>
    </div>

    <div class="menu_container">
        <ul class="menu">
            <li><a href="" class="menu_item menu-link">Inicio</a></li>
            <li><a href="" class="menu_item menu-link"
                    data-url="view/contactos"
                    data-ajax="true">Contactos</a></li>
            <li><a href="" class="menu_item">Paquetes</a></li>
            <li><a href="" class="menu_item menu-link"
                    data-url="view/acercaDe"
                    data-ajax="true">Acerca de</a></li>
        </ul>
    </div>
    <div class="inicio_session">
        <?php if (isset($_SESSION['user'])): ?>
            <img src="<?php echo URL_RESOURCES; ?>uploads/Cliente/foto_01.png" alt="img_user" width="40px">
            <p><?php echo $_SESSION['user']['nombre']; ?></p>
            <a href="logout">Cerrar Session</a>
        <?php else: ?>
            <a href="login" style="padding: 10px 20px">Iniciar Sesión</a>
        <?php endif; ?>

    </div>
</nav>