<?php
require_once './config.php';
try{
    
    if(!isset($_GET['id']) || (int)$_GET['id']==0)
        throw new Exception("No se especificado los parametros requeridos");

    //die('[{"pin":2, "status":0},{"pin":3, "status":1},{"pin":4, "status":0},{"pin":5, "status":1}]');
        
    $dispositivo = DispositivoDAO::obtener((int)$_GET['id']);
    if(!$dispositivo)
        throw new Exception("No se ha encontrado el dispositivo solicitado");
    
    $ip = $dispositivo->ip;
    
    $url = "http://$ip/?status";

    $response = \Httpful\Request::get($url)->send();
    //var_dump($response);
    echo json_encode($response->body);
	
}catch(Exception $e){
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die($e->getMessage());
}
?>