<?php 

namespace App\Models;
use Config\Database;
class Alojamiento{
    private $conexion = null;

    public function __construct(){
        $db = new Database();
        $this->conexion = $db->getConnection();
    }

    public function registrarAlojamiento($data){
        $imagenes = json_encode($data['imagenes']);
        $sql = "INSERT INTO alojamiento (nombre, tipo, departamento, url_maps, ubicacion, capacidad, precio, servicios, descripcion, imagenes) 
        VALUES  (:nombre, :tipo,:departamento, :url_maps, :ubicacion, :capacidad, :precio, :servicios, :descripcion, :imagenes)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':tipo', $data['tipo']);
        $stmt->bindParam(':departamento', $data['departamento']);
        $stmt->bindParam(':url_maps', $data['url_maps']);
        $stmt->bindParam(':ubicacion', $data['ubicacion']);
        $stmt->bindParam(':capacidad', $data['capacidad']);
        $stmt->bindParam(':precio', $data['precio']);
        $stmt->bindParam(':servicios', $data['servicios']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->bindParam(':imagenes', $imagenes);
        return $stmt->execute();
    }

    public function listarAlojamientos(){
        $sql = "SELECT * FROM alojamiento";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function actualizarAlojamiento($data){
        $sql = "UPDATE alojamiento 
        SET nombre=:nombre, tipo=:tipo, departamento=:departamento, url_maps=:url_maps, ubicacion=:ubicacion, capacidad=:capacidad, precio=:precio, servicios=:servicios, descripcion=:descripcion
        WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':tipo', $data['tipo']);
        $stmt->bindParam(':departamento', $data['departamento']);
        $stmt->bindParam(':url_maps', $data['url_maps']);
        $stmt->bindParam(':ubicacion', $data['ubicacion']);
        $stmt->bindParam(':capacidad', $data['capacidad']);
        $stmt->bindParam(':precio', $data['precio']);
        $stmt->bindParam(':servicios', $data['servicios']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        return $stmt->execute();
    }
    public function eliminarAlojamiento($id){
        $sql = "DELETE FROM alojamiento WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function filtrarPorDepartamento($departamento){
        $sql = "SELECT * FROM alojamiento WHERE departamento = :departamento";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}



?>