<?php 
    require 'Auto.php';
    require 'Garage.php'; 

    $garageUno = new Garage("Franco's Garage",1000);
    $autoUno = new Auto("Ford", "Fiesta", "Negro", 100000);
    $autoDos = new Auto("Ford", "Fiesta", "Negro", 100000);
    $autoTres = new Auto("Fiat", "Palio", "Blanco", 100000);
    
    $garageUno->Add($autoUno);
    $garageUno->Add($autoDos);
    $garageUno->Add($autoTres);
    
    $garageUno->MostrarGarage();

    $garageUno->Remove($autoUno);
    $garageUno->Remove($autoDos);

    $garageUno->MostrarGarage();


?>