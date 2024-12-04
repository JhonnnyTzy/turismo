<?php
// web.php
use App\Controllers\UsuarioController;
use App\Controllers\DestinoController;
use App\Controllers\TransporteController;
use App\Controllers\AlojamientoController;
use App\Controllers\PaqueteController;
// Registrar rutas en el router

$app->router->add('GET', '/view/registrar', function () {
    require_once __DIR__ . '/../app/views/RegistrarUsuario.php';
});

$app->router->add('POST', '/usuario/registrar', function ($data) {
    $controller = new UsuarioController();
    $controller->registrar($data);
});

// Definir ruta por defecto (home)
$app->router->add('GET', '/', function () {
    require_once __DIR__ . '/../app/views/home.php';
});
$app->router->add('GET', '/admin', function () {
    require_once __DIR__ . '/../app/views/home_admin.php';
});

$app->router->add('GET', '/login', function () {
    require_once __DIR__ . '/../app/views/login.php';
});

$app->router->add('POST', '/login', function ($data) {

    $controller = new UsuarioController();
    $controller->login($data);
    
});

$app->router->add('GET', '/logout', function () {
    $controller = new UsuarioController();
    $controller->logout();
    require_once __DIR__ . '/../app/views/home.php';
});

// destino

$app->router->add('GET', '/view/destino-registrar', function () {
    $controller = new DestinoController();
    $controller->formRegistraDestino();
});
$app->router->add('GET', '/view/destino/listar', function () {
    $controller = new DestinoController();
    $controller->listarDestinos();
});
$app->router->add('POST', '/destino/registrar', function ($data) {
    $controller = new DestinoController();
    $controller->registrarDestino($data);
});

$app->router->add('POST', '/destino/actualizar', function ($data) {
    $controller = new DestinoController();
    $controller->actualizarDestino($data);
});

$app->router->add('POST', '/destino/eliminar', function ($data) {
    $controller = new DestinoController();
    $controller->eliminarDestino($data);
});

$app->router->add('POST', '/destino/filtrarD', function ($data) {
    $controller = new DestinoController();
    $controller->filtrarPorDepartamento($data);
});
// Trasnporte

$app->router->add('GET', '/view/transporte-registrar', function () {
    $controller = new TransporteController();
    $controller->formRegistrarTransporte();
});

$app->router->add('POST', '/transporte/registrar', function ($data) {
    $controller = new TransporteController();
    $controller->registrarTransporte($data);
});
$app->router->add('GET', '/view/transporte/listar', function () {
    $controller = new TransporteController();
    $controller->listarTransportes();

});

$app->router->add('POST', '/transporte/actualizar', function ($data) {
    $controller = new TransporteController();
    $controller->actualizarTransporte($data);
});

$app->router->add('POST', '/transporte/eliminar', function ($data) {
    $controller = new TransporteController();
    $controller->eliminarTransporte($data);
});

$app->router->add('POST', '/transporte/filtrarD', function ($data) {
    $controller = new TransporteController();
    $controller->filtrarPorDepartamento($data);
});
// Alojamiento

$app->router->add('GET', '/view/alojamiento/registrar', function () {
    require_once __DIR__ . '/../app/views/Alojamiento/Registrar.php';
});

$app->router->add('POST', '/alojamiento/registrar', function ($data) {
    $controller = new AlojamientoController();
    $controller->registrar($data);
});
$app->router->add('GET', '/view/alojamiento/listar', function () {
    $controller = new AlojamientoController();
    $controller->listarAlojamientos();
});

$app->router->add('POST', '/alojamiento/actualizar', function ($data) {
    $controller = new AlojamientoController();
    $controller->actualiarAlojamiento($data);
});

$app->router->add('POST', '/alojamiento/eliminar', function ($data) {
    $controller = new AlojamientoController();
    $controller->eliminarAlojamiento($data);
});

$app->router->add('POST', '/alojamiento/filtrarD', function ($data) {
    $controller = new AlojamientoController();
    $controller->filtrarPorDepartamento($data);
});
// paquete

$app->router->add('GET', '/view/paquete/registrar', function () {
    $controller = new PaqueteController();
    $controller->mostrarFormRegistrar();
});

$app->router->add('POST', '/paquete/registrar', function ($data) {
    $controller = new PaqueteController();
    $controller->registrar($data);
});
