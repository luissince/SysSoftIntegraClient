<?php
use SysSoftIntegra\Model\DashboardADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    print json_encode(DashboardADO::LoadDashboard(""));
    exit();
}
