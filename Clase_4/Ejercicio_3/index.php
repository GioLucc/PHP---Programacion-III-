<?php

require "Producto.php";
// Aplicación No 22 ( Login)
// Archivo: Login.php
// método:POST
// Recibe los datos del usuario(clave,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado, Retorna
// un :
// “Verificado” si el usuario existe y coincide la clave también.
// “Error en los datos” si esta mal la clave.
// “Usuario no registrado si no coincide el mail“
// Hacer los métodos necesarios en la clase usuario.


switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_POST['nombre']) && isset($_POST['tipo'])
        && isset($_POST['stock']) && isset($_POST['precio'])){
            $nombre = $_POST['nombre'];
            $tipo = $_POST['tipo'];
            $stock = $_POST['stock'];
            $precio = $_POST['precio'];

            $producto = new Producto($nombre, $tipo, $stock, $precio,3);

            Producto::ActualizarStock($producto);
            
            if ($resultado) {
                echo "Se hizo correctamente";
            }
        }
        break;
    case 'GET':
        switch ($_GET['accion']) {
            case 'Leer':
                Producto::LeerProducto();
        }
}
