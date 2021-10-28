<?php

namespace SysSoftIntegra\Model;

use Database;
use PDO;
use PDOException;
use Exception;
use DateTime;

require_once __DIR__ . './../database/DataBaseConexion.php';

class CotizacionADO
{

    function __construct()
    {
    }

    public static function ListarCotizacion(int $opcion, string $buscar, string $fechaInicio, string $fechaFinal, int $posicionPagina, int $filasPorPagina)
    {
        try {
            $array = array();

            $cotizacion = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Cotizacion(?,?,?,?,?,?)}");
            $cotizacion->bindParam(1, $opcion, PDO::PARAM_INT);
            $cotizacion->bindParam(2, $buscar, PDO::PARAM_STR);
            $cotizacion->bindParam(3, $fechaInicio, PDO::PARAM_STR);
            $cotizacion->bindParam(4, $fechaFinal, PDO::PARAM_STR);
            $cotizacion->bindParam(5, $posicionPagina, PDO::PARAM_INT);
            $cotizacion->bindParam(6, $filasPorPagina, PDO::PARAM_INT);
            $cotizacion->execute();
            $arrayCotizacion = array();
            $count = 0;
            while ($row = $cotizacion->fetch()) {
                $count++;
                array_push($arrayCotizacion, array(
                    "Id" => $count + $posicionPagina,
                    "IdCotizacion" => $row['IdCotizacion'],
                    "FechaCotizacion" => $row['FechaCotizacion'],
                    "HoraCotizacion" => $row['HoraCotizacion'],
                    "Apellidos" => $row['Apellidos'],
                    "Nombres" => $row['Nombres'],
                    "Informacion" => $row['Informacion'],
                    "SimboloMoneda" => $row['SimboloMoneda'],
                    "Total" => floatval($row['Total']),
                ));
            }

            $cotizacion = Database::getInstance()->getDb()->prepare("{call Sp_Listar_Cotizacion_Count(?,?,?,?)}");
            $cotizacion->bindParam(1, $opcion, PDO::PARAM_INT);
            $cotizacion->bindParam(2, $buscar, PDO::PARAM_STR);
            $cotizacion->bindParam(3, $fechaInicio, PDO::PARAM_STR);
            $cotizacion->bindParam(4, $fechaFinal, PDO::PARAM_STR);
            $cotizacion->execute();
            $resultTotal = $cotizacion->fetchColumn();

            array_push($array, $arrayCotizacion, $resultTotal);

            return $array;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
