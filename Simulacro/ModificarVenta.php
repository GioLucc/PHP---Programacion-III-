<?php
class ModificarVenta
{
    public static function ModificarUnaVenta($numeroPedido, $emailUsuario, $sabor, $tipo, $vaso, $cantidad,$nombre, $archivo)
    {
        if (file_exists($archivo)) {
            $ventas = json_decode(file_get_contents($archivo), true);
            echo $numeroPedido;
            foreach ($ventas as &$venta) {
                if ($venta['numeroDePedido'] === $numeroPedido) {
                    $venta['emailUsuario'] = $emailUsuario;
                    $venta['sabor'] = $sabor;
                    $venta['tipo'] = $tipo;
                    $venta['vaso'] = $vaso;
                    $venta['cantidad'] = $cantidad;
                    $venta['nombre'] = $nombre;


                    file_put_contents($archivo, json_encode($ventas));
                    return "Venta modificada exitosamente.";
                }
            }
            return "No existe una venta con ese número de pedido.";
        } else {
            return "El archivo no existe.";
        }
    }
}
