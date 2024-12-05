<?php

namespace App\Models;

use Config\Database;

class Paquete
{
    private $conexion;
    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->getConnection();
    }

    public function registrarPaquete($data)
    {
        $sql = "INSERT INTO paquete (nombre, descripcion, departamento_origen, lugar_salida, destino_id, transporte_salida, transporte_regreso, alojamiento_id, id_tipo_paquete, precio_total, duracion, plaza_disponible, informacion_adicional) 
        VALUES (:nombre, :descripcion, :departamento_origen, :lugar_salida, :destino_id, :transporte_salida, :transporte_regreso, :alojamiento_id, :id_tipo_paquete, :precio_total, :duracion, :plaza_disponible, :informacion_adicional)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->bindParam(':departamento_origen', $data['departamento_origen']);
        $stmt->bindParam(':lugar_salida', $data['lugar_salida']);
        $stmt->bindParam(':destino_id', $data['destino_id']);
        $stmt->bindParam(':transporte_salida', $data['transporte_salida']);
        $stmt->bindParam(':transporte_regreso', $data['transporte_regreso']);
        $stmt->bindParam(':alojamiento_id', $data['alojamiento_id']);
        $stmt->bindParam(':id_tipo_paquete', $data['id_tipo_paquete']);
        $stmt->bindParam(':precio_total', $data['precio_total']);
        $stmt->bindParam(':duracion', $data['duracion']);
        $stmt->bindParam(':plaza_disponible', $data['plaza_disponible']);
        $stmt->bindParam(':informacion_adicional', $data['informacion_adicional']);

        return $stmt->execute();
    }

    public function listarTiposPaquetes()
    {
        $sql = "SELECT * FROM tipo_paquete";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function obtener_paquetes()
    {
        $stmt = $this->conexion->prepare("CALL obtener_paquetes();");
        $stmt->execute();
        $resultados =  $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function obtenerInfoPaquete($id)
    {
        $stmt = $this->conexion->prepare("CALL oi_paquete(:id);");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resultado =  $stmt->fetch(\PDO::FETCH_ASSOC);

        return $resultado;
    }

    public function comprarPaquete($id_usuario, $id_paquete, $codigo_secreto)
    {
        $sql = "INSERT INTO venta(usuario_id, paquete_id, codigo_secreto) VALUES (:id_usuario, :id_paquete, :codigo_secreto)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_paquete', $id_paquete);
        $stmt->bindParam(':codigo_secreto', $codigo_secreto);

        
        if ($stmt->execute()) {
            // Retornar el último ID insertado
            return $this->conexion->lastInsertId();
        }

        return false;
    }

    public function registrarDetalleVenta($destino, $alojamiento,$transporte, $venta_id, $cantidad, $precio)
    {
        $sql = "INSERT INTO detalle_venta(destino, alojamiento, transporte, venta_id, cantidad_personas, precio) VALUES (:destino, :alojamiento, :transporte, :venta_id, :cantidad, :precio_total)"; 

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':destino', $destino);
        $stmt->bindParam(':alojamiento', $alojamiento);
        $stmt->bindParam(':transporte', $transporte);
        $stmt->bindParam(':venta_id', $venta_id);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio_total', $precio);

        return $stmt->execute();
    }

    public function listarVentas()
    {
        $stmt = $this->conexion->prepare("CALL obtener_ventas();");
        $stmt->execute();
        $resultados =  $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $resultados;
    }


}
