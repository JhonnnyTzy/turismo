<?php

class Router
{
    private $routes = [];

    public function add($method, $route, $action, $middlewares = [])
    {
        $this->routes[$method][$route] = ['action' => $action, 'middlewares' => $middlewares];
    }

    public function resolve()
    {
        $method = Request::getMethod();
        $path = Request::getPath();

        if (!isset($this->routes[$method])) {
            Response::send(['error' => 'Método no soportado'], 405);
            return;
        }

        foreach ($this->routes[$method] as $route => $data) {
            $routePattern = preg_replace('/:\w+/', '(\w+)', str_replace('/', '\/', $route));

            if (preg_match('/^' . $routePattern . '$/', $path, $matches)) {
                array_shift($matches);

                foreach ($data['middlewares'] as $middleware) {
                    (new $middleware())->handle(Request::getBody(), function () {});
                }

                return call_user_func_array($data['action'], $matches);
            }
        }

        Response::send(['error' => 'Ruta no encontrada'], 404);
    }
}
