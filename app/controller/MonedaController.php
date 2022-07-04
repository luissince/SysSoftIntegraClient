<?php
use SysSoftIntegra\Model\MonedaADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "all") {
        print json_encode(MonedaADO::Listar_Monedas($_GET["opcion"], $_GET["search"], $_GET["posicionPagina"], $_GET["filasPorPagina"]));
        exit();
    } else if ($_GET["type"] == "getmonedacombobox") {
        print json_encode(MonedaADO::GetMonedasComboBox());
        exit();
    } else if ($_GET["type"] == "getid") {
        print json_encode(MonedaADO::ObtenerMonedaById($_GET["idMoneda"]));
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);

    if ($body["type"] == "crud") {
        print json_encode(MonedaADO::CrudMoneda($body));
        exit();
    } else if ($body["type"] == "delete") {
        print json_encode(MonedaADO::RemoverMoneda($body));
        exit();
    }
}
