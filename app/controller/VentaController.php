<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use SysSoftIntegra\Model\VentasAdo;

require __DIR__ . './../src/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "venta") {
        $opcion = $_GET['opcion'];
        $busqueda = $_GET['busqueda'];
        $fechaInicial = $_GET['fechaInicial'];
        $fechaFinal = $_GET['fechaFinal'];
        $estado = $_GET['estado'];
        $empleado = $_GET['empleado'];
        $posicionPagina = $_GET['posicionPagina'];
        $filasPorPagina = $_GET['filasPorPagina'];
        $ventas = VentasAdo::ListVentas($opcion, $busqueda, $fechaInicial, $fechaFinal, 0, intval($estado), $empleado, $posicionPagina, $filasPorPagina, '');
        if (is_array($ventas)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $ventas[0],
                "total" => $ventas[1],
                "suma" => $ventas[2]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $ventas
            ));
        }
        exit();
    } else if ($_GET["type"] == "allventa") {
        $detallle = VentasAdo::ListVentaDetalle($_GET['idVenta']);
        if (is_array($detallle)) {
            print json_encode(array(
                "estado" => 1,
                "venta" => $detallle[0],
                "ventadetalle" => $detallle[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $detallle
            ));
        }
    } else if ($_GET["type"] == "getventanotacredito") {
        $result = VentasAdo::ListarComprobanteParaNotaCredito($_GET['comprobante']);
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "notaCredito" => $result[0],
                "monedas" => $result[1],
                "tipoComprobante" => $result[2],
                "motivoAnulacion" => $result[3],
                "tipoDocumento" => $result[4],
                "venta" => $result[5],
                "detalle" => $result[6]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $result
            ));
        }
    } else if ($_GET["type"] == "listaNotaCredito") {
        $opcion = $_GET["opcion"];
        $buscar = $_GET["search"];
        $fechaInicio = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];
        $posicionPagina = $_GET["posicionPagina"];
        $filasPorPagina = $_GET["filasPorPagina"];
        $notacredito = VentasAdo::ListaNotaCredito($opcion, $buscar, $fechaInicio, $fechaFinal, $posicionPagina, $filasPorPagina);
        if (is_array($notacredito)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $notacredito[0],
                "total" => $notacredito[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $notacredito
            ));
        }
    } else if ($_GET["type"] == "listarNotificaciones") {
        $result = VentasAdo::ListarNotificaciones();
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $result
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $result
            ));
        }
    } else if ($_GET["type"] == "getproductosvendidos") {
        $producto = VentasAdo::ResumenProductoVendidos($_GET["fechaInicio"], $_GET["fechaFinal"], intval($_GET["marca"]), intval($_GET["categoria"]));
        if (is_array($producto)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $producto
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $producto
            ));
        }
        exit();
    } else if ($_GET["type"] == "detalleid") {
        $result = VentasAdo::GetDetalleId($_GET["idMantenimiento"]);
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $result
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $result
            ));
        }
    } else if ($_GET["type"] == "listarDetalleNotificaciones") {
        $posicionPagina = $_GET['posicionPagina'];
        $filasPorPagina = $_GET['filasPorPagina'];
        $result = VentasAdo::ListarDetalleNotificaciones(intval($posicionPagina), intval($filasPorPagina));
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $result[0],
                "total" => $result[1],
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $result
            ));
        }
    } else if ($_GET["type"] == "global") {
        $data = VentasAdo::LoadDashboard($_GET["fechaActual"]);
        $productoAgotados = VentasAdo::LoadProductosAgotados(intval($_GET["posicionPaginaAgotados"]), intval($_GET["filasPorPaginaAgotados"]));
        $productosPorAgotarse = VentasAdo::LoadProductosPorAgotarse(intval($_GET["posicionPaginaPorAgotarse"]), intval($_GET["filasPorPaginaPorAgotarse"]));
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
    } else if ($_GET["type"] == "productosAgotados") {
        $productoAgotados = VentasAdo::LoadProductosAgotados(intval($_GET["posicionPaginaAgotados"]), intval($_GET["filasPorPaginaAgotados"]));
        if (is_array($productoAgotados)) {
            print json_encode(array(
                "estado" => 1,
                "productosAgotadosLista" => $productoAgotados[0],
                "productosAgotadosTotal" => $productoAgotados[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "message" => $productoAgotados,
            ));
        }
    } else if ($_GET["type"] == "productosPorAgotarse") {
        $productosPorAgotarse = VentasAdo::LoadProductosPorAgotarse(intval($_GET["posicionPaginaPorAgotarse"]), intval($_GET["filasPorPaginaPorAgotarse"]));
        if (is_array($productosPorAgotarse)) {
            print json_encode(array(
                "estado" => 1,
                "productoPorAgotarseLista" => $productosPorAgotarse[0],
                "productoPorAgotarseTotal" => $productosPorAgotarse[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "message" => $productoAgotados,
            ));
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    if ($body == "crudnotacredito") {
        $result = VentasAdo::RegistrarNotaCredito($body);
        if ($result == "registrado") {
            print json_encode(array(
                "estado" => 1,
                "message" => "Se registro correctamente la nota de crédito."
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "message" => $result
            ));
        }
    }
}
