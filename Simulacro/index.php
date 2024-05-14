<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        switch ($_GET['accion']) {
            case "Heladeria_Alta":
                var_dump($_POST);
                if (isset($_POST['sabor']) && isset($_POST['precio'])
                    && isset($_POST['tipo']) && isset($_POST['vaso'])
                    && isset($_POST['stock']))
                {
                    require_once 'Helado.php';
                    require_once 'HeladeriaAlta.php';

                    $sabor = $_POST['sabor'];
                    $precio = $_POST['precio'];
                    $tipo = $_POST['tipo'];
                    $vaso = $_POST['vaso'];
                    $stock = $_POST['stock'];

                    $helado = new Helado($sabor,$precio,$tipo,$vaso,$stock);
            
                    ActualizarStock($helado);

                }
                else
                {
                    echo "if mal";
                }
                break;
            case "Consulta_Helado":
                if (
                    isset($_POST['nombre']) && isset($_POST['clave'])
                    && isset($_POST['mail'])
                ) {
                }

                break;
            case "Alta_Venta":
                if (
                    isset($_POST['codigo_de_barra']) && isset($_POST['id_usuario'])
                    && isset($_POST['cantidad'])
                ) {
                }
                break;
        }

        break;
}
