<?php

namespace App\Models;
use Config\Database, PDO;
class Usuario
{
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createUser($nombre, $apellido, $email, $usuario, $password, $telefono, $direccion, $rol) {

        
        $query = "INSERT INTO usuarios (nombre, apellido, email, usuario, password_hash, telefono,  direccion, id_rol) 
                  VALUES (:nombre, :apellido, :email,  :usuario, :contrasena,:telefono, :direccion,:rol)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contrasena', $password);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':direccion', $direccion);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function authenticate($usuario, $contrasena) {
        $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            // Obtener la fila con la contraseña encriptada
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashedPassword = $row['password_hash'];
    
            // Comparar la contraseña ingresada con la encriptada
            if (password_verify($contrasena, $hashedPassword)) {
                return $row;
            }
        }
    
        return false;
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM cliente WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
