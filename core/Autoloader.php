<?php
spl_autoload_register(function ($className) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $className) . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    } else {
        die("La clase $className no se pudo cargar.");
    }
});
