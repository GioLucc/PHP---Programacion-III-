<?php

require_once 'Helado.php';

class HeladeriaAlta
{
    public static function AltaProducto($producto)
    {
        $listaProductos = [];
        if (!file_exists('heladeria.json')) {
            file_put_contents('heladeria.json', '[]');
            echo "Se crea el vacio";
        } else {
            $listaProductos = json_decode(file_get_contents('heladeria.json'), true);
        }
        // Array asociativo (tipo para JSON)
        $nuevoProducto = [
            'sabor' => $producto->getSabor(),
            'precio' => $producto->getPrecio(),
            'tipo' => $producto->getTipo(),
            'vaso' => $producto->getVaso(),
            'stock' => $producto->getStock(),
            'id' => $producto->getId(),
        ];

        array_push($listaProductos, $nuevoProducto);

        return $listaProductos;
    }

    public static function subirImagenHelado($imagenTmpPath, $producto)
    {
        $sabor = $producto->getSabor();
        $tipo = $producto->getTipo();

        $carpetaDestino = __DIR__ . '/ImagenesDeHelados/2024/';
        $nombreImagen = $sabor . '_' . $tipo . '.jpg';

        if (move_uploaded_file($imagenTmpPath, $carpetaDestino . $nombreImagen)) {
            return true;
        } else {
            return false;
        }
    }

    public static function DeterminarAltaOActualizacion($producto)
    {
        $sabor = $producto->getSabor();
        $tipo = $producto->getTipo();
        $stock = $producto->getStock();

        $productosExistente = HeladeriaAlta::VerificarExistencia($sabor, $tipo);

        if ($productosExistente) {
            $mensaje = "El producto ya existia, se agrega al stock";
            $listaProductos = HeladeriaAlta::AgregarStockProducto($sabor,$tipo,$stock);
        } else {
            $listaProductos = HeladeriaAlta::AltaProducto($producto);
            $mensaje = "Se da de alta un nuevo producto";
        }

        file_put_contents("heladeria.json", json_encode($listaProductos));

        echo $mensaje;
    }

    public static function VerificarExistencia($sabor, $tipo)
    {
        $banderaComprobacion = false;
        if ($sabor != null && file_exists('heladeria.json')) {
            $productosJson = json_decode(file_get_contents("heladeria.json"), true);

            foreach ($productosJson as $producto) {
                if ($producto['sabor'] == $sabor && $producto['tipo'] == $tipo) {
                    $banderaComprobacion = true;
                    echo "Se encontró";
                    break;
                }
            }
        }

        return $banderaComprobacion;
    }

    public static function AgregarStockProducto($sabor,$tipo,$stock)
    {
        if ($sabor != null && $tipo == null && $stock == null) {

            $productosJson = json_decode(file_get_contents("heladeria.json"), true);

            foreach ($productosJson as &$producto) {
                if ($producto['sabor'] == $sabor && $producto['tipo'] == $tipo) {
                    $producto['stock'] += $stock;
                    break;
                }
            }

            return $productosJson;
        }
    }

    public static function DescontarStockProducto($sabor,$tipo,$stock)
    {
        if ($sabor != null && $tipo != null && $stock != null) {

            $productosJson = json_decode(file_get_contents("heladeria.json"), true);

            foreach ($productosJson as &$producto) {
                if ($producto['sabor'] == $sabor && $producto['tipo'] == $tipo) {
                    $producto['stock'] -= $stock;
                    break;
                }
            }

            file_put_contents("heladeria.json", json_encode($productosJson));
        }
    }
}
