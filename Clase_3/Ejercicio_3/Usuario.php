<?php

class Usuario{
    private $_nombre;
    private $_clave;
    private $_mail;

    public function __construct($nombre, $clave, $mail)
    {
        $this->_nombre =$nombre;
        $this->_clave =$clave;
        $this->_mail =$mail;
        
    }

    public static function MostrarUsuario($usuario)
    {
        echo "Nombre: " . $usuario->_nombre . "<br>",
        "Clave: " . $usuario->_clave . "<br>",
        "Mail: " . $usuario->_mail . "<br><br>";
    }

    public static function AltaUsuario($usuario)
    {
        $archivoUsuario = fopen("usuarios.csv", "a");

        $stringUsuario = $usuario->_nombre . "," . $usuario->_clave . "," . $usuario->_mail . "\n";

        fwrite($archivoUsuario,$stringUsuario);

        fclose($archivoUsuario);
    }

    public static function LeerUsuario()
    {
        $arrayUsuarios = array();
        $archivoUsuario = fopen("usuarios.csv", "r");

        while(!feof($archivoUsuario))
        {
            $linea = fgets($archivoUsuario);
            # devuelve la linea separadita por sus cutters
            $arrayLinea = explode(",", $linea);
            if (count($arrayLinea) == 3) {

                $usuarioAux = new Usuario($arrayLinea[0],$arrayLinea[1],$arrayLinea[2]);
                array_push($arrayUsuarios,$usuarioAux);
            }
        }
        fclose($archivoUsuario);
        return $arrayUsuarios;
    }
}


?>