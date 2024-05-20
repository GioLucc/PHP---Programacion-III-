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
                    && isset($_POST['nombre'])
                ) {
                    require_once 'HeladoConsultar.php';

                    $sabor = $_POST['sabor'];
                    $tipo = $_POST['tipo'];
                    $stock = intval($_POST['stock']);
                    $vaso = ($_POST['vaso']);
                    $emailUsuario = $_POST['email_usuario'];
                    $nombre = $_POST['nombre'];
                    $destino = $_FILES["image"]["tmp_name"];


                    $resultado = HeladoConsultar::VerificarExistencia($sabor, $tipo, $stock);
                    echo $resultado;

                    if ($resultado == "Existe y hay stock") {
                        #TODO: Si no hay stock no restar
                        require_once 'AltaVenta.php';
                        require_once 'Utilidades.php';
                        require_once 'HeladeriaAlta.php';

                        AltaVenta::EscribirVenta($emailUsuario, $sabor, $vaso,$tipo, $nombre, $stock);
                        $usuario = Utilidades::ObtenerUsuarioMail($emailUsuario);
                        HeladeriaAlta::DescontarStockProducto($sabor, $tipo, $stock);
                        AltaVenta::subirImagenVenta($destino, $sabor, $tipo,$vaso, $usuario);
                    }
                } else {
                    echo "Hola, else";
                }
                break;
            case "Devolver_Helado":
                if (
                    isset($_POST['numeroDePedido']) && isset($_POST['causaDevolucion']))
                    {
                        require_once 'Utilidades.php';
                        $numeroPedido = $_POST['numeroDePedido'];
                        // $destino = $_FILES["image"]["tmp_name"];
                        $causaDevolucion = $_POST['causaDevolucion'];

                        $resultadoExistencia = Utilidades::VerificarExistenciaEnArchivo($numeroPedido,"numeroDePedido","ventas.json");

                        echo $resultadoExistencia;

                        if($resultadoExistencia)
                        {
                            require_once "DevolverHelado.php";
                            require_once "CuponDescuento.php";
                            $idDevolucion = Utilidades::generarNumeroPedido();
                            $nuevoCupon = new CuponDescuento(10,$idDevolucion);
                            DevolverHelado::DevolverUnHelado($numeroPedido
                            ,$causaDevolucion,$idDevolucion);
                            CuponDescuento::RegistrarCupones($nuevoCupon);
                        }
                    }
                break;
        }
        break;
    case 'GET':
        switch ($_GET['accion']) {
            case "Consultar_Ventas":
                require_once 'ConsultarVentas.php';
                if (isset($_GET['fecha'])) {
                    $fecha = $_GET['fecha'];
                    var_dump(ConsultarVentas::ObtenerVentasPorFecha($fecha, "ventas.json"));
                } elseif (isset($_GET['fechaUno']) && isset($_GET['fechaDos'])) {
                    $fechaUno = $_GET['fechaUno'];
                    $fechaDos = $_GET['fechaDos'];

                    var_dump(ConsultarVentas::ObtenerVentasPorFechasOrdenadasNombre($fechaUno, $fechaDos, "ventas.json"));
                } elseif (isset($_GET['usuario'])) {
                    $usuario = $_GET['usuario'];
                    var_dump(ConsultarVentas::ObtenerVentasPorUsuario($usuario, "ventas.json"));
                } elseif (isset($_GET['sabor'])) {
                    $sabor = $_GET['sabor'];
                    var_dump(ConsultarVentas::ObtenerVentasPorSabor($sabor, "ventas.json"));
                } elseif (isset($_GET['vaso'])) {
                    $vaso = $_GET['vaso'];
                    var_dump(ConsultarVentas::ObtenerVentasPorVaso($vaso, "ventas.json"));
                }

                break;
            default:
                echo "Acción no reconocida.";
                break;
        }
        break;
    case 'PUT':
        switch ($_GET['accion']) {
            case "Modificar_Venta":
                //TODO: Ver como cambiar los GETS por PUTS o algo 
                parse_str(file_get_contents("php://input"), $_PUT);
                if (
                    isset($_GET['numeroDePedido']) && isset($_GET['emailUsuario']) && isset($_GET['nombre']) && isset($_GET['sabor']) &&
                    isset($_GET['tipo']) && isset($_GET['vaso']) 
                    && isset($_GET['stock'])
                ) {
                    $numeroPedido = $_GET['numeroDePedido'];
                    $emailUsuario = $_GET['emailUsuario'];
                    $nombre = $_GET['nombre'];
                    $tipo = $_GET['tipo'];
                    $vaso = $_GET['vaso'];
                    $stock = $_GET['stock'];
                    $sabor = $_GET['sabor'];

                    require_once 'ModificarVenta.php';
                    var_dump(ModificarVenta::ModificarUnaVenta($numeroPedido,$emailUsuario,$sabor,$tipo, $vaso, $stock,$nombre, "ventas.json"));
                } else {
                    echo "isset";
                }
            break;
        }
        break;
    case 'DELETE':
        switch ($_GET['accion']) {
            case "Borrar_Venta":
                if (isset($_GET['numeroDePedido']))
                    {
                        $numeroPedido = $_GET['numeroDePedido'];
                        require_once 'BorrarVenta.php';
                        $resultado = BorrarVenta::BorrarVenta($numeroPedido,"ventas.json");
                        if ($resultado == true)
                            echo "Borrado satisfactoriamente";

                    }

            break;
        }
        break;
}
