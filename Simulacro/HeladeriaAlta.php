<?php

require_once 'Helado.php';

function AltaProducto($producto)
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

function subirImagenAlta($imagenTmpPath, $producto)
{
    $carpetaDestino = __DIR__ . '/ImagenesDeHelados/2024/';
    $nombreImagen = $producto->_sabor . '_' . $producto->_tipo . '.png';

    if (move_uploaded_file($imagenTmpPath, $carpetaDestino . $nombreImagen)) {
        return true;
    } else {
        return false;
    }
}

function ActualizarStock($producto)
{   
    $mensaje = "El producto ya existia, se agrega al stock";
    $sabor = $producto->getSabor();
    $tipo = $producto->getTipo();

    $productosExistente = VerificarExistencia($sabor,$tipo);
    
    if ($productosExistente) 
    {
        ActualizarStockProducto($producto);
    }
    else
    {
        $productosExistente = AltaProducto($producto);
        $mensaje = "Se da de alta un nuevo producto";
    }

    file_put_contents("heladeria.json", json_encode($productosExistente));

    echo $mensaje;
}

function VerificarExistencia($sabor, $tipo)
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

function ActualizarStockProducto($producto)
{
    $sabor = $producto->getSabor();
    $tipo = $producto->getTipo();
    $stock = $producto->getStock();

    $productosJson = json_decode(file_get_contents("heladeria.json"), true);

    foreach ($productosJson as &$producto) 
    {
        if ($producto['sabor'] == $sabor && $producto['tipo'] == $tipo) 
        {
            $producto['stock'] += $stock;
            break;
        }
    }

    file_put_contents("heladeria.json", json_encode($productosJson));
}






