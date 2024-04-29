<?php
// Aplicación No 18 (Auto - Garage)
// Crear la clase Garage que posea como atributos privados:

// _razonSocial (String)
// _precioPorHora (Double)
// _autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
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
    private $_autos = [];

    public function __construct($razonSocial, $precioPorHora = null)
    {
        $this->_razonSocial = $razonSocial;
        $this->_precioPorHora = $precioPorHora;
    }

    public function MostrarGarage()
    {
        echo "Razón social:" . $this->_razonSocial . "<br>",
        "Precio Por hora:" . $this->_precioPorHora . "<br><br><br>";

        foreach ($this ->_autos as $autito) {
            Auto::MostrarAuto($autito);
        }
    }

    public function Equals ($auto)
    {   
        $estaEnElGarage = false;

        foreach ($this-> _autos as $i => $autoGarage) 
        {
            if($autoGarage == $auto) 
            {
                $estaEnElGarage = true;
                break;
            }
        }

        return $estaEnElGarage;
    }


    public function Add($auto)
    {   
        $mensaje = "Se agregó correctamente";
        
        $estaEnElGarage = false;

        foreach ($this-> _autos as $autoGarage) 
        {
            if($autoGarage == $auto) 
            {
                $estaEnElGarage = true;
                $mensaje = "No se agregó correctamente";
            }
        }

        if ($estaEnElGarage == false)
            array_push($this->_autos, $auto);

        echo $mensaje. "<br><br>";
    }

    public function Remove ($auto)
    {   
        $mensaje = "Se pudo remover correctamente";

        $banderaEntro = false;
        foreach ($this-> _autos as $i => $autoGarage) 
        {
            if($autoGarage == $auto) 
            {
                unset($this->_autos[$i]);
                $this->_autos = array_values($this->_autos);
                $banderaEntro = true;
                break;
            }
        }
        if ($banderaEntro == false)
            $mensaje = "No se pudo remover correctamente";

        echo $mensaje . "<br><br>";
    }

    

}


// En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
// los métodos.

