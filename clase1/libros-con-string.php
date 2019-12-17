<?php
/*
 * Leer documento XML desde PHP
 * Iterar sobre los libros disponibles
 * Armar tabla HTML de salida al navegador
*/

define("WEB_SERVICE", "http://127.0.0.1/clase1/libros.xml");

$info = file_get_contents(WEB_SERVICE);	
$xml = simplexml_load_string($info);

$tabla = "<table>";
$tabla .= "<tr>";
$tabla .= "<th>Titulo</th>";
$tabla .= "<th>Editorial</th>";
$tabla .= "<th>Autor</th>";
$tabla .= "<th>Precio</th>";
$tabla .= "</tr>";

for ($i=0; $i < count($xml->libro); $i++) { 

		foreach ($xml->libro[$i]->titulo->attributes() as $key => $value) {
			if ($key == "precio") {
					$precio = $value;
			}
		}

	    $tabla .= "<tr>";
		$tabla .= "<td>".$xml->libro[$i]->titulo."</td>";
		$tabla .= "<td>".$xml->libro[$i]->editorial."</td>";
		$tabla .= "<td>".$xml->libro[$i]->autor."</td>";
		$tabla .= "<td>".$precio."</td>";
		$tabla .= "</tr>";
}

$tabla .= "</table>";
echo $tabla;
//print_r($xml);