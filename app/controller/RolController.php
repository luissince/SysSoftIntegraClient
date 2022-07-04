<?php
use SysSoftIntegra\Model\RolADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "listarol") {
        print json_encode(RolADO::ListarRoles());
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}
