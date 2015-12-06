<?php
	function getDataFromScrapper($path){
		try{
			$url = 'http://www.onet.pl';
			$dir = scandir($path);
			// print_r($dir);
			$fileName = end($dir);
			$returnData = array();
			$returnData['fileName'] = $fileName;
			$returnData['data'] = file_get_contents($path . '/'. $fileName);
			$returnData['url'] = $url;
			return json_encode($returnData);
		} 
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}