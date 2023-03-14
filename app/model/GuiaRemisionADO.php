<?php

namespace SysSoftIntegra\Model;

use SysSoftIntegra\DataBase\Database;
use SysSoftIntegra\Src\Response;
use PDO;
use PDOException;
use Exception;

class GuiaRemisionADO
{

    function construct()
    {
    }

    public static function ListarDetalleGuiaRemisionPorId(string $idGuiaRemision)
    {
        try {
            $cmdGuiaRemision = Database::getInstance()->getDb()->prepare("SELECT 
            gui.IdGuiaRemision,
            td.CodigoAlterno AS Codigo,
            gui.Serie,
            gui.Numeracion,
            gui.FechaRegistro,
            gui.HoraRegistro,
    
            ub1.Ubigeo as CodigoUbigeoPartida,
            gui.DireccionPartida,
            
            ub2.Ubigeo as CodigoUbigeoLlegada,
            gui.DireccionLlegada,
    
            mtd.IdAuxiliar AS CodigoMotivoTraslado,
            mtd.Nombre AS NombreMotivoTraslado,
    
            md.Codigo AS CodigoModalidadTraslado,
            md.Nombre AS NombreModalidadTraslado,

            mpc.IdAuxiliar AS CodigoPesoCarga,
            mpc.Nombre AS NombrePesoCarga,
            gui.PesoCarga,

            gui.FechaTraslado,
		    gui.HoraTraslado,

			ddc.IdAuxiliar AS CodigoConducto,
			con.NumeroDocumento AS NumeroDocumentoConducto,
			con.Informacion AS InformacionConducto,
			con.LicenciaConducir AS LicenciaConducirConducto,

            ISNULL(veh.NumeroPlaca, '') AS NumeroPlaca,
    
            tdv.CodigoAlterno AS CodigoComRl,
            vt.Serie AS SerieComRl,
            vt.Numeracion AS NumeracionComRl,		
            CONCAT(SUBSTRING(tdv.Nombre, 1, 1),'',LOWER(SUBSTRING(tdv.Nombre, 2, LEN(tdv.Nombre)))) AS NombreComRl,
            dd.IdAuxiliar AS CodigoCliRl,
            clv.NumeroDocumento AS NumeroCliRl,
            clv.Informacion AS InformacionCliRl,

            ISNULL(gui.NumeroTicketSunat,'') AS NumeroTicketSunat
            
            FROM GuiaRemisionTB  AS gui 
            INNER JOIN ClienteTB AS cl ON gui.IdCliente = cl.IdCliente
            INNER JOIN EmpleadoTB AS em ON em.IdEmpleado = gui.IdVendedor
            INNER JOIN UbigeoTB AS ub1 ON gui.IdUbigeoPartida = ub1.IdUbigeo
            INNER JOIN UbigeoTB AS ub2 ON gui.IdUbigeoLlegada = ub2.IdUbigeo
            INNER JOIN TipoDocumentoTB AS td ON td.IdTipoDocumento = gui.Comprobante
			INNER JOIN ModalidadTrasladoTB AS md ON md.IdModalidadTraslado = gui.IdModalidadTraslado
            INNER JOIN DetalleTB AS mtd ON mtd.IdDetalle = gui.IdMotivoTraslado AND mtd.IdMantenimiento = '0017'            
            INNER JOIN DetalleTB AS mpc ON mpc.IdDetalle = gui.IdPesoCarga AND mpc.IdMantenimiento = '0021'

			LEFT JOIN ConductorTB AS con ON con.IdConductor = gui.IdConductor
			INNER JOIN DetalleTB AS ddc ON ddc.IdDetalle = con.IdTipoDocumento AND ddc.IdMantenimiento = '0003'
			LEFT JOIN VehiculoTB AS veh ON veh.IdVehiculo = gui.IdVehiculo
    
            INNER JOIN VentaTB AS vt ON vt.IdVenta = gui.IdVenta
            INNER JOIN TipoDocumentoTB AS tdv ON tdv.IdTipoDocumento = vt.Comprobante
            INNER JOIN ClienteTB AS clv ON clv.IdCliente = vt.Cliente
            INNER JOIN DetalleTB AS dd ON dd.IdDetalle = clv.TipoDocumento AND dd.IdMantenimiento = '0003'
            WHERE gui.IdGuiaRemision = ?");
            $cmdGuiaRemision->bindParam(1, $idGuiaRemision, PDO::PARAM_STR);
            $cmdGuiaRemision->execute();
            $resultGuiaRemision = $cmdGuiaRemision->fetchObject();

            $cmdGuiaRemisionDetalle = Database::getInstance()->getDB()->prepare("SELECT
            gud.IdSuministro,
            gud.Codigo,
            gud.Descripcion,
            gud.Cantidad,
            gud.Peso,
            dm.IdAuxiliar AS CodigoMedida,
            dm.Nombre AS NombreMedida
            FROM 
            GuiaRemisionDetalleTB AS gud 
            INNER JOIN SuministroTB AS su ON su.IdSuministro = gud.IdSuministro
            INNER JOIN DetalleTB AS dm ON dm.IdDetalle = su.UnidadCompra AND dm.IdMantenimiento = '0013'
            WHERE gud.IdGuiaRemision = ?");
            $cmdGuiaRemisionDetalle->bindParam(1, $idGuiaRemision, PDO::PARAM_STR);
            $cmdGuiaRemisionDetalle->execute();
            $resultGuiaRemisionDetalle = $cmdGuiaRemisionDetalle->fetchAll(PDO::FETCH_CLASS);

            $cmdEmpresa = Database::getInstance()->getDb()->prepare("SELECT TOP 1 
            d.IdAuxiliar,
            e.NumeroDocumento,
            e.RazonSocial,
            e.Domicilio,
            e.UsuarioSol,
            e.ClaveSol,
            e.IdApiSunat,
            e.ClaveApiSunat
            FROM EmpresaTB AS e 
            INNER JOIN DetalleTB AS d ON e.TipoDocumento = d.IdDetalle AND d.IdMantenimiento = '0003'");
            $cmdEmpresa->execute();
            $resultEmpresa = $cmdEmpresa->fetchObject();

            return [
                "guiaremision" => $resultGuiaRemision,
                "guiaremisiondetalle" => $resultGuiaRemisionDetalle,
                "empresa" => $resultEmpresa
            ];
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function CambiarEstadoSunatGuiaRemision(string $idGuiaRemision, string $codigo, string $descripcion, string $hash, string $xmlgenerado, string $numeroTicket)
    {
        try {
            if ($xmlgenerado == "") {
                Database::getInstance()->getDb()->beginTransaction();
                $comando = Database::getInstance()->getDb()->prepare("UPDATE GuiaRemisionTB SET 
                Xmlsunat = ?, Xmldescripcion = ? WHERE IdGuiaRemision = ?");
                $comando->bindParam(1, $codigo, PDO::PARAM_STR);
                $comando->bindParam(2, $descripcion, PDO::PARAM_STR);
                $comando->bindParam(3, $idGuiaRemision, PDO::PARAM_STR);
                $comando->execute();
                Database::getInstance()->getDb()->commit();
            } else {
                Database::getInstance()->getDb()->beginTransaction();
                $comando = Database::getInstance()->getDb()->prepare("UPDATE GuiaRemisionTB SET 
                Xmlsunat = ?, Xmldescripcion = ?, CodigoHash = ?, Xmlgenerado = ?,NumeroTicketSunat = ? WHERE IdGuiaRemision = ?");
                $comando->bindParam(1, $codigo, PDO::PARAM_STR);
                $comando->bindParam(2, $descripcion, PDO::PARAM_STR);
                $comando->bindParam(3, $hash, PDO::PARAM_STR);
                $comando->bindParam(4, $xmlgenerado, PDO::PARAM_STR);
                $comando->bindParam(5, $numeroTicket, PDO::PARAM_STR);
                $comando->bindParam(6, $idGuiaRemision, PDO::PARAM_STR);
                $comando->execute();
                Database::getInstance()->getDb()->commit();
            }
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();          
        }
    }

    public static function CambiarEstadoSunatGuiaRemisionUnico(string $idGuiaRemision, string $codigo, string $descripcion)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $comando = Database::getInstance()->getDb()->prepare("UPDATE GuiaRemisionTB SET 
            Xmlsunat = ? , Xmldescripcion = ? WHERE IdGuiaRemision = ?");
            $comando->bindParam(1, $codigo, PDO::PARAM_STR);
            $comando->bindParam(2, $descripcion, PDO::PARAM_STR);
            $comando->bindParam(3, $idGuiaRemision, PDO::PARAM_STR);
            $comando->execute();
            Database::getInstance()->getDb()->commit();          
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();          
        }
    }
}
