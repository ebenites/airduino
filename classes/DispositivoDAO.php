<?php

class DispositivoDAO {

    public static function listar() {
        $pdo = Conexion::getConexion();
        $lista = array();
        $query = "SELECT * FROM dispositivo ORDER BY ip";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        while ($registro = $stmt->fetch(PDO::FETCH_OBJ)) {
            $lista[] = $registro;
        }
        return $lista;
    }
    
    public static function crear($ip, $pines) {
        $pdo = Conexion::getConexion();
        try{
            $pdo->beginTransaction();
            
            $query = "INSERT INTO dispositivo(ip, fecha) VALUES(:ip, now())";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':ip', $ip);
            $stmt->execute();
            $dispositivo_id = $pdo->lastInsertId();
            foreach ($pines as $pin){
                $query = "INSERT INTO pin (dispositivo_id, id, estado) VALUES (:dispositivo_id, :id, 0)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':dispositivo_id', $dispositivo_id);
                $stmt->bindParam(':id', $pin->pin);
                $stmt->execute();
            }
            
            $pdo->commit();
        } catch (PDOException $e){
            $pdo->rollBack();
            throw $e;
        }
    }

    public static function eliminar($id) {
        $pdo = Conexion::getConexion();
        try{
            $pdo->beginTransaction();
            
            $query = "DELETE FROM pin WHERE dispositivo_id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $query = "DELETE FROM dispositivo WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $pdo->commit();
        } catch (PDOException $e){
            $pdo->rollBack();
            throw $e;
        }
    }
    
    public static function actualizar($id, $nombre) {
//        $pdo = Conexion::getConexion();
//        $query = "UPDATE grupo SET nombre=:nombre WHERE id = :id";
//        $stmt = $pdo->prepare($query);
//        $stmt->bindParam(':nombre', $nombre);
//        $stmt->bindParam(':id', $id);
//        $stmt->execute();
    }
    
}

?>