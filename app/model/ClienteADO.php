<?php

namespace SysSoftIntegra\Model;

use Database;
use PDO;
use PDOException;
use Exception;
use DateTime;

require_once __DIR__ . './../database/DataBaseConexion.php';


class ClienteADO
{

    function construct()
    {
    }

    public static function ListCliente($buscar, $posicionPagina, $filasPorPagina)
    {
        try {
            $array = array();

            $comandoVenta = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Clientes(?,?,?)}");
            $comandoVenta->bindParam(1, $buscar, PDO::PARAM_STR);
            $comandoVenta->bindParam(2, $posicionPagina, PDO::PARAM_INT);
            $comandoVenta->bindParam(3, $filasPorPagina, PDO::PARAM_INT);
            $comandoVenta->execute();
            $arrayVenta = array();
            $count = 0;
            while ($row = $comandoVenta->fetch()) {
                $count++;
                array_push($arrayVenta, array(
                    "Id" => $count + $posicionPagina,
                    "IdCliente" => $row["IdCliente"],
                    "TipoDocumento" => $row["TipoDocumento"],
                    "NumeroDocumento" => $row["NumeroDocumento"],
                    "Informacion" => $row["Informacion"],
                    "Telefono" => $row["Telefono"],
                    "Celular" => $row["Celular"],
                    "Direccion" => $row["Direccion"],
                    "Representante" => $row["Representante"],
                    "Estado" => $row["Estado"],
                    "Predeterminado" => $row["Predeterminado"]
                ));
            }

            $comandoTotal = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Clientes_Count(?)}");
            $comandoTotal->bindParam(1, $buscar, PDO::PARAM_STR);
            $comandoTotal->execute();
            $resultTotal = $comandoTotal->fetchColumn();

            array_push($array, $arrayVenta, $resultTotal);
            return $array;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }
}
