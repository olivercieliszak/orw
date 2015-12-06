<?php


if(empty($_GET['cmd'])){
	myExit('Brak polecenia');	
}
else{
	$cmd = $_GET['cmd'];
}

switch($cmd){
	case 'readScrapper':
	
		$path = dirname(__FILE__).'/data/';
		include('./lib/API/readScrapper.php');
		echo getDataFromScrapper($path);
		
		break;
	
	case 'executeScrapper':
	
		$path = dirname(__FILE__).'/scrapper.php';
		include($path);
		echo json_encode(array('status' => 'ok', 'fileName' => str_replace( dirname(__FILE__).'/data/', '', $filename)));
		break;
		
	case 'getDataFromOAuth':
	
		$path = dirname(__FILE__).'/lib/API/OAuthFB.php';
		include($path);
		echo json_encode($data);
		break;
	
	default:
		myExit('Zly wybor');
		break;

}


function myExit($data){
	if(is_array($data)){
		echo json_encode($data);
	}
	else{
		$array = Array();
		$array['error'] = $data;
		echo json_encode($array);
	}
	exit();
}