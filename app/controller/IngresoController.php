<?php
use SysSoftIntegra\Model\IngresoADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';
new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "listaIngreso") {
        echo json_encode(IngresoADO::ListarIngresos($_GET["opcion"], $_GET["buscar"], $_GET["fechaInicio"], $_GET["fechaFin"], $_GET["posicionPagina"], $_GET["filasPorPagina"]));
        exit();
    } else if ($_GET["type"] == "listaSalidas") {
        echo json_encode(IngresoADO::ListarSalidas($_GET["opcion"], $_GET["buscar"], $_GET["fechaInicio"], $_GET["fechaFin"], $_GET["posicionPagina"], $_GET["filasPorPagina"]));
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    if ($body["type"] == "insert") {
        echo json_encode(IngresoADO::InsertIngreso($body));
        exit();
    }
}
