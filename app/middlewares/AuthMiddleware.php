<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function handle($data, $next)
    {
        session_start();
        
        // Verificar si la sesión tiene al usuario logueado
        if (!isset($_SESSION['username'])) {
            // Si no está logueado, redirigir al login
            header('Location: /login');
            exit; // Termina la ejecución
        }

        // Si está logueado, continuar con la siguiente acción (el controlador)
        $next();
    }
}
