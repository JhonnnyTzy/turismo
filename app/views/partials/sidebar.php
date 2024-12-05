<aside class="main-sidebar sidebar-dark-primary elevation-4 vh-100 p_sidebar">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="<?php echo URL_RESOURCES; ?>adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TURISMO BO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <?php
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        if ($user != null): ?>
            <!-- Mostrar datos del usuario -->
            <div class="user-panel d-flex flex-column pt-3 pb-3 pl-2 aling-content-center">
                <div class="d-flex flex-row mb-4">
                    <img src="<?php echo URL_RESOURCES; ?>adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    <p class="user_data ml-4"><?php echo htmlspecialchars($user['nombre']); ?></p>
                </div>
                <a href="logout" class="btn btn-danger "><i class="fas fa-sign-out-alt"></i></a>

            </div>
        <?php else: ?>
            <!-- Mostrar botón de inicio de sesión -->
            <div class="user-panel d-flex flex-column ">
                <a href="login" class="btn btn-primary m-2">Iniciar sesión</a>
                <a href="view/registrar" class="btn btn-success m-2">Registrarse</a>
            </div>
        <?php endif; ?>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php
                // Mostrar menú según el rol 
                if (isset($user['rol'])) {
                    switch ($user['rol']) {
                        case 'ADMIN': ?>
                            <li class="nav-header"> ADMISTRACION</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    TRANSPORTE
                                    <p>
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="" class="nav-link menu-link"
                                            data-url="view/transporte-registrar"
                                            data-entidad="transporte"
                                            data-ajax="true"
                                            data-id_container="registrarTransporte">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Registrar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link menu-link"
                                            data-url="view/transporte/listar"
                                            data-ajax="true"
                                            data-listar = "true"
                                            data-entidad="listar_transporte">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar trasporte</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    DESTINO
                                    <p>
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="" class="nav-link menu-link"
                                            data-url="view/destino-registrar"
                                            data-entidad="destino"
                                            data-ajax="true">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Registrar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link menu-link"
                                        data-url="view/destino/listar" 
                                        data-entidad="listar_destino"
                                        data-ajax="true" 
                                        data-listar = "true"
                                        >
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar Destinos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    ALOJAMIENTO
                                    <p>
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="" class="nav-link menu-link"
                                            data-url="view/alojamiento/registrar"
                                            data-entidad="alojamiento"
                                            data-ajax="true">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Registrar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link menu-link" 
                                        data-ajax="true"
                                        data-listar = "true"
                                        data-url="view/alojamiento/listar"
                                        data-entidad="listar_alojamiento">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar Alojamientos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    PAQUETE
                                    <p>
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="" class="nav-link menu-link"
                                            data-url="view/paquete/registrar"
                                            data-entidad="paquete"
                                            data-ajax="true">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Registrar</p>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>



                        <?php break;

                        case 'USUARIO': ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Usuario</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>Mis Actividades</p>
                                </a>
                            </li>
                        <?php break;

                        default: // Caso visitante 
                        ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-globe"></i>
                                    <p>Visitante</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../app/views/RegistroCliente.php" class="nav-link">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>Registrarse</p>
                                </a>
                            </li>
                    <?php break;
                    }
                } else { // Si no hay sesión iniciada (visitante por defecto)
                    ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>Visitante</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../app/views/RegistroCliente.php" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>Registrarse</p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</aside>