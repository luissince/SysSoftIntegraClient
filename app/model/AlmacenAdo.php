<?php

namespace SysSoftIntegra\Model;

use Database;
use PDO;
use PDOException;
use Exception;
use DateTime;

require_once __DIR__ . './../database/DataBaseConexion.php';


class AlmacenADO
{

    function construct()
    {
    }

    public static function GetSearchComboBoxAlmacen()
    {
        try {
            $array = array();
            array_push($array, array('IdAlmacen' => 0, "Nombre" => "TIENDA PRINCIPAL"));

            $cmdDetalle = Database::getInstance()->getDb()->prepare("SELECT IdAlmacen,Nombre FROM AlmacenTB");
            $cmdDetalle->execute();
            while ($row = $cmdDetalle->fetch()) {
                array_push($array, array(
                    "IdAlmacen" => $row["IdAlmacen"],
                    "Nombre" => $row["Nombre"]
                ));
            }
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
