<?php
require 'Conexion.php';
getPeliculas();
function getPeliculas(){

    $conn = Conexion::conectar();
    $sql="SELECT * FROM pelicula";

    $stmt = $conn->prepare($sql);
    $stmt-> execute();
    $peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $xml = new SimpleXmlElement("<peliculas></peliculas>"); //Nombre del archivo, parametro adicional, para escribir un xml es true, para leer es false
    $xml->addAttribute('encoding', 'UTF-8');
    $xml->addAttribute('version', '1.0');


    foreach ($peliculas as $pelicula){

        $titulo =  $pelicula['titulo'];
        $autor  =  $pelicula['autor'];
        $resumen  =  $pelicula['resumen'];
        $precio = $pelicula['precio'];
        $color_de_cd = $pelicula['color_de_cd'];

        $pelicula = $xml->addChild("pelicula");

        $pelicula->addChild("titulo", $titulo);
        $pelicula->addChild("autor",$autor);
        $pelicula->addChild("resumen", $resumen);
        $pelicula->titulo->addAttribute('precio', $precio);
        $pelicula->titulo->addAttribute('color_de_cd', $color_de_cd);
    }

    header("Content-Type: text/xml");
    $textoXML =  $xml->asXML();
    echo $textoXML;
    $gestor = fopen("peliculas.xml", 'w');
    fwrite($gestor, $textoXML);
    fclose($gestor);

    }







