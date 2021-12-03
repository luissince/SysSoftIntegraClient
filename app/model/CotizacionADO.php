<?php

namespace SysSoftIntegra\Model;

use Database;
use PDO;
use PDOException;
use Exception;

require_once __DIR__ . './../database/DataBaseConexion.php';

class CotizacionADO
{

    function __construct()
    {
    }

    public static function ListarCotizacion(int $opcion, string $buscar, string $fechaInicio, string $fechaFinal, int $posicionPagina, int $filasPorPagina)
    {
        try {
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

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return array(
                "data" => $arrayCotizacion,
                "total" => $resultTotal,
            );
        } catch (PDOException $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }

    public static function CargarCotizacionVenta(string $idCotizacion)
    {
        try {

            $cmdCotizacion = Database::getInstance()->getDb()->prepare("{CALL Sp_Obtener_Cotizacion_ById(?)}");
            $cmdCotizacion->bindParam(1, $idCotizacion, PDO::PARAM_STR);
            $cmdCotizacion->execute();

            $arrayCotizacion = array();
            if ($row = $cmdCotizacion->fetch(PDO::FETCH_ASSOC)) {
                array_push($arrayCotizacion, array(
                    "IdCotizacion" => $row["IdCotizacion"],
                    "IdCliente" => $row["IdCliente"],
                    "TipoDocumento" => $row["TipoDocumento"],
                    "NumeroDocumento" => $row["NumeroDocumento"],
                    "Informacion" => $row["Informacion"],
                    "Celular" => $row["Celular"],
                    "Email" => $row["Email"],
                    "Direccion" => $row["Direccion"],
                    "IdMoneda" => $row["IdMoneda"],
                    "Observaciones" => $row["Observaciones"]
                ));

                $cmdDetalle = Database::getInstance()->getDb()->prepare("{CALL Sp_Obtener_Detalle_Cotizacion_ById(?)}");
                $cmdDetalle->bindParam(1, $idCotizacion, PDO::PARAM_STR);
                $cmdDetalle->execute();
                $arratDetalle = array();
                while ($rowd = $cmdDetalle->fetch(PDO::FETCH_OBJ)) {
                    array_push($arratDetalle, $rowd);
                }

                array_push($arrayCotizacion, $arratDetalle);
            }

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return $arrayCotizacion;
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }
}
