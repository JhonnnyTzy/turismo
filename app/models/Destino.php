<?php
namespace App\Models;
use Config\Database;

class Destino {


    private $conn;
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function registrarDestino($nombre, $descripcion, $ubicacion, $departamento, $coordenadas, $imagenes, $clima, $temporada_recomendada, $restricciones, $atracciones) {
        $sql = "INSERT 
        INTO destino (nombre, descripcion, ubicacion, departamento, coordenadas, imagenes, clima, temporada_recomendada, restricciones, atracciones) 
        VALUES (:nombre, :descripcion, :ubicacion, :departamento, :coordenadas, :imagenes, :clima, :temporada_recomendada, :restricciones, :atracciones)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':ubicacion', $ubicacion);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->bindParam(':coordenadas', $coordenadas);
        $stmt->bindParam(':imagenes', $imagenes);
        $stmt->bindParam(':clima', $clima);
        $stmt->bindParam(':temporada_recomendada', $temporada_recomendada);
        $stmt->bindParam(':restricciones', $restricciones);
        $stmt->bindParam(':atracciones', $atracciones);
        return $stmt->execute();
    }


    public function listarDestinos() {
            $sql = "SELECT * FROM destino";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function actualizarDestino($data) {
        $sql = "UPDATE destino 
        SET nombre=:nombre, descripcion= :descripcion, ubicacion=:ubicacion, departamento=:departamento, coordenadas=:coordenadas, clima=:clima, temporada_recomendada=:temporada, restricciones=:restricciones, atracciones=:atracciones
        WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->bindParam(':ubicacion', $data['ubicacion']);
        $stmt->bindParam(':departamento', $data['departamento']);
        $stmt->bindParam(':coordenadas', $data['coordenadas']);
        $stmt->bindParam(':clima', $data['clima']);
        $stmt->bindParam(':temporada', $data['temporada']);
        $stmt->bindParam(':restricciones', $data['restricciones']);
        $stmt->bindParam(':atracciones', $data['atracciones']);
        return $stmt->execute();
    }


    public function eliminarDestino($id) {
        $sql = "DELETE FROM destino WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function filtrarPorDepartamento($departamento) {
        $sql = "SELECT * FROM destino WHERE departamento = :departamento";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    
}