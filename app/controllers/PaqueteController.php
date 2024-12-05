<?php

namespace App\Controllers;

use App\Models\Paquete;

class PaqueteController
{
    public function registrar($data)
    {

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

    public function mostrarFormRegistrar()
    {

        $paquete = new Paquete();
        $tiposPaquetes = $paquete->listarTiposPaquetes();

        ob_start();
        require_once __DIR__ . '/../views/Paquetes/Registrar.php';
        $html = ob_get_clean();

        header('Content-Type: text/html; charset=utf-8');
        echo $html;
    }


    public function obtener_paquetes()
    {
        $paquete = new Paquete();
        $paquetes = $paquete->obtener_paquetes();

        ob_start();
        require_once __DIR__ . '/../views/Paquetes/Paquete.php';
        $html = ob_get_clean();

        header('Content-Type: application/json');

        echo json_encode(['success' => true, 'data' => $html]);
    }

    public function obtenerInfoPaquete($id)
    {
        
        $pqt = new Paquete();
        $paquete = $pqt->obtenerInfoPaquete($id['id']);

        ob_start();
        require_once __DIR__ . '/../views/Paquetes/Compra.php';
        $html = ob_get_clean();

        header('Content-Type: application/json');

        echo json_encode(['success' => true, 'data' => $html]);
    }

    public function comprarPaquete($data){
        
        $pqt = new Paquete();
        $id_venta = $pqt->comprarPaquete($data['id_user'], $data['id_paquete'], $data['codigo_secreto']);
        $success = $pqt->registrarDetalleVenta($data['destino'], $data['alojamiento'], $data['transporte'], $id_venta, $data['cantidad'], $data['precio']);

        header('Content-Type: application/json');
        if($success){
            echo json_encode(['success' => true, 'message' => 'Paquete comprado correctamente.']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error al comprar el paquete.']);
        }
        exit();


    }

    public function listarVentas(){

        $pqt = new Paquete();
        $ventas = $pqt->listarVentas();
        return $ventas;
    }
        
}
