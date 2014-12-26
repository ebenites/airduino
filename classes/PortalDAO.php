<?php

class PortalDAO {

    public static function load() {
        $pdo = Conexion::getConexion();
        $grupos = array();
        $query = "SELECT * FROM grupo g WHERE EXISTS(SELECT * FROM pin p WHERE p.grupo_id=g.id AND p.estado=1) ORDER BY nombre";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        while ($grupo = $stmt->fetch(PDO::FETCH_OBJ)) {
            
            $query="SELECT p.id, p.nombre, p.dispositivo_id, d.ip
                    FROM pin p
                    INNER JOIN dispositivo d ON d.id=p.dispositivo_id
                    WHERE p.estado=1 AND p.grupo_id=:grupo_id
                    ORDER BY p.nombre";
            $substmt = $pdo->prepare($query);
            $substmt->bindParam(':grupo_id', $grupo->id);
            $substmt->execute();
            
            $pines = array();
            while ($pin = $substmt->fetch(PDO::FETCH_OBJ)) {
                $pines[] = $pin;
            }
            
            $grupo->pines = $pines;
            $grupos[] = $grupo;
            
        }
        return $grupos;
    }
        
}

?>