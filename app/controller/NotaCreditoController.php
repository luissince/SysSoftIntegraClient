<?php
use SysSoftIntegra\Model\NotaCreditoADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "all") {
        $opcion = $_GET["opcion"];
        $buscar = $_GET["search"];
        $fechaInicio = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];
        $posicionPagina = $_GET["posicionPagina"];
        $filasPorPagina = $_GET["filasPorPagina"];
        print json_encode(NotaCreditoADO::ListaNotaCredito($opcion, $buscar, $fechaInicio, $fechaFinal, $posicionPagina, $filasPorPagina));
        exit();
    } else if ($_GET["type"] == "notacreditotalle") {
        print json_encode(NotaCreditoADO::ListarDetalleNotaCredito($_GET["idNotaCredito"]));
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}
