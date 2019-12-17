<?php
$xml = new SimpleXmlElement("<vehiculos></vehiculos>"); //Nombre del archivo, parametro adicional, para escribir un xml es true, para leer es false
$xml->addAttribute('encoding', 'UTF-8');
$xml->addAttribute('version', '1.0');
$vehiculo = $xml->addChild("vehiculo");
$vehiculo->addChild("marca", "Audi");
$vehiculo->addChild("modelo", "A3");
$vehiculo->addChild("version", "1.4");
/*agrego otro*/
$vehiculo = $xml->addChild("vehiculo");
$vehiculo->addChild("marca", "Ford");
$vehiculo->addChild("modelo", "Fiesta");
$vehiculo->addChild("version", "1.6");

header("Content-Type: text/xml");
$var =  $xml->asXML();
echo $var;