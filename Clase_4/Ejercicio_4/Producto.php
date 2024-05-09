<?php

class Producto
{
    private $_nombre;
    private $_tipo;
    private $_codigoDeBarras;
    private $_stock;
    private $_precio;
    private $_id;


    public function __construct($nombre, $tipo, $stock, $precio, $id = null, $codigoDeBarras = null)
    {
        $this->_nombre = $nombre;
        $this->_tipo = $tipo;
        $this->_stock = $stock;
        $this->_precio = $precio;
        $this->_codigoDeBarras = $codigoDeBarras ?? rand(100000, 999999);
        $this->_id = $id ?? rand(1, 10000);
    }

    public static function MostrarProducto($usuario)
    {
        echo "Id: " . $usuario->_id . "<br>",
        "Nombre: " . $usuario->_nombre . "<br>",
        "Codigo de Barras: " . $usuario->_clave . "<br>",
        "Tipo: " . $usuario->_mail . "<br>";
        "Stock:" . $usuario->_fechaDeRegistro . "<br><br>";
    }

    public static function AltaProducto($producto)
    {

        $listaProductos = [];
        if (!file_exists('productos.json')) {
            file_put_contents('productos.json', '[]');
            echo "Se crea el vacio";
        } else {
            $listaProductos = json_decode(file_get_contents('productos.json'), true);
        }
        // Array asociativo (tipo para JSON)
        $nuevoProducto = [
            'nombre' => $producto->_nombre,
            'tipo' => $producto->_tipo,
            'stock' => $producto->_stock,
            'precio' => $producto->_precio,
            'id' => $producto->_id,
            'codigoDeBarra' => $producto->_codigoDeBarras
        ];

        array_push($listaProductos, $nuevoProducto);

        return $listaProductos;
    }

    public static function LeerProducto()
    {
        $listaProductos = [];
        if (file_exists('productos.json')) {
            $productosLeidos = json_decode(file_get_contents('productos.json'), true);

            foreach ($productosLeidos as $producto) {
                // Objeto para devolver una lista
                $productoAux = new Producto(
                    $producto[0],
                    $producto[1],
                    $producto[2],
                    $producto[3],
                    $producto[4],
                    $producto[5]
                );
                array_push($listaProductos, $productoAux);
            }
        }

        return $listaProductos;
    }


    public static function ActualizarStock(Producto $producto)
    {
        $productosExistente = Producto::VerificarExistencia($producto['id']);

        if($productosExistente == null)
        {
            $productosJson = Producto::AltaProducto($producto);
        }
        else
        {

        }

        file_put_contents("productos.json",json_encode($productosJson));
    }

    public static function VerificarExistencia($id)
    {
        $banderaComprobacion = null;
        if($id != null && file_exists('productos.json'))
        {
            $productosJson = json_decode(file_get_contents("productos.json"),true);

            foreach ($productosJson as $indice => $producto)
            {
                if(($producto[$indice][$id] == $id))
                {
                    $banderaComprobacion = $producto[$indice][$id];
                    break;
                }
            }
        }

        return $banderaComprobacion;
    }

    // public static function AgregarAlStockExistente($productoRecibido)
    // {
    //     $productosJson['stock'] += $productoRecibido->_stock;
    // }

    public function Equals($id)
    {
        return (int)$this->_id == (int)$id;
    }
}
