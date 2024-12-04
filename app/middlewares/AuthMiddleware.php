<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        session_start();
        
        // Verificar si la sesión tiene al usuario logueado
        if (!isset($_SESSION['user'])) {
            // Si no está logueado, redirigir al login
            header('Location: /login');
            exit; // Termina la ejecución
        }

        // Si está logueado, continuar con la siguiente acción (el controlador)
        // Si está autenticado, pasa al siguiente middleware o controlador
        return $next($request);
    }
}
