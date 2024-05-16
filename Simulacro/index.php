<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        switch ($_GET['accion']) {
            case "Heladeria_Alta":
                var_dump($_POST);
                if (
                    isset($_POST['sabor']) && isset($_POST['precio'])
                    && isset($_POST['tipo']) && isset($_POST['vaso'])
                    && isset($_POST['stock']) && isset($_FILES["image"])
                ) {
                    require_once 'Helado.php';
                    require_once 'HeladeriaAlta.php';

                    $sabor = $_POST['sabor'];
                    $precio = $_POST['precio'];
                    $tipo = $_POST['tipo'];
                    $vaso = $_POST['vaso'];
                    $stock = $_POST['stock'];
                    $destino = $_FILES["image"]["tmp_name"];

                    $helado = new Helado($sabor, $precio, $tipo, $vaso, $stock);

                    HeladeriaAlta::DeterminarAltaOActualizacion($helado);
                    HeladeriaAlta::subirImagenHelado($dgiestino, $helado);
                } else {
                    echo "if mal";
                }
                break;
            case "Consulta_Helado":
                if (
                    isset($_POST['sabor']) && isset($_POST['tipo'])
                ) {

                    require_once 'HeladoConsultar.php';

                    $sabor = $_POST['sabor'];
                    $tipo = $_POST['tipo'];

                    echo HeladoConsultar::VerificarExistencia($sabor, $tipo);
                } else {
                    echo "if mal";
                }

                break;
            case "Alta_Venta":
                if (
                    isset($_POST['email_usuario']) && isset($_POST['sabor'])&& isset($_POST['tipo'])
                    && isset($_POST['stock'])
                ) {
                    
                }
                else
                {
                    echo "Hola, else";
                }
                break;
        }

        break;
}
