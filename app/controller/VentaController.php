<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use SysSoftIntegra\Model\VentasADO;

require __DIR__ . './../src/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "venta") {
        $opcion = $_GET['opcion'];
        $busqueda = $_GET['busqueda'];
        $fechaInicial = $_GET['fechaInicial'];
        $fechaFinal = $_GET['fechaFinal'];
        $comprobante = $_GET['comprobante'];
        $estado = $_GET['estado'];
        $facturacion = $_GET['facturacion'];
        $posicionPagina = $_GET['posicionPagina'];
        $filasPorPagina = $_GET['filasPorPagina'];
        print json_encode(VentasADO::ListVentas($opcion, $busqueda, $fechaInicial, $fechaFinal, intval($comprobante), intval($estado), boolval($facturacion), $posicionPagina, $filasPorPagina));
        exit();
    } else if ($_GET["type"] == "allventa") {
        print json_encode(VentasADO::ListVentaDetalle($_GET['idVenta']));
        exit();
    } else if ($_GET["type"] == "getventanotacredito") {
        print json_encode(VentasADO::ListarComprobanteParaNotaCredito($_GET['comprobante']));
        exit();
    } else if ($_GET["type"] == "listaNotaCredito") {
        $opcion = $_GET["opcion"];
        $buscar = $_GET["search"];
        $fechaInicio = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];
        $posicionPagina = $_GET["posicionPagina"];
        $filasPorPagina = $_GET["filasPorPagina"];
        print json_encode(VentasADO::ListaNotaCredito($opcion, $buscar, $fechaInicio, $fechaFinal, $posicionPagina, $filasPorPagina));
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
        $posicionPagina = $_GET['posicionPagina'];
        $filasPorPagina = $_GET['filasPorPagina'];
        print json_encode(VentasADO::ListarDetalleNotificaciones(intval($posicionPagina), intval($filasPorPagina)));
        exit();
    } else if ($_GET["type"] == "global") {
        $data = VentasADO::LoadDashboard($_GET["fechaActual"]);
        $productoAgotados = VentasADO::LoadProductosAgotados(intval($_GET["posicionPaginaAgotados"]), intval($_GET["filasPorPaginaAgotados"]));
        $productosPorAgotarse = VentasADO::LoadProductosPorAgotarse(intval($_GET["posicionPaginaPorAgotarse"]), intval($_GET["filasPorPaginaPorAgotarse"]));
        if (is_array($data) && is_array($productoAgotados) && is_array($productosPorAgotarse)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $data,
                "productosAgotadosLista" => $productoAgotados[0],
                "productosAgotadosTotal" => $productoAgotados[1],
                "productoPorAgotarseLista" => $productosPorAgotarse[0],
                "productoPorAgotarseTotal" => $productosPorAgotarse[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "message" => $data,
            ));
        }
        exit();
    } else if ($_GET["type"] == "productosAgotados") {
        print json_encode(VentasADO::LoadProductosAgotados(intval($_GET["posicionPaginaAgotados"]), intval($_GET["filasPorPaginaAgotados"])));
        exit();
    } else if ($_GET["type"] == "productosPorAgotarse") {
        print json_encode(VentasADO::LoadProductosPorAgotarse(intval($_GET["posicionPaginaPorAgotarse"]), intval($_GET["filasPorPaginaPorAgotarse"])));
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    if ($body == "crudnotacredito") {
        print json_encode(VentasADO::RegistrarNotaCredito($body));
    }
}
