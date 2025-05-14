<?php

define("CONTROLADOR_DEFECTO", "Usuarios");
define("ACCION_DEFECTO", "index");

// configuración de la base de datos
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'turismo');
define('DB_USER', 'root');
define('DB_PASS', '');

// Rutas base
define("RUTA_BASE", $_SERVER['DOCUMENT_ROOT'] . "/");
define("HTTP_BASE", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']);
define("ROOT_APP", $_SERVER['DOCUMENT_ROOT'] . "/turismo/app/");
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT'] . "/turismo/");
define("URL_RESOURCES", HTTP_BASE . "/public/");
define("URL_RESOURCES_ADM", HTTP_BASE . "/public/adminlte/");
