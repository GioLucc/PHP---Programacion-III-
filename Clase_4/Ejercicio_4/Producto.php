<?php

class Producto{
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
        $this->_codigoDeBarras = $codigoDeBarras ?? rand(100000, 999999);;
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
        $retorno = false;
        $listaProductos = Producto::LeerProducto();
    
        $nuevoProducto = [
            'nombre' => $producto->_nombre,
            'tipo' => $producto->_tipo,
            'stock' => $producto->_stock,
            'precio' => $producto->_precio,
            'id' => $producto->_id,
            'codigoDeBarra' => $producto->_codigoDeBarras
        ];
    
        array_push($listaProductos, $nuevoProducto);
    
        $productosJson = json_encode($listaProductos);
    
        if (!file_exists('productos.json')) {
            file_put_contents('productos.json', '[]');
            echo "Se crea el vacio";
        }
    
        if (file_put_contents('productos.json', $productosJson)) {
            $retorno = true;
            
        }
    
        return $retorno;
    }

    public static function LeerProducto()
    {
        $listaProductos = [];
        if(file_exists('productos.json'))
        {
            $productosLeidos = json_decode(file_get_contents('productos.json'),true);

            var_dump($productosLeidos);
            var_dump("Entre al leer");
            
            foreach ($productosLeidos as $producto) 
            {
                $productoAux = new Producto(
                    $producto['nombre'],
                    $producto['tipo'],
                    $producto['stock'],
                    $producto['precio'],
                    $producto['id'],
                    $producto['codigoDeBarra']
                );
                array_push($listaProductos,$productoAux);
            }
        }

        return $listaProductos;
    }
}


?>