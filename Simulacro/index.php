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
                    require_once 'Utilidades.php';

                    $sabor = $_POST['sabor'];
                    $precio = floatval($_POST['precio']);
                    $tipo = $_POST['tipo'];
                    $vaso = $_POST['vaso'];
                    $stock = intval($_POST['stock']);
                    $destino = $_FILES["image"]["tmp_name"];

                    $helado = new Helado($sabor, $precio, $tipo, $vaso, $stock);

                    HeladeriaAlta::DeterminarAltaOActualizacion($helado);
                    HeladeriaAlta::subirImagenHelado($destino, $helado);

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
                    isset($_POST['email_usuario']) && isset($_POST['sabor'])
                    && isset($_POST['tipo']) && isset($_POST['stock'])
                    && isset($_FILES["image"])
                ) {
                    require_once 'HeladoConsultar.php';

                    $sabor = $_POST['sabor'];
                    $tipo = $_POST['tipo'];
                    $stock = intval($_POST['stock']);
                    $email_usuario = $_POST['email_usuario'];
                    $destino = $_FILES["image"]["tmp_name"];

                    $resultado = HeladoConsultar::VerificarExistencia($sabor, $tipo, $stock);

                    if ($resultado == "Existe y hay stock") {
                        #TODO: Si no hay stock no restar
                        require_once 'AltaVenta.php';
                        require_once 'HeladeriaAlta.php';

                        AltaVenta::EscribirVenta();
                        HeladeriaAlta::DescontarStockProducto($sabor, $tipo, $stock);
                        $usuario = Utilidades::ObtenerUsuarioMail($email_usuario);
                        AltaVenta::subirImagenVenta($destino,$sabor,$tipo,$usuario);

                    }
                } else {
                    echo "Hola, else";
                }
                break;
        }

        break;
}
