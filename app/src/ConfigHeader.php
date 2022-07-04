<?php

namespace SysSoftIntegra\Src;


class ConfigHeader{

    function __construct() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Content-Type: application/json; charset=UTF-8');
    }
}
