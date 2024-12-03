<?php
class Request
{
    // Obtener el método de la solicitud (GET, POST, etc.)
    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    // Obtener la ruta de la solicitud
    public static function getPath()
    {
        // Extraer la ruta de la URL, eliminando el directorio público (si es necesario)
        $path = $_SERVER['REQUEST_URI'];
        $basePath = '/turismo';  // Cambia según tu configuración de URL base
        return str_replace($basePath, '', $path);
    }

    // Obtener el cuerpo de la solicitud (usualmente para POST)
    public static function getBody()
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? null;

        if ($contentType === 'application/json') {
            // Si es JSON, decodificar el cuerpo
            $data = json_decode(file_get_contents('php://input'), true);
        } else {
            // Si no es JSON, usar $_POST (por defecto vacío para solicitudes GET)
            $data = $_POST;
        }

        return $data;
    }
}


?>