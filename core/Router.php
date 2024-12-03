<?php

class Router
{
    private $routes = [];

    // Agregar una ruta con sus middlewares
    public function add($method, $route, $action, $middlewares = [])
    {
        $this->routes[$method][$route] = [
            'action' => $action,
            'middlewares' => $middlewares
        ];
    }

    // Resolver la ruta y ejecutar la acción correspondiente
    public function resolve()
    {
        $method = Request::getMethod();
        $path = Request::getPath();

        // Asegurarse de que la ruta y el método existan
        if (!isset($this->routes[$method])) {
            Response::send(['error' => 'Método no soportado'], 405);
            return;
        }

        foreach ($this->routes[$method] as $route => $data) {
            if ($path === $route) {

                // Ejecutar los middlewares antes de la acción
                foreach ($data['middlewares'] as $middleware) {
                    // Crear instancia del middleware y ejecutar su handle
                    $middlewareInstance = new $middleware();
                    $middlewareInstance->handle(Request::getBody(), function() {});
                }

                // Ejecutar la acción del controlador y pasarle el cuerpo de la solicitud
                return call_user_func($data['action'], Request::getBody());
            }
        }

        // Si no se encuentra la ruta
        Response::send(['error' => 'Ruta no encontrada'], 404);
    }
}
