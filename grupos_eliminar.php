<?php
require_once './config.php';
try{
    
    if(!isset($_GET['id']))
        throw new Exception("No se especificado los parametros requeridos");
	
    GrupoDAO::eliminar($_GET['id']);
    
    echo json_encode($data = array('type' => 'success', 'message' => 'Registro eliminado satisfactoriamente'));
    
}catch(Exception $e){
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die($e->getMessage());
}
?>