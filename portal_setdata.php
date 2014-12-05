<?php
require_once './config.php';
try{
    
    if(!isset($_POST['dispositivo_id']) || !isset($_POST['pin_id']) || !isset($_POST['cmd']) 
            || (int)$_POST['dispositivo_id']==0 || (int)$_POST['pin_id']==0)
            throw new Exception("No se especificado los parametros requeridos");

//    die('{"status":1}');
    
    $dispositivo = DispositivoDAO::obtener((int)$_POST['dispositivo_id']);
    if(!$dispositivo)
        throw new Exception("No se ha encontrado el dispositivo solicitado");
    
    $ip = $dispositivo->ip;
    $pin = $_POST['pin_id']; //usar switch
    $cmd = $_POST['cmd']; //usar switch
    
    $url = "http://$ip/?$cmd&pin$pin";
    
    $response = \Httpful\Request::get($url)->send();
    //var_dump($response);
    echo json_encode($response->body);
	
}catch(Exception $e){
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die($e->getMessage());
}