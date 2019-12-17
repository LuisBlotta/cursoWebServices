<?php

ini_set("date.timezone", "America/Argentina/Buenos_Aires");

define("URL_API", "https://api.estadisticasbcra.com");
define("USD", "/usd");

$ch = curl_init();

$header_auth = array('Authorization: BEARER eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2MDIzNzQwNTgsInR5cGUiOiJleHRlcm5hbCIsInVzZXIiOiJkYW5pdWZAZ21haWwuY29tIn0.wlZgAsVrAWi_-6pLjIlsmDoXBMYYhui3_BwuaPr41AaBvnO8rZVzl0sh3oE7-6KFL_8SioV1N74pwTr8PHvE4g');

curl_setopt($ch, CURLOPT_URL, URL_API.USD);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_HTTPHEADER, $header_auth);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);

$result = curl_exec($ch);
$info = curl_getinfo($ch);

 var_dump($cotizacion = json_decode($result, true));

loguear("logs/request_info.log", "a+", "Ejecutando request GET a ".URL_API.USD);
loguear("logs/request_info.log", "a+", "Request header: ".$info["request_header"]);
loguear("logs/request_info.log", "a+", "Response status code: ".$info["http_code"]);

if ($info["http_code"] == 200) {

	loguear("logs/request_info.log", "a+", "Response body: ".var_export($result, true));


	for ($i=0; $i < count($cotizacion); $i++) {
		echo "<p>".$cotizacion[$i]['d'].": ".$cotizacion[$i]['v']."</p>";
	}

} else {
	loguear("logs/request_error.log", "a+", "Ejecutando request GET a ".URL_API.USD);
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