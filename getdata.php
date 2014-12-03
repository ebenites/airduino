<?php
require_once './config.php';
try{
	
	if(!isset($_GET['IP']))
		throw new Exception("No se especificado los parametros requeridos");
		
	$IP = $_GET['IP']; //Debe ser por id y buscar ip y pin de la base de datos
	$url = "http://$IP/?status";

	$response = \Httpful\Request::get($url)->send();
	//var_dump($response);
	echo json_encode($response->body);
        //[{"pin":2, "status":0},{"pin":3, "status":0},{"pin":4, "status":0},{"pin":5, "status":0}]
	
}catch(Exception $e){
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	die($e->getMessage());
}
?>