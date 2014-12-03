<?php

class GrupoDAO {

    public static function listar() {
        $pdo = Conexion::getConexion();
        $lista = array();
        $query = "SELECT * FROM grupo ORDER BY nombre";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        while ($registro = $stmt->fetch(PDO::FETCH_OBJ)) {
            $lista[] = $registro;
        }
        return $lista;
    }
    
    public static function crear($nombre) {
        $pdo = Conexion::getConexion();
        $query = "SELECT * FROM grupo WHERE nombre=:nombre";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            throw new Exception("Ya existe un registro con el mismo nombre $nombre");
        }
        $query = "INSERT INTO grupo (nombre) VALUES (:nombre)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
    }

    public static function eliminar($id) {
        $pdo = Conexion::getConexion();
        $query = "DELETE FROM grupo WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    
    public static function actualizar($id, $nombre) {
        $pdo = Conexion::getConexion();
        $query = "UPDATE grupo SET nombre=:nombre WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    
}

?>