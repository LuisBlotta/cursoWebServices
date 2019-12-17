<?php

ini_set("date.timezone", "America/Argentina/Buenos_Aires");

define("URL_API", "https://maps.googleapis.com");
define("RECURSO", "/maps/api/geocode/json?sensor=false&key=AIzaSyBZnYdxurerPYoyoSsOUe4n6g5hqSrQtcw");

//address=Buenos%20Aires,%20ar&

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, URL_API.RECURSO."&address=".urlencode($_GET['direccion']));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);

$result = curl_exec($ch);
$info = curl_getinfo($ch);

loguear("logs/request_info.log", "a+", "Ejecutando request GET a ".URL_API.RECURSO."&address=".urlencode($_GET['direccion']));
loguear("logs/request_info.log", "a+", "Request header: ".$info["request_header"]);
loguear("logs/request_info.log", "a+", "Response status code: ".$info["http_code"]);

if ($info["http_code"] == 200) {

	loguear("logs/request_info.log", "a+", "Response body: ".var_export($result, true));
	$data = json_decode($result, true);
	
	var_dump($data);

} else {
	loguear("logs/request_error.log", "a+", "Ejecutando request GET a ".URL_API.RECURSO."&address=".urlencode($_GET['direccion']));
	loguear("logs/request_error.log", "a+", "Request header: ".$info["request_header"]);
	loguear("logs/request_error.log", "a+", "Response status code: ".$info["http_code"]);
}

curl_close($ch);

function loguear($archivo, $modo, $mensaje) {

	$fecha = new DateTime();
	$ahora = $fecha->format('Y-m-d H:i:s');

	$fp = fopen($archivo, $modo);
	fwrite($fp, "[".$ahora."]\t".$mensaje.PHP_EOL);
	fclose($fp);
}