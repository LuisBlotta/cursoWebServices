<?php
/*
 * Leer documento XML desde IP

*/

define("WEB_SERVICE", "http://www.geoplugin.net/xml.gp?ip=190.104.198.101");

$ip_usuario = $_USER['REMOTE_ADDR']; //desde donde estan navegando en mi sitio... con @ callamos los notice de error



$info = file_get_contents(WEB_SERVICE);	
$xml = simplexml_load_string($info);

//print_r($xml);

echo "bienvenido, usted nos visita desde".$xml->geoplugin_city.",".$xml->geoplugin_countryName ;

