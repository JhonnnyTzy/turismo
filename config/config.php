<?php

$host = $_SERVER['HTTP_HOST'];
$isLocal = $host === 'localhost' || $host === '127.0.0.1';

// Si es local, usa /turismo. Si es en Render, usa solo la raíz
$basePath = $isLocal ? '/turismo' : '';

define("CONTROLADOR_DEFECTO", "Usuarios");
define("ACCION_DEFECTO", "index");

// Configuración de la base de datos
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'turismo');
define('DB_USER', 'root');
define('DB_PASS', '');

// Rutas base
define("RUTA_BASE", $_SERVER['DOCUMENT_ROOT'] . "/");
define("HTTP_BASE", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$host$basePath");
define("ROOT_APP", $_SERVER['DOCUMENT_ROOT'] . "$basePath/app/");
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT'] . "$basePath/");
define("URL_RESOURCES", HTTP_BASE . "/public/");
define("URL_RESOURCES_ADM", HTTP_BASE . "/public/adminlte/");
