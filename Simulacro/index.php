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
                    && isset($_FILES["image"]) && isset($_POST['vaso'])
                ) {
                    require_once 'HeladoConsultar.php';

                    $sabor = $_POST['sabor'];
                    $tipo = $_POST['tipo'];
                    $stock = intval($_POST['stock']);
                    $vaso = ($_POST['vaso']);
                    $email_usuario = $_POST['email_usuario'];
                    $destino = $_FILES["image"]["tmp_name"];


                    $resultado = HeladoConsultar::VerificarExistencia($sabor, $tipo, $stock);

                    if ($resultado == "Existe y hay stock") {
                        #TODO: Si no hay stock no restar
                        require_once 'AltaVenta.php';
                        require_once 'Utilidades.php';
                        require_once 'HeladeriaAlta.php';

                        $usuario = Utilidades::ObtenerUsuarioMail($email_usuario);
                        AltaVenta::EscribirVenta($usuario, $sabor, $vaso);
                        HeladeriaAlta::DescontarStockProducto($sabor, $tipo, $stock);
                        AltaVenta::subirImagenVenta($destino, $sabor, $tipo, $usuario);
                    }
                } else {
                    echo "Hola, else";
                }
            break;
        }
    break;
    case 'GET':
        switch ($_GET['accion']) {
            case "Consultar_Ventas":
                require_once 'ConsultarVentas.php';
                if (isset($_GET['fecha'])) 
                {
                    $fecha = $_GET['fecha'];
                    var_dump(ConsultarVentas::ObtenerVentasPorFecha($fecha, "ventas.json"));
                } 
                elseif(isset($_GET['usuario'])) {
                    $usuario = $_GET['usuario'];
                        var_dump(ConsultarVentas::ObtenerVentasPorUsuario($usuario,"ventas.json"));
                }
                elseif(isset($_GET['fechaUno']) && isset($_GET['fechaDos']))
                {
                    $fechaUno = $_GET['fechaUno'];
                    $fechaDos = $_GET['fechaDos'];

                    var_dump(ConsultarVentas::ObtenerVentasPorFechasOrdenadasNombre($fechaUno,$fechaDos,"ventas.json"));
                }
                break;
            default:
                echo "Acción no reconocida.";
                break;
        }
    break;
}
