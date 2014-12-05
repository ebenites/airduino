<?php

class Conexion {

    static private $instance;
    
    public static function getConexion() {
        
        if(self::$instance == NULL){
            $PDOinstance = new PDO('mysql:host='.DATABASE_HOST.';dbname='.DATABASE_DBNAME, DATABASE_USERNAME, DATABASE_USERPASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $PDOinstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance = $PDOinstance;
        }
        return self::$instance;
        
    }
    
}

?>
