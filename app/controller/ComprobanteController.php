<?php

use SysSoftIntegra\Model\ComprobanteADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "getserienumeracion") {
        $result = ComprobanteADO::GetSerieNumeracionEspecifico($_GET["idTipoDocumento"]);
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $result,
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "message" => $result,
            ));
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}
