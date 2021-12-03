<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use SysSoftIntegra\Model\CotizacionADO;

require __DIR__ . './../src/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "all") {
        print json_encode(CotizacionADO::ListarCotizacion($_GET["opcion"], $_GET["buscar"], $_GET["fechaInicial"], $_GET["fechaFinal"], $_GET["posicionPagina"], $_GET["filasPorPagina"]));
        exit();
    } else if ($_GET["type"] == "cotizacionventa") {
        print json_encode(CotizacionADO::CargarCotizacionVenta($_GET["idCotizacion"]));
        exit();
    }
}
