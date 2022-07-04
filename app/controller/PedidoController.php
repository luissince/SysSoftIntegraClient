<?php
use SysSoftIntegra\Model\PedidoADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);

    if ($body["type"] == "webpedido") {
        print json_encode(PedidoADO::RegistrarWeb($body));
        exit();
    }
}
