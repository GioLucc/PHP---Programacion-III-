<?php
require "Auto.php";
require "Garage.php";

$auto = new Auto("Fiat","Rojo","1000");
$autoDos = new Auto("Ferarri","Rojo","1000");

$garageUno = new Garage("Franco's Garage",1000);

// $garageUno->add($auto);
$garageUno->add($autoDos);

$garageUno::AltaGarage($garageUno);

$garages = Garage::LeerGarage();

foreach ($garages as $value) {
    $value->MostrarGarage();
}



?>