<?php 

namespace App\Controllers;
use App\Models\Destino;
use App\Models\Transporte;

class TransporteController{
    public function registrarTransporte($data)
    {

        $transporte = new Transporte();
        $success = $transporte->registrarTransporte($data);

        header('Content-Type: application/json');
        if ($success) {
            // Si todo fue correcto:
            echo json_encode(['success' => true, 'message' => 'Transporte registrado correctamente.']);
        } else {
            // Si hubo un error:
            echo json_encode(['success' => false, 'message' => 'Error al registrar el transporte.']);
        }
        exit();

    }

    public function actualizarTransporte($data)
    {
        
        $destino = new Transporte();
        $success = $destino->actualizarTransporte($data);

        header('Content-Type: application/json');
        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Transporte actualizado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al registrar el transporte.']);
        }
        exit();
    }
    
    public function formRegistrarTransporte()
    {

        ob_start();
        require_once __DIR__ . '/../views/Transporte/Registrar.php';
        $html = ob_get_clean();
        // Puedes modificar o agregar encabezados adicionales si es necesario
        header('Content-Type: text/html; charset=utf-8');
        echo $html;
        
    }
    public function listarTransportes()
    {
        $transporte = new Transporte();
        $transportes = $transporte->listarTransportes();
        ob_start();
        require_once __DIR__ . '/../views/Transporte/Listar.php';
        $html = ob_get_clean();
        // Puedes modificar o agregar encabezados adicionales si es necesario
        header('Content-Type: text/html; charset=utf-8');
        echo $html;
    }

    public function eliminarTransporte($data)
    {
        $destino = new Transporte();
        $success = $destino->eliminarTransporte($data['id']);

        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Transporte eliminado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al eliminar el transporte.']);
        }
        exit();
    }
    public function filtrarPorDepartamento($departamento){
        $transporte = new Transporte();
        $transportes = $transporte->filtrarPorDepartamento($departamento);
    
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'transportes' => $transportes]);
        exit();
    }


}





?>