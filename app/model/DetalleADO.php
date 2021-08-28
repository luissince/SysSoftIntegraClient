<?php

namespace SysSoftIntegra\Model;

use Database;
use PDO;
use PDOException;
use Exception;
use DateTime;

require_once __DIR__ . './../database/DataBaseConexion.php';


class DetalleADO
{

    function construct()
    {
    }

    public static function GetDetailIdName($value)
    {
        try {
            $comando = Database::getInstance()->getDb()->prepare("{CALL Sp_Get_Detalle_IdNombre(?,?,?)}");
            $comando->bindParam(1, $value[0], PDO::PARAM_STR);
            $comando->bindParam(2, $value[1], PDO::PARAM_STR);
            $comando->bindParam(3, $value[2], PDO::PARAM_STR);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
