<?php
class CuponDescuento
{
    private $_id;
    private $_devolucionId;
    private $_porcentajeDescuento;
    private $_estado;

    public function __construct($porcentajeDescuento = 10,$idDevolucion)
    {
        require_once 'Utilidades.php';
        $this->_id = Utilidades::EncontrarUltimoId("cupones.json");
        $this->_devolucionId = $idDevolucion;
        $this->_porcentajeDescuento = $porcentajeDescuento;
        $this->_estado = 'no usado';
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function getDevolucionId()
    {
        return $this->_devolucionId;
    }

    public function setDevolucionId($devolucionId)
    {
        $this->_devolucionId = $devolucionId;
    }

    public function getPorcentajeDescuento()
    {
        return $this->_porcentajeDescuento;
    }

    public function setPorcentajeDescuento($porcentajeDescuento)
    {
        $this->_porcentajeDescuento = $porcentajeDescuento;
    }

    public function getEstado()
    {
        return $this->_estado;
    }

    public function setEstado($estado)
    {
        $this->_estado = $estado;
    }

    public static function RegistrarCupones($cupon)
    {
        $listaCupones= [];
        if (!file_exists('cupones.json')) {
            file_put_contents('cupones.json', '[]');
            echo "Se crea el vacio";
        } else {
            $listaCupones = json_decode(file_get_contents('cupones.json'), true);
        }

        // Array asociativo (tipo para JSON)
        $nuevoCupon = [
            'id' => $cupon->getId(),
            'idDevolucion' => $cupon->getDevolucionId(),
            'porcentajeDescuento' => $cupon->getPorcentajeDescuento(),
            'estado' => $cupon->getEstado(),
        ];

        array_push($listaCupones, $nuevoCupon);

        file_put_contents("cupones.json", json_encode($listaCupones));
    }

}
