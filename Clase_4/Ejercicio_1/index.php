<?php

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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    # isset chequea que en postman el body tenga estas claves
    if (isset($_POST['nombre']) && isset($_POST['clave']) && isset($_POST['mail'])) {
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $mail = $_POST['mail'];
        $destino = $_FILES["image"]["tmp_name"];
        
        $usuario = new Usuario($nombre, $clave, $mail);

        $resultado = Usuario::AltaUsuario($usuario);

        $usuario->subirImagen($destino);
    }
}
