<?php

namespace SysSoftIntegra\Model;

use Database;
use PDO;
use PDOException;
use Exception;
use DateTime;

require_once __DIR__ . './../database/DataBaseConexion.php';

class MonedaADO
{

    function __construct()
    {
    }

    public static function GetMonedasCombBox()
    {
        try {
            $comando = Database::getInstance()->getDb()->prepare("SELECT IdMoneda,Nombre,Simbolo,Predeterminado FROM MonedaTB");
            $comando->execute();
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return $comando->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }
}
