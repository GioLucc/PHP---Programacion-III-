<?php
class Utilidades
{
    public static function EncontrarUltimoId($nombreArchivo)
    {
        if (file_exists($nombreArchivo)) {
            $datosJson = json_decode(file_get_contents($nombreArchivo), true);
            $ultimoProducto = end($datosJson);
            return $ultimoProducto['id'];
        }
        return null;
    }
}
