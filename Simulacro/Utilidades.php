<?php
class Utilidades
{
    public static function EncontrarUltimoId($nombreArchivo)
    {
        if (file_exists($nombreArchivo)) {
            $datosJson = json_decode(file_get_contents($nombreArchivo), true);
            if (!empty($datosJson)) {
                $ultimoProducto = end($datosJson);
                if (isset($ultimoProducto['id'])) {
                    return $ultimoProducto['id'] + 1;
                }
            }
        }
        return 1;
    }
}
