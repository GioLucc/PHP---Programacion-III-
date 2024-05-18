<?php
class AltaVenta
{
    public static function EscribirVenta()
    {
        require_once "Venta.php";
        $listaVentas = [];
        if (!file_exists('ventas.json')) {
            file_put_contents('ventas.json', '[]');
            echo "Se crea el vacio";
        } else {
            $listaVentas = json_decode(file_get_contents('ventas.json'), true);
        }

        $ventaCreada = new Venta();
        
        // Array asociativo (tipo para JSON)
        $nuevaVenta = [
            'fecha' => $ventaCreada->getFecha(),
            'numeroDePedido' => $ventaCreada->getNumeroPedido(),
            'id' => $ventaCreada->getId(),
        ];

        array_push($listaVentas, $nuevaVenta);

        file_put_contents("ventas.json", json_encode($listaVentas));
    }
}
