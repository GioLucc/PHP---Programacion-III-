<?php

class Usuario{
    private $_nombre;
    private $_clave;
    private $_mail;
    private $_id;
    private $_fechaDeRegistro;

    public function __construct($nombre, $clave, $mail, $id = null, $fechaDeRegistro = null)
    {
        $this->_nombre =$nombre;
        $this->_clave =$clave;
        $this->_mail =$mail;
        $this->_id = $id ?? rand(1, 10000);
        $this->_fechaDeRegistro = $fechaDeRegistro ?? date("d/m/Y");
        
    }

    public static function MostrarUsuario($usuario)
    {
        echo "Id: " . $usuario->_id . "<br>",
        "Nombre: " . $usuario->_nombre . "<br>",
        "Clave: " . $usuario->_clave . "<br>",
        "Mail: " . $usuario->_mail . "<br>";
        "Fecha de Registro: " . $usuario->_fechaDeRegistro . "<br><br>";
    }

    public static function VerificarUsuario($id)
    {
        $banderaExiste = false;

        if($id != null && file_exists("usuarios.json"))
        {
            $usuariosJson = json_decode(file_get_contents("usuarios.json"),true);

            foreach ($usuariosJson as $usuarioJson) {
                // Usuario que recibo creado, contra los usuarios del json decodeado
                if ($id == $usuarioJson['id']);
                $banderaExiste = $id;
                break;
            }
        }

        return $banderaExiste;
    }

    public static function AltaUsuario($usuario)
    {
        $usuarios = [];
        $retorno = false;
        
        if(file_exists('usuarios.json'))
        {
            $usuarios = json_decode(file_get_contents('usuarios.json'), true);
        }
        else
        {
            file_put_contents('usuarios.json', '[]');
        }   
        
        $nuevoUsuario = [
            
            'id' => $usuario->_id,
            'nombre' => $usuario->_nombre,
            'clave' => $usuario->_clave,
            'mail' => $usuario->_mail,
            'fechaDeRegistro' => $usuario->_fechaDeRegistro
            
        ];

        array_push($usuarios,$nuevoUsuario);
        $json = json_encode($usuarios);

        if(file_put_contents('usuarios.json', $json))
        {
            $retorno = true;
        }

        return $retorno;
    }

    public static function ActualizarUsuario(Usuario $usuario)
    {
        $banderaExiste = false;
        if(Usuario::VerificarUsuario($usuario['id']))
        {
            $banderaExiste = true;
        }
        else
        {
            Usuario::AltaUsuario($usuario);
        }

        if ($banderaExiste)
            echo "El usuario ya existe.";

        return $banderaExiste;

    }

    public function subirImagen($imagenTmpPath)
    {
        $retorno = false;
        $carpetaDestino = __DIR__ . '/Usuario/Fotos/';
        $nombreImagen = $this->_id . '_' . $this->_nombre . '.png';

        if (move_uploaded_file($imagenTmpPath, $carpetaDestino . $nombreImagen)) 
        {
            $retorno = true;
        }
        
        return $retorno;
        
    }

    public static function LeerUsuario()
    {
        $listaUsuarios = [];
        if(file_exists('usuarios.json'))
        {
            $usuariosLeidos = json_decode(file_get_contents('usuarios.json'),true);
            foreach ($usuariosLeidos as $usuario) {
                $usuarioAux = new Usuario(
                    $usuario['nombre'],
                    $usuario['clave'],
                    $usuario['mail'],
                    $usuario['id'],
                    $usuario['fechaDeRegistro']
                );

                array_push($listaUsuarios,$usuarioAux);
            }
        }

        return $listaUsuarios;
    }

    public function Equals($id)
    {
        return (int)$this->_id == (int)$id;
    }
}


?>