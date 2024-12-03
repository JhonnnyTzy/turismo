<?php 

namespace App\Controllers;
use App\Models\Alojamiento;

class AlojamientoController
{
    public function registrar($data){
        $alojamiento = new Alojamiento();
        $success = $alojamiento->registrarAlojamiento($data);
        
        header('Content-Type: application/json');
        if($success){
            echo json_encode(['success' => true, 'message' => 'Alojamiento registrado correctamente.']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error al registrar el alojamiento.']);
        }
        exit();
    }

    public function listarAlojamientos(){
        $alojamiento = new Alojamiento();
        $alojamientos = $alojamiento->listarAlojamientos();

        ob_start();
        include_once 'app/views/Alojamiento/Listar.php';
        $html = ob_get_clean();

        header('Content-Type: text/html; charset=utf-8');
        echo $html;
    }

    public function actualiarAlojamiento($data){
        $alojamiento = new Alojamiento();
        $success = $alojamiento->actualizarAlojamiento($data);

        header('Content-Type: application/json');
        if($success){
            echo json_encode(['success' => true, 'message' => 'Alojamiento actualizado correctamente.']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el alojamiento.']);
        }
        exit();
    }

    public function eliminarAlojamiento($data){
        $alojamiento = new Alojamiento();
        $success = $alojamiento->eliminarAlojamiento($data['id']);

        header('Content-Type: application/json');
        if($success){
            echo json_encode(['success' => true, 'message' => 'Alojamiento eliminado correctamente.']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el alojamiento.']);
        }
        exit();
    }

    public function filtrarPorDepartamento($departamento){
        $alojamiento = new Alojamiento();
        $alojamientos = $alojamiento->filtrarPorDepartamento($departamento);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'alojamientos' => $alojamientos]);
        exit();
    }
}
?>