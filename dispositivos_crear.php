<?php
require_once './config.php';
try{
    
    if(!isset($_POST['ip']) || $_POST['ip'] == '')
        throw new Exception("No se especificado los parametros requeridos");
    
    if(!filter_var($_POST['ip'], FILTER_VALIDATE_IP))
        throw new Exception("IP no es válida");
    
    $ip = $_POST['ip'];
    $url = "http://$ip/?status";
    
    $response = \Httpful\Request::get($url)->send();
    $pines = $response->body;
    
    DispositivoDAO::crear($ip, $pines);
    
    echo json_encode($data = array('type' => 'success', 'message' => 'Registro guardado satisfactoriamente'));
    
}catch(Exception $e){
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die($e->getMessage());
}
?>