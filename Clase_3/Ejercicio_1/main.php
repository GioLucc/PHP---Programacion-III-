<?php

require "Auto.php";

$auto = new Auto("Fiat","Rojo","1000");
$autoDos = new Auto("Ferarri","Rojo","1000");

Auto::AltaAuto($auto);
Auto::AltaAuto($autoDos);

$autos = Auto::LeerAuto();

foreach ($autos as $value) {
    Auto::MostrarAuto($value);
}



?>