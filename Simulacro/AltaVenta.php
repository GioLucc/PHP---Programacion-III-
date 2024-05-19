<?php
class AltaVenta
{
    public static function EscribirVenta($email,$sabor,$vaso,$nombre,$cantidad)
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
            'email' => $email,
            'sabor' => $sabor,
            'vaso' => $vaso,
            'nombre' => $nombre,
            'cantidad' => $cantidad,
        ];

        array_push($listaVentas, $nuevaVenta);

        file_put_contents("ventas.json", json_encode($listaVentas));
    }

    public static function subirImagenVenta($imagenTmpPath,$sabor,$tipo,$nombreUsuario)
    {


        $carpetaDestino = __DIR__ . '/ImagenesDeLaVenta/2024/';
        $nombreImagen = $sabor . '_' . $tipo . '_' . $nombreUsuario . '.jpg';

        if (move_uploaded_file($imagenTmpPath, $carpetaDestino . $nombreImagen)) {
            return true;
        } else {
            return false;
        }
    }
}
