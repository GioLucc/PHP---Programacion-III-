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
}
