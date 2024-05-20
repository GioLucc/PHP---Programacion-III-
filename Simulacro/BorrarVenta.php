<?php
class BorrarVenta
{
    public static function BorrarVenta($numeroDePedido, $archivo)
    {
        require_once "Utilidades.php";
        $borrado = false;
        if ($numeroDePedido != null && file_exists($archivo)) {
            $jsonString = json_decode(file_get_contents($archivo), true);

            foreach ($jsonString as &$item) {
                if ($item['numeroDePedido'] == $numeroDePedido) {
                    $item['deleted'] = true;
                    file_put_contents($archivo, json_encode($jsonString));
                    $nombreMail= Utilidades::ObtenerUsuarioMail($item['email']);

                    $imagenNombre = $item['sabor'] . '_' . $item['tipo'] . '_' . $item['vaso'] . '_' . $nombreMail . '.jpg';
                    $rutaImagenOriginal = __DIR__ . '/ImagenesDeLaVenta/2024/' . $imagenNombre;
                    $rutaImagenEliminada = __DIR__ . '/ImagenesBackupVentas/2024/' . $imagenNombre;
                    if (file_exists($rutaImagenOriginal)) {
                        rename($rutaImagenOriginal, $rutaImagenEliminada);
                    }
                    $borrado = true;
                    break;
                }
            }
        }

        return $borrado;
    }
}
