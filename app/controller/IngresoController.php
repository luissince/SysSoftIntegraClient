<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use SysSoftIntegra\Model\IngresoADO;

require __DIR__ . './../src/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "lista") {
        echo json_encode(IngresoADO::ListarIngresos(intval($_GET["posicionPagina"]), intval($_GET["filasPorPagina"])));
    } else if ($_GET["type"] == "listaCliente") {
        echo json_encode(IngresoADO::ListarClientes());
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    if ($body["type"] == "insert") {
        echo json_encode(IngresoADO::InsertIngreso($body));
    }
}
