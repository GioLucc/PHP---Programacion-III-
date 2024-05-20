<?php
class AltaVenta
{
    public static function EscribirVenta($email,$nombre,$helado,$descuentoCupon = 0)
    {
        require_once "Venta.php";
        $listaVentas = [];
        if (!file_exists('ventas.json')) {
            file_put_contents('ventas.json', '[]');
            echo "Se crea el vacio";
        } else {
            $listaVentas = json_decode(file_get_contents('ventas.json'), true);
        }
        require_once 'Helado.php';

        $stockHelado = $helado->getStock();
        $precioHelado = $helado->getPrecio();

        $importeFinal = $precioHelado * $stockHelado;

        if($descuentoCupon > 0)
        {
            $descuento = $importeFinal * $descuentoCupon / 100;
            $importeFinal = $importeFinal - $descuento;

        }
        $ventaCreada = new Venta();
        
        // Array asociativo (tipo para JSON)
        $nuevaVenta = [
            'fecha' => $ventaCreada->getFecha(),
            'numeroDePedido' => $ventaCreada->getNumeroPedido(),
            'id' => $ventaCreada->getId(),
            'email' => $email,
            'nombre' => $nombre,
            'sabor' => $helado-> getSabor(),
            'tipo' => $helado-> getTipo(),
            'vaso' => $helado-> getVaso(),
            'cantidad' => $stockHelado,
            'importeFinal' => $importeFinal,
            'descuentoCupon' => $descuentoCupon, 
        ];

        array_push($listaVentas, $nuevaVenta);

        file_put_contents("ventas.json", json_encode($listaVentas));
    }

    public static function subirImagenVenta($imagenTmpPath,$sabor,$tipo,$vaso,$nombreUsuario)
    {

        $carpetaDestino = __DIR__ . '/ImagenesDeLaVenta/2024/';
        $nombreImagen = $sabor . '_' . $tipo . '_' . $vaso . '_' . $nombreUsuario .  '.jpg';

        if (move_uploaded_file($imagenTmpPath, $carpetaDestino . $nombreImagen)) {
            return true;
        } else {
            return false;
        }
    }
}
