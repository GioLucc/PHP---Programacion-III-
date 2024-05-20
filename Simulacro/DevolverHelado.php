<?php
class DevolverHelado
{
    public static function DevolverUnHelado($numeroPedido,$causaDevolucion,$idDevolucion)
    {
        require_once 'Utilidades.php';
        $listaDevoluciones= [];
        if (!file_exists('devoluciones.json')) {
            file_put_contents('devoluciones.json', '[]');
            echo "Se crea el vacio";
        } else {
            $listaDevoluciones = json_decode(file_get_contents('devoluciones.json'), true);
        }

        // Array asociativo (tipo para JSON)
        $nuevaDevolucion = [
            'numeroPedido' => $numeroPedido,
            'causaDevolucion' => $causaDevolucion,
            'idDevolucion' => $idDevolucion,
        ];

        array_push($listaDevoluciones,$nuevaDevolucion);

        file_put_contents("devoluciones.json", json_encode($listaDevoluciones));
    }
}
