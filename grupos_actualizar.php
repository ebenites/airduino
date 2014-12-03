<?php
require_once './config.php';
try{
    
    if(!isset($_POST['id']) || !isset($_POST['nombre']) || $_POST['nombre'] == '')
        throw new Exception("No se especificado los parametros requeridos");
	
    GrupoDAO::actualizar((int)$_POST['id'], $_POST['nombre']);
    
    echo json_encode($data = array('type' => 'success', 'message' => 'Registro guardado satisfactoriamente'));
    
}catch(Exception $e){
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die("ERROR: " . $e->getMessage());
}
?>