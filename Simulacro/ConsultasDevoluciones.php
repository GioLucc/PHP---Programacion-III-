<?php

class ConsultaDevoluciones
{
    public static function ListarDevolucionesConCupones()
    {
        if (file_exists("cupones.json") && file_exists("devoluciones.json")) {
            $cuponesJson = json_decode(file_get_contents("cupones.json"), true);
            $devolucionesJson = json_decode(file_get_contents("devoluciones.json"), true);

            foreach ($cuponesJson as $cupones) {
                foreach ($devolucionesJson as $devoluciones) {
                    if ($cupones['idDevolucion'] == $devoluciones['idDevolucion']) {
                        echo "Devolución de numero de Pedido: " . $devoluciones['numeroPedido'] . "<br>";
                        echo "Causa de devolución: " . $devoluciones['causaDevolucion'] . "<br>";
                        echo "Y un cupon con descuento de : %" . $cupones['porcentajeDescuento'] . "<br>";
                    }
                }
            }
        }
    }
    public static function ListarDevolucionesConCuponesYEstados()
    {
        if (file_exists("cupones.json") && file_exists("devoluciones.json")) {
            $cuponesJson = json_decode(file_get_contents("cupones.json"), true);
            $devolucionesJson = json_decode(file_get_contents("devoluciones.json"), true);

            foreach ($cuponesJson as $cupones) {
                foreach ($devolucionesJson as $devoluciones) {
                    if ($cupones['idDevolucion'] == $devoluciones['idDevolucion']) {
                        echo "Devolución de numero de Pedido: " . $devoluciones['numeroPedido'] . "<br>";
                        echo "Causa de devolución: " . $devoluciones['causaDevolucion'] . "<br>";
                        echo "Cupon en estado: " . $cupones['estado'] . "<br>";
                        echo "Y descuento de : %" . $cupones['porcentajeDescuento'] . "<br>";
                    }
                }
            }
        }
    }

    public static function ListarCuponesYEstados()
    {
        if (file_exists("cupones.json")) {
            $cuponesJson = json_decode(file_get_contents("cupones.json"), true);
            foreach ($cuponesJson as $cupones) { {
                    echo "Id Cupon: " . $cupones['id'] . "<br>";
                    echo "Id Devolución: " . $cupones['idDevolucion'] . "<br>";
                    echo "Porcentaje de descuento de : %" . $cupones['porcentajeDescuento'] . "<br>";
                    echo "Estado del cupon: " . $cupones['estado'] . "<br>";
                }
            }
        }
    }
}
