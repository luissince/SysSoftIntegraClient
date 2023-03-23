<?php

use SysSoftIntegra\Model\VentasADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "venta") {
        $opcion = $_GET['opcion'];
        $busqueda = $_GET['busqueda'];
        $fechaInicial = $_GET['fechaInicial'];
        $fechaFinal = $_GET['fechaFinal'];
        $comprobante = $_GET['comprobante'];
        $estado = $_GET['estado'];
        $posicionPagina = $_GET['posicionPagina'];
        $filasPorPagina = $_GET['filasPorPagina'];
        VentasADO::ListVentas($opcion, $busqueda, $fechaInicial, $fechaFinal, $comprobante, $estado, $posicionPagina, $filasPorPagina);
        exit();
    } else if ($_GET["type"] == "ventadetalle") {
        VentasADO::ListVentaDetalle($_GET['idVenta']);
        exit();
    } else if ($_GET["type"] == "listComprobantes") {
        $opcion = $_GET['opcion'];
        $busqueda = $_GET['busqueda'];
        $fechaInicial = $_GET['fechaInicial'];
        $fechaFinal = $_GET['fechaFinal'];
        $comprobante = $_GET['comprobante'];
        $estado = $_GET['estado'];
        $posicionPagina = $_GET['posicionPagina'];
        $filasPorPagina = $_GET['filasPorPagina'];
        print json_encode(VentasADO::ListComprobantes(intval($opcion), $busqueda,  $fechaInicial, $fechaFinal, intval($comprobante), intval($estado), intval($posicionPagina), intval($filasPorPagina)));
        exit();
    } else if ($_GET["type"] == "getventanotacredito") {
        print json_encode(VentasADO::ListarComprobanteParaNotaCredito($_GET['comprobante']));
        exit();
    } else if ($_GET["type"] == "listarNotificaciones") {
        print json_encode(VentasADO::ListarNotificaciones());
        exit();
    } else if ($_GET["type"] == "getproductosvendidos") {
        print json_encode(VentasADO::ResumenProductoVendidos($_GET["fechaInicio"], $_GET["fechaFinal"], intval($_GET["marca"]), intval($_GET["categoria"])));
        exit();
    } else if ($_GET["type"] == "detalleid") {
        print json_encode(VentasADO::GetDetalleId($_GET["idMantenimiento"]));
        exit();
    } else if ($_GET["type"] == "listarDetalleNotificaciones") {
        print json_encode(VentasADO::ListarDetalleNotificaciones(intval($_GET['posicionPagina']), intval($_GET['filasPorPagina'])));
        exit();
    } else if ($_GET["type"] == "ventasEchas") {
        VentasADO::ListVentasMostrarLibres(
            $_GET["tipo"],
            intval($_GET["opcion"]),
            $_GET["buscar"],
            $_GET["empleado"],
            intval($_GET["posicionPagina"]),
            intval($_GET["filasPorPagina"])
        );
    } else if ($_GET["type"] == "ventaAgregar") {
        VentasADO::VentaAgregarTerminar($_GET["idVenta"]);
    } else if ($_GET["type"] == "listComprobantesExternal") {
        VentasADO::ListCpeComprobantesExternal();
    }
    if ($_GET["type"] == "reinicio") {
        VentasADO::ReiniciarEnvio($_GET["idVenta"]);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    if ($body["type"] == "crudnotacredito") {
        print json_encode(VentasADO::RegistrarNotaCredito($body));
        exit();
    } else if ($body["type"] == "crudventa" && $body["Estado"] == 1) {
        print json_encode(VentasADO::RegistrarVentaContado($body));
        exit();
    } else if ($body["type"] == "crudventa" && $body["Estado"] == 2) {
        print json_encode(VentasADO::RegistrarVentaCredito($body));
        exit();
    } else if ($body["type"] == "crudventa" && $body["Estado"] == 4) {
        print json_encode(VentasADO::RegistrarVentaAdelantado($body));
        exit();
    } else if ($body["type"] == "anularventa") {
        print json_encode(VentasADO::AnularVenta($body));
        exit();
    }
}
