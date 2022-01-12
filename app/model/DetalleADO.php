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

    public static function Listar_Mantenimiento(string $value)
    {
        try {

            $cmdMantenimiento  = Database::getInstance()->getDb()->prepare("{call Sp_List_Table_Matenimiento(?)}");
            $cmdMantenimiento->bindParam(1, $value, PDO::PARAM_STR);
            $cmdMantenimiento->execute();
            return $cmdMantenimiento->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public static function Listar_Detalle_ById(string $idMantenimiento, string $search)
    {
        try {
            $cmdDetalle = Database::getInstance()->getDb()->prepare("{call Sp_List_Table_Detalle(?,?)}");
            $cmdDetalle->bindParam(1, $idMantenimiento, PDO::PARAM_STR);
            $cmdDetalle->bindParam(2, $search, PDO::PARAM_STR);
            $cmdDetalle->execute();
            return $cmdDetalle->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function GetDetailIdName($value)
    {
        try {
            $comando = Database::getInstance()->getDb()->prepare("{CALL Sp_Get_Detalle_IdNombre(?,?,?)}");
            $comando->bindParam(1, $value[0], PDO::PARAM_STR);
            $comando->bindParam(2, $value[1], PDO::PARAM_STR);
            $comando->bindParam(3, $value[2], PDO::PARAM_STR);
            $comando->execute();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return  $comando->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }

    public static function GetDetailId($value)
    {
        try {
            $comando = Database::getInstance()->getDb()->prepare("{CALL Sp_Get_Detalle_Id(?)}");
            $comando->bindParam(1, $value, PDO::PARAM_STR);
            $comando->execute();
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return  $comando->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }

    public static function CategoriasParaProductos()
    {
        try {
            $cmdDatalle = Database::getInstance()->getDb()->prepare("SELECT 
            d.IdDetalle,
            d.Nombre,
            count(d.IdDetalle) AS Cantidad 
            FROM DetalleTB AS d 
            INNER JOIN SuministroTB AS s ON s.Categoria = d.IdDetalle
            WHERE d.IdMantenimiento = '0006'
            GROUP BY d.IdDetalle,d.Nombre");
            $cmdDatalle->execute();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return  $cmdDatalle->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }

    public static function MarcasParaProductos()
    {
        try {
            $cmdDatalle = Database::getInstance()->getDb()->prepare("SELECT 
            d.IdDetalle,
            d.Nombre,
            count(d.IdDetalle) AS Cantidad 
            FROM DetalleTB AS d 
            INNER JOIN SuministroTB AS s ON s.Marca = d.IdDetalle
            WHERE d.IdMantenimiento = '0007'
            GROUP BY d.IdDetalle,d.Nombre");
            $cmdDatalle->execute();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return  $cmdDatalle->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }
}
