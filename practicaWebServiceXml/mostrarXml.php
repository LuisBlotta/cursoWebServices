<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<?php

define("NOMBRE_ARCHIVO", "peliculas.xml");
if (file_exists(NOMBRE_ARCHIVO)) {
    $xml = simplexml_load_file(NOMBRE_ARCHIVO);

    $tabla = "<table class='table table-bordered table-striped table-hover '>";
    $tabla .= "<tr>";
    $tabla .= "<th>Titulo</th>";
    $tabla .= "<th>Autor</th>";
    $tabla .= "<th>Resumen</th>";
    $tabla .= "<th>Precio</th>";
    $tabla .= "<th>Color Cd</th>";
    $tabla .= "</tr>";


    for ($i=0; $i < count($xml->pelicula); $i++) {

        foreach ($xml->pelicula[$i]->titulo->attributes() as $key => $value) { /*Me paro en el nodo con los atributos y desues coparo las key*/
            if ($key == "precio") {
                $precio = $value;

            }
        }

        foreach ($xml->pelicula[$i]->titulo->attributes() as $key => $value) {
            if ($key == "color_de_cd") {
                $color_de_cd = $value;

            }
        }


        $tabla .= "<tr>";
        $tabla .= "<td>".$xml->pelicula[$i]->titulo."</td>";
        $tabla .= "<td>".$xml->pelicula[$i]->autor."</td>";
        $tabla .= "<td>".$xml->pelicula[$i]->resumen."</td>";
        $tabla .= "<td>".$precio."</td>";
        $tabla .= "<td>".$color_de_cd."</td>";

        $tabla .= "</tr>";
    }

    $tabla .= "</table>";
    echo $tabla;
    //print_r($xml);
} else {
    exit('Error abriendo '.NOMBRE_ARCHIVO);
}