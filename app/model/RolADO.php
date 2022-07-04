<?php

namespace SysSoftIntegra\Model;

use SysSoftIntegra\Src\Tools;
use SysSoftIntegra\DataBase\Database;
use PDO;
use Exception;

class RolADO
{

    function construct()
    {
    }

    public static function ListarRoles()
    {
        try {
            $cmdRol = Database::getInstance()->getDb()->prepare("SELECT * FROM RolTB");
            $cmdRol->execute();

            Tools::httpStatus200();
            return $cmdRol->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            Tools::httpStatus500();
            return $ex->getMessage();
        }
    }
}
