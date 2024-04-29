<!-- Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”. -->

<?php

function InvertirPalabra($palabra)
{
    $largoPalabra = count($palabra);

    for ($i=$largoPalabra-1; $i >= 0 ; $i--) { 
        echo $palabra[$i];
    }
}

$arrayPalabra = array('H','O','L','A');
InvertirPalabra($arrayPalabra);


?>