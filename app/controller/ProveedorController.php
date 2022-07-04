<?php
use SysSoftIntegra\Model\ProveedorADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "allproveedores") {
        print json_encode(ProveedorADO::ListProveedor($_GET["nombre"], $_GET["posicionPagina"], $_GET["filasPorPagina"]));
    } else if ($_GET["type"] == "GetByIdProveedor") {
        print json_encode(ProveedorADO::GetByIdProveedor($_GET["idProveedor"]));
    } else if ($_GET["type"] == "fillproveedor") {
        print json_encode(ProveedorADO::FillProveedor($_GET["search"]));
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    if ($body["type"] == "crudProveedor") {
        print json_encode(ProveedorADO::CrudProveedor($body));
    } else if ($body["type"] == "deleteProveedor") {
        print json_encode(ProveedorADO::DeleteProveedor($body));
    }
}
