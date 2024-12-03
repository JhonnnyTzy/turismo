<?php 
namespace App\Controllers;

use App\Models\Paquete;

class PaqueteController {
    public function registrar($data) {
        
        $paquete = new Paquete();
        $success = $paquete->registrarPaquete($data);

        $tiposPaquetes = $paquete->listarTiposPaquetes();
        ob_start();
        require_once __DIR__ . '/../views/Paquetes/Registrar.php';

        $html = ob_get_clean();
        header('Content-Type: application/json');
        if ($success) {
            // Si todo fue correcto:
            echo json_encode(['success' => true, 'message' => 'Paquete registrado correctamente.', 'html' => $html]);
        } else {
            // Si hubo un error:
            echo json_encode(['success' => false, 'message' => 'Error al registrar el paquete.']);
        }
        exit();

    }

    public function mostrarFormRegistrar() {

        $paquete = new Paquete();
        $tiposPaquetes = $paquete->listarTiposPaquetes();

        ob_start();
        require_once __DIR__ . '/../views/Paquetes/Registrar.php';
        $html = ob_get_clean();

        header('Content-Type: text/html; charset=utf-8');
        echo $html;

    }
}

?>