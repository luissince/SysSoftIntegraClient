<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use SysSoftIntegra\Model\AlmacenADO;

require __DIR__ . './../src/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "almacencombobox") {
        print json_encode(AlmacenADO::GetSearchComboBoxAlmacen());
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}
