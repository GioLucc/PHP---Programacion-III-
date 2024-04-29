<?php
// Aplicación No 18 (Auto - Garage)
// Crear la clase Garage que posea como atributos privados:

// _razonSocial (String)
// _precioPorHora (Double)
// _listaAutos (Autos[], reutilizar la clase Auto del ejercicio anterior)
// Realizar un constructor capaz de poder instanciar objetos pasándole como

// parámetros: i. La razón social.
// ii. La razón social, y el precio por hora.

// Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
// que mostrará todos los atributos del objeto.
// Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
// objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
// Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
// (sólo si el auto no está en el garaje, de lo contrario informarlo).
// Ejemplo: $miGarage->Add($autoUno);
// Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
// “Garage” (sólo si el auto está en el garaje, de lo contrario informarlo). Ejemplo:
// $miGarage->Remove($autoUno);
// En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
// los métodos.
require_once 'Auto.php';

class Garage
{

    private $_razonSocial;
    private $_precioPorHora;
    private $_listaAutos = [];

    public function __construct($razonSocial, $precioPorHora = null)
    {
        $this->_razonSocial = $razonSocial;
        $this->_precioPorHora = $precioPorHora;
    }

    public function MostrarGarage()
    {
        echo "Razón social:" . $this->_razonSocial . "<br>",
        "Precio Por hora:" . $this->_precioPorHora . "<br><br><br>";

        foreach ($this->_listaAutos as $autito) {
            Auto::MostrarAuto($autito);
        }
    }

    public function Equals($auto)
    {
        $estaEnElGarage = false;

        foreach ($this->_listaAutos as $i => $autoGarage) {
            if ($autoGarage == $auto) {
                $estaEnElGarage = true;
                break;
            }
        }

        return $estaEnElGarage;
    }


    public function Add($auto)
    {
        $estaEnElGarage = false;

        foreach ($this->_listaAutos as $autoGarage) {
            if ($autoGarage == $auto) {
                $estaEnElGarage = true;
                $mensaje = "No se agregó correctamente";
                echo $mensaje . "<br><br>";
            }
        }

        if ($estaEnElGarage == false)
            array_push($this->_listaAutos, $auto);

    }

    public function Remove($auto)
    {
        $mensaje = "Se pudo remover correctamente";

        $banderaEntro = false;
        foreach ($this->_listaAutos as $i => $autoGarage) {
            if ($autoGarage == $auto) {
                unset($this->_listaAutos[$i]);
                $this->_listaAutos = array_values($this->_listaAutos);
                $banderaEntro = true;
                break;
            }
        }
        if ($banderaEntro == false)
            $mensaje = "No se pudo remover correctamente";

        echo $mensaje . "<br><br>";
    }

    public static function AltaGarage(Garage $garage)
    {
        $autos = "";
        $banderaPrimero = true;
        $archivoGarage = fopen("garage.csv", "a");
        foreach ($garage->_listaAutos as $auto) {
            if ($banderaPrimero) {
                $autos = $auto->_marca . "," . $auto->_color . "," . $auto->_precio . "," . $auto->_fecha;
                $banderaPrimero = false;
            } else {
                $autos = $autos . "|" . $auto->_marca . "," . $auto->_color . "," . $auto->_precio . "," . $auto->_fecha;
            }
        }

        fwrite($archivoGarage, $garage->_razonSocial . "/" . $garage->_precioPorHora . "/" . $autos . "\n");

        fclose($archivoGarage);
    }

    public static function LeerGarage()
    {
        $garages = array();
        $archivoGarage = fopen("garage.csv", "r");

        while (!feof($archivoGarage)) {
            $lectura = fgets($archivoGarage);

            // Verificar si la línea no está vacía antes de procesarla
            if (!empty($lectura)) {
                $arrayDeLaLinea = explode("/", $lectura);

                // Verificar si se obtuvieron todos los elementos esperados
                if (count($arrayDeLaLinea) == 3) {
                    $garageAux = new Garage($arrayDeLaLinea[0], (float)$arrayDeLaLinea[1]);
                    $arrayDeAutos = explode("|", $arrayDeLaLinea[2]);
                    foreach ($arrayDeAutos as $auto) {
                        $arrayDeAuto = explode(",", $auto);
                        // Verificar si se obtuvieron todos los elementos esperados
                        if (count($arrayDeAuto) == 4) {
                            $autoAux = new Auto($arrayDeAuto[0], $arrayDeAuto[1], (float)$arrayDeAuto[2], $arrayDeAuto[3]);
                            $garageAux->Add($autoAux);
                        }
                    }
                    array_push($garages, $garageAux);
                } else {
                    // Manejar el caso donde la línea no tiene el formato esperado
                    echo "Error: La línea no tiene el formato esperado: $lectura";
                }
            }
        }

        fclose($archivoGarage);
        return $garages;
    }
}


// En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
// los métodos.
