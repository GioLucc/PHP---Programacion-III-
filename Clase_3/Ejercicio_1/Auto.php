<?php
class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    # Construct?
    public function __construct($marca, $color, $precio = null, $fecha = null)
    {
        if($fecha == null)
        {
            $fecha = date("d-m-y");
        }
        $this->_color = $color;
        $this->_marca = $marca;
        $this->_fecha = $fecha;
        $this->_precio = $precio;
    }

    public function AgregarImpuestos($impuestos)
    {
        $this->_precio += $impuestos;
    }

    public static function MostrarAuto($auto)
    {
        echo "Color: " . $auto->_color . "<br>",
        "Precio: " . $auto->_precio . "<br>",
        "Marca: " . $auto->_marca . "<br>",
        "Fecha: " . $auto->_fecha . "<br><br>";
    }

    public function Equals(Auto $auto)
    {
        return $this->_marca == $auto->_marca;
    }

    public static function Add($autoUno, $autoDos)
    {
        $mismaMarcaColor = ($autoUno->_marca == $autoDos->_marca && $autoUno->_color == $autoDos->_color);

        return $mismaMarcaColor ? $autoUno->precio + $autoDos->precio : 0;
    }
    
    public static function AltaAuto(Auto $auto)
    {   
        $archivoAuto = fopen("autos.csv","a");

        $banderaEncontrado = false;
        $autos = Auto::LeerAuto();

        foreach ($autos as $value) {
            if($value->_marca == $auto->_marca)
            {
                echo "El auto ya existe";
                $banderaEncontrado = true;
            }
        }

        if($banderaEncontrado == false)
        {
            # Abre el archivo con, como se llamara y el a para que lo cree si no ta
            $archivoAuto = fopen("autos.csv","a");
            # Linea de texto que se va a escribir en el archivo
            fwrite($archivoAuto, $auto->_marca . "," . $auto->_color . "," . $auto->_precio . "," . $auto->_fecha . "\n");
        }
        fclose($archivoAuto);
    }

    public static function LeerAuto()
    {   
        $autos = array();
        $archivoAuto = fopen("autos.csv","r");

        while (!feof($archivoAuto)) {
            $lectura = fgets($archivoAuto);
            
            // Verificar si la línea no está vacía antes de procesarla
            if (!empty($lectura)) {
                $arrayDeLaLinea = explode(",", $lectura);
                
                // Verificar si se obtuvieron todos los elementos esperados
                if (count($arrayDeLaLinea) == 4) {
                    $autoAux = new Auto($arrayDeLaLinea[0], $arrayDeLaLinea[1], (float)$arrayDeLaLinea[2], $arrayDeLaLinea[3]);
                    array_push($autos, $autoAux);
                } else {
                    // Manejar el caso donde la línea no tiene el formato esperado
                    echo "Error: La línea no tiene el formato esperado: $lectura";
                }
            }
        }
        
        fclose($archivoAuto);
        return $autos;
    }

}
