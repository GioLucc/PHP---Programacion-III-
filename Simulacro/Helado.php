<?php

class Helado
{
    private $_id;
    private $_sabor;
    private $_precio;
    private $_tipo;
    private $_vaso;
    private $_stock;

    public function __construct($sabor, $precio, $tipo, $vaso, $stock, $id = null)
    {
        $this->_sabor = $sabor;
        $this->_precio = $precio;
        $this->_tipo = $tipo;
        $this->_vaso = $vaso;
        $this->_stock = $stock;
        $this->_id = $id ?? rand(1, 100);
    }

    function subirImagen($imagenTmpPath, $nombreUsuario)
    {
        $carpetaDestino = __DIR__ . '/ImagenesDeLaVenta/2024/';
        $nombreImagen = $this->_sabor . '_' . $this->_tipo . '_' . $this->_vaso . '_' . $nombreUsuario . '_' . '.png';

        if (move_uploaded_file($imagenTmpPath, $carpetaDestino . $nombreImagen)) {
            return true;
        } else {
            return false;
        }
    }

    public function Equals($sabor, $tipo)
    {
        return $this->_sabor == $sabor && $this->_tipo == $tipo;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getSabor()
    {
        return $this->_sabor;
    }

    public function getPrecio()
    {
        return $this->_precio;
    }

    public function getTipo()
    {
        return $this->_tipo;
    }

    public function getVaso()
    {
        return $this->_vaso;
    }

    public function getStock()
    {
        return $this->_stock;
    }

    // setters
    public function setId($id)
    {
        $this->_id = $id;
    }

    public function setSabor($sabor)
    {
        $this->_sabor = $sabor;
    }

    public function setPrecio($precio)
    {
        $this->_precio = $precio;
    }

    public function setTipo($tipo)
    {
        $this->_tipo = $tipo;
    }

    public function setVaso($vaso)
    {
        $this->_vaso = $vaso;
    }

    public function setStock($stock)
    {
        $this->_stock = $stock;
    }
}


