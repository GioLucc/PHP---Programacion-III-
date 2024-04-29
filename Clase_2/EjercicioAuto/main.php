<?php 
    require 'Auto.php';

    $autoUno = new Auto("Volskwagen","Rojo");
    $autoDos = new Auto("Volskwagen","Azul");
    $autoTres = new Auto("Volskwagen","Negro",4000);
    $autoCuatro = new Auto("Volskwagen","Negro",5000);
    $autoCinco = new Auto("Ferrari","Rojo",5000,"2024-04-27");

    $autoTres->AgregarImpuestos(1500);
    $autoCuatro->AgregarImpuestos(3000);
    $autoCinco->AgregarImpuestos(10000);

    echo Auto::MostrarAuto($autoTres);
    echo Auto::MostrarAuto($autoCuatro);
    echo Auto::MostrarAuto($autoCinco);

    $resultadoSuma = Auto::Add($autoUno,$autoDos);
    
    echo "El resultado de la suma de los autos anteriores es : " .$resultadoSuma. "<br>";

    echo $autoUno->Equals($autoDos) ? " Iguales" : "Distintos";
    echo "<br>";
    echo $autoUno->Equals($autoCinco) ? " Iguales" : "Distintos";

    echo "<br>";
    echo "<br>";
    echo "<br>";

    $arrayAutos = [$autoUno,$autoDos,$autoTres,$autoCuatro,$autoCinco];

    foreach ($arrayAutos as $i => $auto) { 
        if ($i % 2 == 0)
            echo Auto::MostrarAuto($auto);
    }

    
?>