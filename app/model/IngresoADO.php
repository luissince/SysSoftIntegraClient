<?php

namespace SysSoftIntegra\Model;

use Database;
use PDO;
use PDOException;
use Exception;
use DateTime;

require_once __DIR__ . './../database/DataBaseConexion.php';


class IngresoADO
{

    function construct()
    {
    }

    public static function ListarIngresos($posicionPagina, $filasPorPagina)
    {
        try {

            $cmdIngreso = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Ingresos(?,?)}");
            $cmdIngreso->bindParam(1, $posicionPagina, PDO::PARAM_STR);
            $cmdIngreso->bindParam(2, $filasPorPagina, PDO::PARAM_STR);
            $cmdIngreso->execute();

            $count = 0;
            $resultIngreso = array();
            while ($row = $cmdIngreso->fetch()) {
                $count++;
                array_push($resultIngreso, array(
                    "Id" => $count + $posicionPagina,
                    "IdIngreso" => $row['IdIngreso'],
                    "Fecha" => $row['Fecha'],
                    "Hora" => $row['Hora'],
                    "Detalle" => $row['Detalle'],
                    "NumeroDocumento" => $row['NumeroDocumento'],
                    "Informacion" => $row['Informacion'],
                    "Procedencia" => $row['Procedencia'],
                    "Forma" => $row['Forma'],
                    "Monto" => floatval($row['Monto']),
                ));
            }


            $cmdIngreso = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Ingresos_Count()}");
            $cmdIngreso->execute();
            $totalIngreso = $cmdIngreso->fetchColumn();

            return array("estado" => 1, "data" => $resultIngreso, "total" => $totalIngreso);
        } catch (Exception $ex) {
            return array("estado" => 0, "message" => $ex->getMessage());
        }
    }

    public static function ListarClientes()
    {
        try {
            $cmdCliente = Database::getInstance()->getDb()->prepare("SELECT IdCliente,Informacion FROM ClienteTB");
            $cmdCliente->execute();
            return array("estado" => 1, "data" => $cmdCliente->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $ex) {
            return array("estado" => 0, "message" => $ex->getMessage());
        }
    }

    public static function InsertIngreso($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdValidate = Database::getInstance()->getDb()->prepare("INSERT INTO 
            IngresoTB(
            IdProcedencia,
            IdUsuario,
            IdCliente,
            Detalle,
            Procedencia,
            Fecha,
            Hora,
            Forma,
            Monto)
            VALUES(?,?,?,?,?,?,?,?,?)");
            $cmdValidate->execute(array(
                $body["idProcedencia"],
                $body["idUsuario"],
                $body["idCliente"],
                $body["detalle"],
                $body["procedencia"],
                $body["fecha"],
                $body["hora"],
                $body["forma"],
                $body["monto"],

            ));

            Database::getInstance()->getDb()->commit();
            return array("estado" => 1, "message" => "Se registró correctamente el Ingreso.");
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return array("estado" => 0, "message" => $ex->getMessage());
        }
    }
}
