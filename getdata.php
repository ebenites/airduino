<?php
// date_default_timezone_set('America/Lima');
try{
	
	if(!isset($_GET['IP']))
		throw new Exception("No se especificado los parametros requeridos");
		
	$IP = $_GET['IP']; //Debe ser por id y buscar ip y pin de la base de datos
	$url = "http://$IP/?status";



        //die('[{"pin":2, "status":1},{"pin":3, "status":0},{"pin":4, "status":1},{"pin":5, "status":0}]');

	/*
	//Temporal
	//  Initiate curl
	$ch = curl_init();
	// Disable SSL verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Will return the response, if false it print the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$url);
	// Execute
	$result=curl_exec($ch);
	// Closing
	curl_close($ch);

        if(!$result)
            throw new Exception("Error en la conexión con $IP");
        
	echo $result;
	*/
	
        require_once('lib/httpful.phar');
	$response = \Httpful\Request::get($url)->send();
	//var_dump($response);
	echo json_encode($response->body);
	
}catch(Exception $e){
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	echo 'ERROR: ' . $e->getMessage();
}
?>