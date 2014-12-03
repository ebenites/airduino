<?php
try{

	if(!isset($_GET['IP']) || !isset($_GET['CMD']))
		throw new Exception("No se especificado los parametros requeridos");
		
	$IP = $_GET['IP']; //Debe ser por id y buscar ip y pin de la base de datos
	$CMD = $_GET['CMD']; //usar switch
	$url = "http://$IP/?$CMD";



	die('{"status":1}');
	
        //  Initiate curl
        $con = curl_init();
	// Disable SSL verification
	curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
	// Will return the response, if false it print the response
	curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($con, CURLOPT_URL,$url);
	// Execute
	$result=curl_exec($con);
	// Closing
	curl_close($con);

	//echo json_encode(json_decode(str_replace(':', '":', str_replace('{', '{"', $result))));
	echo $result;
	
}catch(Exception $e){
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	die($e->getMessage());
}