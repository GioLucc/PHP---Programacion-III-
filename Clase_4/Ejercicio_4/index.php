<?php

require "Producto.php";
require "Usuario.php";
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


switch($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        var_dump("Post");
        switch($_GET['accion'])
        {
            case "Alta_Producto":
                var_dump("Alta");
                if (isset($_POST['nombre']) && isset($_POST['tipo'])
                && isset($_POST['stock']) && isset($_POST['precio'])) 
                {
                    $nombre = $_POST['nombre'];     
                    $tipo = $_POST['tipo'];
                    $stock = $_POST['stock'];
                    $precio = $_POST['precio'];
                    
                    $producto = new Producto($nombre,$tipo,$stock,$precio);
                    var_dump($producto);

                    Producto::ActualizarStock($producto);
                    
                    if($resultado)
                    {
                        echo "Se hizo correctamente";
                    }
                }
            break;
            case "Alta_Usuario":
                if (isset($_POST['nombre']) && isset($_POST['clave']) 
                && isset($_POST['mail']))
                {
                    $nombre = $_POST['nombre'];
                    $clave = $_POST['clave'];
                    $mail = $_POST['mail'];
                    
                    $usuario = new Usuario($nombre, $clave, $mail,7691);
                    $resultado = Usuario::ActualizarUsuario($usuario); 
                }
                
            break;
            case "Realizar_Venta":
                if (isset($_POST['codigo_de_barra']) && isset($_POST['id_usuario']) 
                && isset($_POST['cantidad']))
                {

                    $idUsuario = $_POST['id_usuario'];

                    $existe = Usuario::VerificarUsuario($idUsuario); 
                    echo $existe;

                }
            break;
        }
        
    break;
}
