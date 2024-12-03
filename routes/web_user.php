<?php 

$app->router->add('GET', '/view/contactos', function () {
    require_once __DIR__ . '/../app/views/Menu/Contactos.php';
});

$app->router->add('GET', '/view/acercaDe', function () {
    require_once __DIR__ . '/../app/views/Menu/AcercaDe.php';
});


?>