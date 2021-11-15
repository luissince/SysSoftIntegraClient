<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use SysSoftIntegra\Model\DetalleADO;

require __DIR__ . './../src/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "detailname") {
        print json_encode(DetalleADO::GetDetailIdName(array($_GET["value1"], $_GET["value2"], $_GET["value3"])));
    } else if ($_GET["type"] == "detailid") {
        print json_encode(DetalleADO::GetDetailId($_GET["value"]));
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}
