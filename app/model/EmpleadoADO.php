<?php

namespace SysSoftIntegra\Model;

use Database;
use PDO;
use PDOException;
use Exception;
use DateTime;

require_once __DIR__ . './../database/DataBaseConexion.php';


class EmpleadoADO
{

    function construct()
    {
    }

    public static function Login($usuario, $clave)
    {
        try {
            $cmdLogin = Database::getInstance()->getDb()->prepare("{CALL Sp_Validar_Ingreso(?,?)}");
            $cmdLogin->bindParam(1, $usuario, PDO::PARAM_STR);
            $cmdLogin->bindParam(2, $clave, PDO::PARAM_STR);
            $cmdLogin->execute();
            $resultLogin = $cmdLogin->fetchObject();
            return $resultLogin;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }



    public static function GetClientePredetermined()
    {
        try {
            $comando = Database::getInstance()->getDb()->prepare("SELECT ci.IdCliente,ci.TipoDocumento,ci.Informacion, ci.NumeroDocumento, ci.Celular,ci.Email,ci.Direccion FROM ClienteTB AS ci WHERE Predeterminado = 1");
            $comando->execute();
            $resultCliente = $comando->fetchObject();
            if ($resultCliente) {
                $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
                header($protocol . ' ' . 200 . ' ' . "OK");

                return $resultCliente;
            } else {
                $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
                header($protocol . ' ' . 200 . ' ' . "OK");

                return null;
            }
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }

    public static function GetListEmpleados()
    {
        try {

            $cmdEmpleados = Database::getInstance()->getDb()->prepare("SELECT IdEmpleado,Apellidos,Nombres FROM EmpleadoTB");
            $cmdEmpleados->execute();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return $cmdEmpleados->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }

    public static function FillEmpleados($search)
    {
        try {
            $cmdCliente = Database::getInstance()->getDb()->prepare("SELECT 
            IdEmpleado,
            NumeroDocumento,
            CONCAT(Apellidos,', ',Nombres) AS Informacion            
            FROM EmpleadoTB
            WHERE 
            ? <> '' AND NumeroDocumento LIKE CONCAT(?,'%') 
            OR 
            ? <> '' AND Apellidos LIKE CONCAT(?,'%')
            OR 
            ? <> '' AND Nombres LIKE CONCAT(?,'%')
            ");
            $cmdCliente->bindParam(1, $search, PDO::PARAM_STR);
            $cmdCliente->bindParam(2, $search, PDO::PARAM_STR);
            $cmdCliente->bindParam(3, $search, PDO::PARAM_STR);
            $cmdCliente->bindParam(4, $search, PDO::PARAM_STR);
            $cmdCliente->bindParam(5, $search, PDO::PARAM_STR);
            $cmdCliente->bindParam(6, $search, PDO::PARAM_STR);
            $cmdCliente->execute();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return $cmdCliente->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");
            return $ex->getMessage();
        }
    }
}
