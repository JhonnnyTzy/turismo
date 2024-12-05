<?php

namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController
{
    public function registrar($data)
    {
        if ($data['contrasena1'] === $data['contrasena2']) {
            $usuario = new Usuario();
            $rol = isset($data['rol']) ? $data['rol'] : 2; // Si 'rol' no existe, asigna 1
            $hash_password = password_hash($data['contrasena1'], PASSWORD_ARGON2ID);
            $success = $usuario->createUser($data['nombre'], $data['apellido'], $data['email'], $data['usuario'], $hash_password, $data['telefono'], $data['direccion'], $rol);

            if ($success) {
                header('Location: /turismo/login');
            } else {
                echo json_encode(['error' => 'Error al registrar el usuario']);
            }
        } else {
            echo json_encode(['error' => 'Las contraseñas no coinciden']);
        }
    }

    public function login($data)
    {
        $usuario = new Usuario();
        $authenticatedUser = $usuario->authenticate($data['usuario'], $data['contrasena']);
        session_start();


        $rol = $authenticatedUser['id_rol'] == 1 ? 'ADMIN' : 'USUARIO';

        if ($authenticatedUser) {

            $_SESSION['user'] = [
                'id' => $authenticatedUser['id_usuario'],
                'nombre' => $authenticatedUser['nombre'],
                'apellido' => $authenticatedUser['apellido'],
                'email' => $authenticatedUser['email'],
                'telefono' => $authenticatedUser['telefono'],
                'usuario' => $authenticatedUser['usuario'],
                'rol' => $rol
            ];

            if ($rol == 'ADMIN') {
                header('Location: ' . HTTP_BASE . '/admin');
            } else {
                header('Location: ' . HTTP_BASE);
            }
        } else {
            // Define un mensaje de error en la sesión
            $_SESSION['toast'] = [
                'type' => 'error', // Tipo de notificación
                'message' => 'Usuario o contraseña incorrectos.', // Mensaje del toast
            ];

            // Redirigir nuevamente al login
            header('Location: /turismo/login');
        }
        exit();
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /turismo');  // Redirigir a la página de login
        exit;
    }
}
