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
                return $resultCliente;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
