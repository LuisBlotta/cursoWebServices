<?php
/*
 * Leer documento XML desde IP

*/




function consultarWSXml($url){
$info = file_get_contents($url);	
if ($info == true) {
	$xml = @simplexml_load_string($info);

}else{
	$xml = "";

}
return $xml;

}
$info = consultarWSXml("https://www.w3schools.com/xml/note.xml");

if (empty($info) == false) {
	print_r($info);
}else{
	echo "Ha ocurrido un error";
}
//print_r($xml);


