<?php
Class Venta
{
    private $_fecha;
    private $_numeroPedido;
    private $_id;

    public function __construct($fecha, $numeroPedido, $id = null)
{
    $this->_fecha = $fecha;
    $this->_numeroPedido = $numeroPedido;
    $this->_id = $id;
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
?>