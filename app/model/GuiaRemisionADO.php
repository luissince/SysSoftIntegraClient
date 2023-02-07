<?php

namespace SysSoftIntegra\Model;

use SysSoftIntegra\DataBase\Database;
use SysSoftIntegra\Src\Response;
use PDO;
use PDOException;
use Exception;

class GuiaRemisionADO
{

    function construct()
    {
    }

    public static function ListarDetalleGuiaRemisionPorId($idGuiaRemision)
    {
        try {

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}