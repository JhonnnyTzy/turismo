<?php

namespace App\Controllers;

use App\Models\Destino;

class DestinoController
{
    public function registrarDestino($data)
    {
        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $ubicacion = $data['ubicacion'];
        $departamento = $data['departamento'];
        $coordenadas = $data['coordenadas'];
        $imagenes = $data['imagenes'];
        $clima = $data['clima'];
        $temporada_recomendada = $data['temporada_recomendada'];
        $restricciones = $data['restricciones'];
        $atracciones = $data['atracciones'];

        $destino = new Destino();
        $success = $destino->registrarDestino($nombre, $descripcion, $ubicacion, $departamento, $coordenadas, json_encode($imagenes), $clima, $temporada_recomendada, $restricciones, $atracciones);

        header('Content-Type: application/json');
        if ($success) {
            // Si todo fue correcto:
            echo json_encode(['success' => true, 'message' => 'Destino registrado correctamente.']);
        } else {
            // Si hubo un error:
            echo json_encode(['success' => false, 'message' => 'Error al registrar el destino.']);
        }
        exit();
    }

    public function formRegistraDestino()
    {
        ob_start();
        require_once __DIR__ . '/../views/Destino/Registrar.php';
        $html = ob_get_clean();

        // Puedes modificar o agregar encabezados adicionales si es necesario
      //  header('Content-Type: text/html; charset=utf-8');
        echo $html;
    }


    public function listarDestinos()
    {
        $destino = new Destino();
        $destinos = $destino->listarDestinos();
        
        ob_start();
        require_once __DIR__ . '/../views/Destino/Listar.php';
        $html = ob_get_clean();
        header('Content-Type: text/html; charset=utf-8');
        echo $html;
    }

    public function actualizarDestino($data){

        $destino = new Destino();
        $success = $destino->actualizarDestino($data);

        header('Content-Type: application/json');
        if ($success) {
            // Si todo fue correcto:
            echo json_encode(['success' => true, 'message' => 'Destino actualizado correctamente.']);
        } else {
            // Si hubo un error:
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el destino.']);
        }
        exit();
    }

    public function eliminarDestino($data){
        $destino = new Destino();
        $success = $destino->eliminarDestino($data['id']);

        header('Content-Type: application/json');
        if ($success) {
            // Si todo fue correcto:
            echo json_encode(['success' => true, 'message' => 'Destino eliminado correctamente.']);
        } else {
            // Si hubo un error:
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el destino.']);
        }
        exit();
    }

    public function filtrarPorDepartamento($departamento){
        $destino = new Destino();
        $destinos = $destino->filtrarPorDepartamento($departamento);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'destinos' => $destinos]);
        exit();
    }
}
