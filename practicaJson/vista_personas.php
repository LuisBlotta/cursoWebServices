<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="estilos.css">
<?php
require 'Conexion.php';
require 'Persona.php';


$persona = new Persona;
$personas = $persona->traerPersonas();
?>

<section class="contenedor">
    <?php

foreach ($personas as $persona){ ?>
<div class='card'>

         <img src='<?=$persona['img']?>' alt='Card image' style='width:45%; margin: auto; margin-top: 30px;'>


        <div class='card-body' style='float: left'>
         <p>Nombre:  <?=$persona['nombre']?></p>
         <p>Apellido: <?= $persona['apellido']?></p>
         <p>Direccion:  <?=$persona['direccion']?></p>
         <p>Mail: <?=$persona['mail']?></p>
        <p>edad:  <?=$persona['edad']?></p>
        </div>
</div>


    <br><br>



<?php }
?>

</section>
<div style="text-align: center; padding: 30px;">
<a href="random_user.php"> <button class="btn-info">Generar Usuario</button></a>
</div>