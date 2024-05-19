<?php
class Venta
{
    private $_fecha;
    private $_numeroPedido;
    private $_id;

    public function __construct($numeroPedido= null, $id = null,$fecha = null)
    {
        require_once "Utilidades.php";
        if ($fecha === null) {
            $fecha = new DateTime();
            $fecha = $fecha->format('d-m-Y');
        }

        $this->_fecha = $fecha;
        $this->_numeroPedido = Venta::generarNumeroPedido();
        $this->_id = Utilidades::EncontrarUltimoId("ventas.json");
    }

    private static function generarNumeroPedido() 
    {
        return uniqid(true);
    }

    public function getFecha()
    {
        return $this->_fecha;
    }

    public function setFecha($fecha)
    {
        $this->_fecha = $fecha;
    }

    public function getNumeroPedido()
    {
        return $this->_numeroPedido;
    }

    public function setNumeroPedido($numeroPedido)
    {
        $this->_numeroPedido = $numeroPedido;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }
}
