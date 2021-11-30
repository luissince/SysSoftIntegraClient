<?php

namespace SysSoftIntegra\Model;

use Database;
use PDO;
use PDOException;
use Exception;
use DateTime;

require_once __DIR__ . './../database/DataBaseConexion.php';

class TipoDocumentoADO
{

    function __construct()
    {
    }

    public static function GetDocumentoCombBoxVentas()
    {
        try {
            $comando = Database::getInstance()->getDb()->prepare("SELECT IdTipoDocumento,Nombre,Serie, Predeterminado FROM TipoDocumentoTB WHERE Guia <> 1 AND NotaCredito <> 1");
            $comando->execute();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return $comando->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return  $ex->getMessage();
        }
    }

    public static function GetDocumentoCombBoxNotaCredito()
    {
        try {
            $comando = Database::getInstance()->getDb()->prepare("SELECT IdTipoDocumento,Nombre,Serie, Predeterminado FROM TipoDocumentoTB WHERE NotaCredito = 1");
            $comando->execute();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return $comando->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }

    public static function GetDocumentoFacturados()
    {
        try {
            $comando = Database::getInstance()->getDb()->prepare("SELECT 
            IdTipoDocumento,
            Nombre,
            Serie
            FROM TipoDocumentoTB WHERE Facturacion = 1");
            $comando->execute();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return $comando->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }
}
