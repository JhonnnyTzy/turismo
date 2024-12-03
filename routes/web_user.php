<?php 

$app->router->add('GET', '/view/contactos', function () {
    require_once __DIR__ . '/../app/views/Menu/Contactos.php';
});


?>