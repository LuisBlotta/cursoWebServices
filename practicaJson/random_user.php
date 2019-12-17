<?php
require 'Conexion.php';

ini_set("date.timezone", "America/Argentina/Buenos_Aires");

define("URL_API", "https://randomuser.me/api/");



$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, URL_API);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);

$result = curl_exec($ch);
$info = curl_getinfo($ch);

//var_dump( $data['results'][0]['name']['first']);




loguear("logs/request_info.log", "a+", "Ejecutando request GET a ".URL_API);
loguear("logs/request_info.log", "a+", "Request header: ".$info["request_header"]);
loguear("logs/request_info.log", "a+", "Response status code: ".$info["http_code"]);

if ($info["http_code"] == 200) {
    $data = json_decode($result, true);// con true es array, sin true es objeto

 //   var_dump($data);

	loguear("logs/request_info.log", "a+", "Response body: ".var_export($result, true));



  for ($i=0; $i<count($data['results']); $i++){

      $nombre =  $data['results'][$i]['name']['first'];
      $apellido = $data['results'][$i]['name']['last'];
      $direccion =  $data['results'][$i]['location']['street']['name'];
      $mail =  $data['results'][$i]['email'];
      $edad = $data['results'][$i]['dob']['age'];
     $img = $data['results'][$i]['picture']['large'];

guardarDatos($nombre, $apellido, $direccion, $mail, $edad, $img);

  }



} else {
	loguear("logs/request_error.log", "a+", "Ejecutando request GET a ".URL_API.RECURSO."&address=".urlencode($_GET['direccion']));
	loguear("logs/request_error.log", "a+", "Request header: ".$info["request_header"]);
	loguear("logs/request_error.log", "a+", "Response status code: ".$info["http_code"]);
}

curl_close($ch);
header('location:vista_personas.php');

function loguear($archivo, $modo, $mensaje) {

	$fecha = new DateTime();
	$ahora = $fecha->format('Y-m-d H:i:s');

	$fp = fopen($archivo, $modo);
	fwrite($fp, "[".$ahora."]\t".$mensaje.PHP_EOL);
	fclose($fp);
}


function guardarDatos($nombre, $apellido, $direccion, $mail, $edad, $img){

    $conn = Conexion::conectar();

        $sql ="insert into persona (nombre,  apellido, direccion, mail, edad, img) values ('$nombre', '$apellido', '$direccion', '$mail', $edad, '$img')";

    $stmt = $conn->prepare($sql);
    $stmt-> execute();

}