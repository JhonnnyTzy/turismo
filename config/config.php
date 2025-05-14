<?php
// Configuración general del sistema

// Controlador y acción por defecto
define("CONTROLADOR_DEFECTO", "Usuarios");
define("ACCION_DEFECTO", "index");

// Configuración de la base de datos
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'turismo');
define('DB_USER', 'root');
define('DB_PASS', '');

// Rutas base del sistema
define("RUTA_BASE", $_SERVER['DOCUMENT_ROOT'] . "/");

// URLs base del sistema
define("HTTP_BASE", "http://localhost/turismo");

// Rutas absolutas del sistema
define("ROOT_APP", $_SERVER['DOCUMENT_ROOT'] . "/turismo/app/");
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT'] . "/turismo/"); // Corregido: eliminada la coma mal ubicada

// URLs de recursos públicos
define("URL_RESOURCES", HTTP_BASE . "/public/");
define("URL_RESOURCES_ADM", HTTP_BASE . "/public/adminlte/");
