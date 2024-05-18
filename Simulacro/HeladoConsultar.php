<?php
Class HeladoConsultar
{
    public static function VerificarExistencia($sabor, $tipo, $stock = null)
    {
        $banderaSabor = false;
        $banderaTipo = false;
        $banderaStock = false;
        $banderaExiste = "No existe";
        if ($sabor != null && file_exists('heladeria.json')) {
            $productosJson = json_decode(file_get_contents("heladeria.json"), true);
    
            foreach ($productosJson as $producto) {
                if ($producto['sabor'] == $sabor)
                {
                    $banderaExiste = "Existe el sabor";
                    $banderaSabor = true;
                }

                if($producto['tipo'] == $tipo)
                {
                    $banderaTipo = true;
                    $banderaExiste = "Existe el tipo";
                }

                if($producto['stock'] >= $stock)
                {
                    $banderaStock = true;
                }
            }
    
            if($banderaSabor && $banderaTipo && $banderaStock)
            {
                $banderaExiste = "Existe y hay stock";
            }
            else
            {
                if($banderaSabor && $banderaTipo)
                {
                    $banderaExiste = "Existe";
                }
            }
        }
    
        return $banderaExiste;
    }
}

?>
