<?php
error_reporting(0);
require(dirname(__FILE__).'/lib/phpQuery.php');

$url = 'http://www.onet.pl';
$dir = '/data';
$filename = dirname(__FILE__). $dir . '/' . date('Y-m-d_H:i:s').'.txt';
$data = file_get_contents($url);

$pq = phpQuery::newDocument($data);

$title = $pq['.item-1'] -> find('.title') -> eq(0) -> text();


if(!empty($title)){
	
	$fp = fopen($filename, 'w');

	if(!$fp){
		print_r(error_get_last());
		exit();
	}
	fwrite($fp, $title);
	fclose($fp);

}
else{
	$filename = 'No such file.';
}
// echo $title;