<?php

namespace SysSoftIntegra\Model;

use SysSoftIntegra\DataBase\Database;
use PDO;
use PDOException;
use Exception;

class ComprobanteADO
{

    function __construct()
    {
    }

    public static function GetSerieNumeracionEspecifico($idTipoDocumento)
    {
        try {
            $comando = Database::getInstance()->getDb()->prepare("SELECT dbo.Fc_Serie_Numero(?);");
            $comando->bindParam(1, $idTipoDocumento, PDO::PARAM_INT);
            $comando->execute();
            return explode("-", $comando->fetchColumn());
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
