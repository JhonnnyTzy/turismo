<?php 
namespace App\Models;
use Config\Database;
class Transporte
{
    private $connection;
    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();   
    }

    public function registrarTransporte($data)
    {
        $sql = "INSERT INTO transporte (tipo,codigo, estado, capacidad, imagenes, departamento) VALUES (:tipo, :codigo, :estado, :capacidad, :imagenes, :departamento)";
        
        $imagenes = json_encode($data['imagenes']);
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':tipo', $data['tipo']);
        $stmt->bindParam(':codigo', $data['codigo']);
        $stmt->bindParam(':estado', $data['estado']);
        $stmt->bindParam(':capacidad', $data['capacidad']);
        $stmt->bindParam(':imagenes', $imagenes);
        $stmt->bindParam(':departamento', $data['departamento']);
        return $stmt->execute();
    }
    public function listarTransportes()
    {
        $sql = "SELECT * FROM transporte";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function actualizarTransporte($data){
        $sql = "UPDATE transporte SET tipo = :tipo, codigo = :codigo, estado = :estado, capacidad = :capacidad WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':tipo', $data['tipo']);
        $stmt->bindParam(':codigo', $data['codigo']);
        $stmt->bindParam(':estado', $data['estado']);
        $stmt->bindParam(':capacidad', $data['capacidad']);
        $stmt->bindParam(':id', $data['id']);
        return $stmt->execute();
    }

    public function eliminarTransporte($id){
        $sql = "DELETE FROM transporte WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function filtrarPorDepartamento($departamento){
        $sql = "SELECT * FROM transporte WHERE departamento = :departamento";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}



?>