<?php

use SysSoftIntegra\Model\GuiaRemisionADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "reinicio") {
        GuiaRemisionADO::ReiniciarEnvio($_GET["idGuiaRemision"]);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

}