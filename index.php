<?php
require_once __DIR__ . '/core/Autoloader.php'; // Incluye el autoloader
require_once __DIR__ . '/core/App.php'; // Clase principal
require_once __DIR__ . '/config/config.php'; // Configuración

$app = new App();
require_once __DIR__ . '/routes/web_user.php'; // Cargar las rutas
require_once __DIR__ . '/routes/web.php'; // Cargar las rutas

$app->run(); // Ejecutar la aplicación
