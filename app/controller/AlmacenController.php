<?php

use SysSoftIntegra\Model\AlmacenADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "all") {
        print json_encode(AlmacenADO::ListarAlmacen($_GET["buscar"], $_GET["posicionPagina"], $_GET["filasPorPagina"]));
        exit();
    } else if ($_GET["type"] == "almacencombobox") {
        print json_encode(AlmacenADO::GetSearchComboBoxAlmacen());
        exit();
    } else if ($_GET["type"] == "getidalmacen") {
        print json_encode(AlmacenADO::Obtener_Almancen_Por_Id($_GET["idAlmacen"]));
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);

    if ($body["type"] == "crud") {
        print json_encode(AlmacenADO::CrudAlmacen($body));
        exit();
    } else if ($body["type"] == "delete") {
        print json_encode(AlmacenADO::DeleteAlmacen($body));
        exit();
    }
}
