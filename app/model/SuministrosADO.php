<?php

namespace SysSoftIntegra\Model;

use Database;
use PDO;
use PDOException;
use Exception;

require_once __DIR__ . './../database/DataBaseConexion.php';


class SuministrosADO
{

    function __construct()
    {
    }

    public static function ListarInventario($producto, $tipoExistencia, $nameProduct, $opcion, $categoria, $marca, $almacen, $posicionPaginacion, $filasPorPagina)
    {

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Inventario_Suministros(?,?,?,?,?,?,?,?,?)}");
            $comando->bindValue(1, $producto, PDO::PARAM_STR);
            $comando->bindValue(2, $tipoExistencia, PDO::PARAM_INT);
            $comando->bindValue(3, $nameProduct, PDO::PARAM_STR);
            $comando->bindValue(4, $opcion, PDO::PARAM_INT);
            $comando->bindValue(5, $categoria, PDO::PARAM_INT);
            $comando->bindValue(6, $marca, PDO::PARAM_INT);
            $comando->bindValue(7, $almacen, PDO::PARAM_INT);
            $comando->bindValue(8, $posicionPaginacion, PDO::PARAM_INT);
            $comando->bindValue(9, $filasPorPagina, PDO::PARAM_INT);
            // Ejecutar sentencia preparada
            $comando->execute();

            $arrayInventario = array();
            $count = 0;
            while ($row = $comando->fetch()) {
                $count++;
                array_push($arrayInventario, array(
                    "count" => $count + $posicionPaginacion,
                    "IdSuministro" => $row["IdSuministro"],
                    "Clave" => $row["Clave"],
                    "ClaveAlterna" => $row["ClaveAlterna"],
                    "NombreMarca" => $row["NombreMarca"],
                    "PrecioCompra" => floatval($row["PrecioCompra"]),
                    "PrecioVentaGeneral" => floatval($row["PrecioVentaGeneral"]),
                    "Cantidad" => floatval($row["Cantidad"]),
                    "UnidadCompra" => $row["UnidadCompra"],
                    "Estado" => $row["Estado"],
                    "Total" => $row["Total"],
                    "StockMinimo" => $row["StockMinimo"],
                    "StockMaximo" => $row["StockMaximo"],
                    "Categoria" => $row["Categoria"],
                    "Marca" => $row["Marca"],
                    "Inventario" => $row["Inventario"]
                ));
            }


            $comando = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Inventario_Suministros_Count(?,?,?,?,?,?,?)}");
            $comando->bindValue(1, $producto, PDO::PARAM_STR);
            $comando->bindValue(2, $tipoExistencia, PDO::PARAM_INT);
            $comando->bindValue(3, $nameProduct, PDO::PARAM_STR);
            $comando->bindValue(4, $opcion, PDO::PARAM_INT);
            $comando->bindValue(5, $categoria, PDO::PARAM_INT);
            $comando->bindValue(6, $marca, PDO::PARAM_INT);
            $comando->bindValue(7, $almacen, PDO::PARAM_INT);
            // Ejecutar sentencia preparada
            $comando->execute();
            $totalResult = $comando->fetchColumn();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return array(
                "data" => $arrayInventario,
                "total" => $totalResult
            );
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }

    public static function ListarProductosDestacos(int $posicionPaginacion, int $filasPorPagina)
    {
        try {
            $cmdSuministro = Database::getInstance()->getDb()->prepare("SELECT 
            s.IdSuministro, 
            s.Clave, 
            s.ClaveAlterna, 
            s.NombreMarca,  
            s.Cantidad, 
            ISNULL(dm.Nombre,'') AS Marca, 
            ISNULL(dc.Nombre,'') AS Categoria, 
            s.PrecioVentaGeneral, 
            (s.PrecioVentaGeneral+(s.PrecioVentaGeneral*0.10)) AS PrecioVentaAlto, 
            s.Estado,
            ISNULL(s.Imagen,'') AS Imagen
            FROM SuministroTB AS s
            LEFT JOIN DetalleTB AS dm ON dm.IdDetalle = s.Marca AND dm.IdMantenimiento = '0007'
            LEFT JOIN DetalleTB AS dc ON dc.IdDetalle = s.Categoria AND dc.IdMantenimiento = '0006'
            ORDER BY s.IdSuministro ASC OFFSET ? ROWS FETCH NEXT ? ROWS");
            $cmdSuministro->bindValue(1, $posicionPaginacion, PDO::PARAM_INT);
            $cmdSuministro->bindValue(2, $filasPorPagina, PDO::PARAM_INT);
            $cmdSuministro->execute();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return $cmdSuministro->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }

    public static function ListarSuministroCatalogo(int $opcion, string $buscar, int $idCategoria, int $idMarca, int $posicionPaginacion, int $filasPorPagina)
    {
        try {
            $cmdSuministro = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Catalogo(?,?,?,?,?,?)}");
            $cmdSuministro->bindValue(1, $opcion, PDO::PARAM_INT);
            $cmdSuministro->bindValue(2, $buscar, PDO::PARAM_STR);
            $cmdSuministro->bindValue(3, $idCategoria, PDO::PARAM_INT);
            $cmdSuministro->bindValue(4, $idMarca, PDO::PARAM_INT);
            $cmdSuministro->bindValue(5, $posicionPaginacion, PDO::PARAM_INT);
            $cmdSuministro->bindValue(6, $filasPorPagina, PDO::PARAM_INT);
            $cmdSuministro->execute();
            $arraySuministro = array();
            while ($row =  $cmdSuministro->fetch()) {
                array_push($arraySuministro, array(
                    "IdSuministro" => $row["IdSuministro"],
                    "Clave" => $row["Clave"],
                    "ClaveAlterna" => $row["ClaveAlterna"],
                    "NombreMarca" => $row["NombreMarca"],
                    "Cantidad" => floatval($row["Cantidad"]),
                    "Marca" => $row["Marca"],
                    "Categoria" => $row["Categoria"],
                    "PrecioVentaGeneral" => floatval($row["PrecioVentaGeneral"]),
                    "PrecioVentaAlto" => floatval($row["PrecioVentaAlto"]),
                    "Estado" => $row["Estado"],
                    "Imagen" => $row["Imagen"],
                ));
            }

            $cmdTotal = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Catalogo_Count(?,?,?,?)}");
            $cmdTotal->bindValue(1, $opcion, PDO::PARAM_INT);
            $cmdTotal->bindValue(2, $buscar, PDO::PARAM_STR);
            $cmdTotal->bindValue(3, $idCategoria, PDO::PARAM_INT);
            $cmdTotal->bindValue(4, $idMarca, PDO::PARAM_INT);
            $cmdTotal->execute();
            $totalResult = $cmdTotal->fetchColumn();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return array(
                "data" => $arraySuministro,
                "total" => $totalResult
            );
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }


    public static function ListarMoviminentos($init, $opcion, $movimiento, $fechaInicial, $fechaFinal, $posicionPagina, $filasPorPagina)
    {

        try {
            $array = array();

            $arrayMovimiento = array();
            $cmdMovimiento = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Movimiento_Inventario(?,?,?,?,?,?,?)}");
            $cmdMovimiento->bindValue(1, $init, PDO::PARAM_BOOL);
            $cmdMovimiento->bindValue(2, $opcion, PDO::PARAM_INT);
            $cmdMovimiento->bindValue(3, $movimiento, PDO::PARAM_INT);
            $cmdMovimiento->bindValue(4, $fechaInicial, PDO::PARAM_STR);
            $cmdMovimiento->bindValue(5, $fechaFinal, PDO::PARAM_STR);
            $cmdMovimiento->bindValue(6, $posicionPagina, PDO::PARAM_INT);
            $cmdMovimiento->bindValue(7, $filasPorPagina, PDO::PARAM_INT);
            $cmdMovimiento->execute();
            $count = 0;
            while ($row = $cmdMovimiento->fetch()) {
                $count++;
                array_push($arrayMovimiento, array(
                    "count" => $count + $posicionPagina,
                    "IdMovimientoInventario" => $row["IdMovimientoInventario"],
                    "Fecha" => $row["Fecha"],
                    "Hora" => $row["Hora"],
                    "TipoAjuste" => $row["TipoAjuste"],
                    "TipoMovimiento" => $row["TipoMovimiento"],
                    "Observacion" => $row["Observacion"],
                    "Informacion" => $row["Informacion"],
                    "Estado" => $row["Estado"]
                ));
            }

            $cmdMovimientoCount = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Movimiento_Inventario_Count(?,?,?,?,?)}");
            $cmdMovimientoCount->bindValue(1, $init, PDO::PARAM_BOOL);
            $cmdMovimientoCount->bindValue(2, $opcion, PDO::PARAM_INT);
            $cmdMovimientoCount->bindValue(3, $movimiento, PDO::PARAM_INT);
            $cmdMovimientoCount->bindValue(4, $fechaInicial, PDO::PARAM_STR);
            $cmdMovimientoCount->bindValue(5, $fechaFinal, PDO::PARAM_STR);
            $cmdMovimientoCount->execute();
            $resultMovimientoCount = $cmdMovimientoCount->fetchColumn();

            array_push($array, $arrayMovimiento, $resultMovimientoCount);
            return $array;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function ListarSuministroView(int $tipo, string $value, int $posicionPaginacion, int $filasPorPagina)
    {
        try {
            $arraySuministro = array();
            $cmdSuministro = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Suministros_Lista_View(?,?,?,?)}");
            $cmdSuministro->bindValue(1, $tipo, PDO::PARAM_INT);
            $cmdSuministro->bindValue(2, $value, PDO::PARAM_STR);
            $cmdSuministro->bindValue(3, $posicionPaginacion, PDO::PARAM_INT);
            $cmdSuministro->bindValue(4, $filasPorPagina, PDO::PARAM_INT);
            $cmdSuministro->execute();

            $count = 0;
            while ($row = $cmdSuministro->fetch()) {
                $count++;
                array_push($arraySuministro, array(
                    "Id" => $count + $posicionPaginacion,
                    "IdSuministro" => $row["IdSuministro"],
                    "Clave" => $row["Clave"],
                    "NombreMarca" => $row["NombreMarca"],
                    "Categoria" => $row["Categoria"],
                    "Marca" => $row["Marca"],
                    "Cantidad" => floatval($row["Cantidad"]),
                    "PrecioCompra" => floatval($row["PrecioCompra"]),
                    "PrecioVentaGeneral" => floatval($row["PrecioVentaGeneral"]),
                    "UnidadCompra" => $row["UnidadCompra"],
                    "UnidadVenta" => $row["UnidadVenta"],
                    "Inventario" => $row["Inventario"],
                    "Operacion" => $row["Operacion"],
                    "Impuesto" => $row["Impuesto"],
                    "ImpuestoNombre" => $row["ImpuestoNombre"],
                    "Valor" => floatval($row["Valor"]),
                    "Lote" => floatval($row["Lote"]),
                    "ValorInventario" => $row["ValorInventario"],
                ));
            }

            $cmdTotal = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Suministros_Lista_View_Count(?,?)}");
            $cmdTotal->bindValue(1, $tipo, PDO::PARAM_INT);
            $cmdTotal->bindValue(2, $value, PDO::PARAM_STR);
            $cmdTotal->execute();
            $resultTotal = $cmdTotal->fetchColumn();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return array(
                "data" => $arraySuministro,
                "total" => $resultTotal
            );
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }

    public static function ListarSuministros($opcion, $clave, $nombreMarca, $categoria, $marca, $posicionPagina, $filasPorPagina)
    {
        try {
            $array = array();
            $cmdSuministros = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Suministros(?,?,?,?,?,?,?)}");
            $cmdSuministros->bindParam(1, $opcion, PDO::PARAM_INT);
            $cmdSuministros->bindParam(2, $clave, PDO::PARAM_STR);
            $cmdSuministros->bindParam(3, $nombreMarca, PDO::PARAM_STR);
            $cmdSuministros->bindParam(4, $categoria, PDO::PARAM_INT);
            $cmdSuministros->bindParam(5, $marca, PDO::PARAM_INT);
            $cmdSuministros->bindParam(6, $posicionPagina, PDO::PARAM_INT);
            $cmdSuministros->bindParam(7, $filasPorPagina, PDO::PARAM_INT);
            $cmdSuministros->execute();

            $arraSuministro = array();
            $count = 0;
            while ($row = $cmdSuministros->fetch()) {
                $count++;
                array_push($arraSuministro, array(
                    "Id" => $count + $posicionPagina,
                    "IdSuministro" => $row["IdSuministro"],
                    "Clave" => $row["Clave"],
                    "ClaveAlterna" => $row["ClaveAlterna"],
                    "NombreMarca" => $row["NombreMarca"],
                    "NombreGenerico" => $row["NombreGenerico"],
                    "StockMinimo" => $row["StockMinimo"],
                    "StockMaximo" => $row["StockMaximo"],
                    "Cantidad" => floatval($row["Cantidad"]),
                    "UnidadCompraNombre" => $row["UnidadCompraNombre"],
                    "PrecioCompra" => floatval($row["PrecioCompra"]),
                    "PrecioVentaGeneral" => floatval($row["PrecioVentaGeneral"]),
                    "Categoria" => $row["Categoria"],
                    "Marca" => $row["Marca"],
                    "Estado" => $row["Estado"],
                    "Inventario" => $row["Inventario"],
                    "ValorInventario" => $row["ValorInventario"],
                    "NuevaImagen" => ($row["NuevaImagen"] != null ? base64_encode($row["NuevaImagen"]) : ''),
                    "ImpuestoNombre" => $row["ImpuestoNombre"],
                    "Valor" => floatval($row["Valor"]),
                ));
            }

            $cmdTotales = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Suministros_Count(?,?,?,?,?)}");
            $cmdTotales->bindParam(1, $opcion, PDO::PARAM_STR);
            $cmdTotales->bindParam(2, $clave, PDO::PARAM_STR);
            $cmdTotales->bindParam(3, $nombreMarca, PDO::PARAM_STR);
            $cmdTotales->bindParam(4, $categoria, PDO::PARAM_STR);
            $cmdTotales->bindParam(5, $marca, PDO::PARAM_STR);
            $cmdTotales->execute();
            $montoTotal = $cmdTotales->fetchColumn();
            array_push($array, $arraSuministro, $montoTotal);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function ObtenerSuministroForMovimiento($idSuministro)
    {
        $consulta = "{CALL Sp_Get_Suministro_For_Movimiento(?)}";
        $suministro = null;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->bindValue(1, $idSuministro, PDO::PARAM_STR);
            // Ejecutar sentencia preparada
            $comando->execute();
            $suministro = $comando->fetchObject();
            return $suministro;
        } catch (PDOException $e) {
            return $suministro;
        }
    }

    public static function ListarSuministroNegativos()
    {
        $consulta = "SELECT 
        IdSuministro,
        Clave,
        NombreMarca,
        StockMinimo,
        Cantidad,
		dbo.Fc_Obtener_Nombre_Detalle(UnidadCompra,'0013') AS UnidadCompraNombre,
        dbo.Fc_Obtener_Nombre_Detalle(Marca,'0007') AS MarcaNombre,
		PrecioCompra,
        Impuesto,
        PrecioVentaGeneral,
		Inventario,
        ValorInventario 
		FROM SuministroTB WHERE Cantidad <=0 ORDER BY MarcaNombre";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            $suministro = $comando->fetchAll(PDO::FETCH_OBJ);
            return $suministro;
        } catch (PDOException $e) {
            return $suministro;
        }
    }

    public static function ListarTodosSuministros()
    {
        $consulta = "SELECT IdSuministro,Clave,NombreMarca,StockMinimo,Cantidad,
		dbo.Fc_Obtener_Nombre_Detalle(UnidadCompra,'0013') AS UnidadCompraNombre,
        dbo.Fc_Obtener_Nombre_Detalle(Marca,'0007') AS MarcaNombre,
		PrecioCompra,Impuesto,PrecioVentaGeneral,
		Inventario,ValorInventario 
		FROM SuministroTB ORDER BY MarcaNombre";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            $suministro = $comando->fetchAll(PDO::FETCH_OBJ);
            return $suministro;
        } catch (PDOException $e) {
            return $suministro;
        }
    }

    public static function ObtenerSuministroById($idSuministro)
    {
        try {
            $array = array();
            // Preparar sentencia
            $cmdProducto = Database::getInstance()->getDb()->prepare("{call Sp_Suministro_By_Id(?)}");
            $cmdProducto->bindValue(1, $idSuministro, PDO::PARAM_STR);
            // Ejecutar sentencia preparada
            $cmdProducto->execute();
            $resultSuministro = null;
            if ($row = $cmdProducto->fetch()) {
                $resultSuministro = (object) array(
                    "IdSuministro" => $row["IdSuministro"],
                    "Origen" => $row["Origen"],
                    "Clave" => $row["Clave"],
                    "ClaveAlterna" => $row["ClaveAlterna"],
                    "NombreMarca" => $row["NombreMarca"],
                    "NombreGenerico" => $row["NombreGenerico"],
                    "Categoria" => $row["Categoria"],
                    "CategoriaNombre" => $row["CategoriaNombre"],
                    "Marca" => $row["Marca"],
                    "MarcaNombre" => $row["MarcaNombre"],
                    "Presentacion" => $row["Presentacion"],
                    "PresentacionNombre" => $row["PresentacionNombre"],
                    "UnidadCompra" => $row["UnidadCompra"],
                    "UnidadCompraNombre" => $row["UnidadCompraNombre"],
                    "UnidadVenta" => $row["UnidadVenta"],
                    "StockMinimo" => floatval($row["StockMinimo"]),
                    "StockMaximo" => floatval($row["StockMaximo"]),
                    "PrecioCompra" => floatval($row["PrecioCompra"]),
                    "PrecioVentaGeneral" => floatval($row["PrecioVentaGeneral"]),
                    "Estado" => $row["Estado"],
                    "Lote" => $row["Lote"],
                    "Inventario" => $row["Inventario"],
                    "ValorInventario" => $row["ValorInventario"],
                    "NuevaImagen" => ($row["NuevaImagen"] != null ? base64_encode($row["NuevaImagen"]) : ''),
                    "Impuesto" => $row["Impuesto"],
                    "ImpuestoNombre" => $row["ImpuestoNombre"],
                    "ClaveSat" => $row["ClaveSat"],
                    "TipoPrecio" => $row["TipoPrecio"],
                );
            }

            $cmdPrecios = Database::getInstance()->getDb()->prepare("SELECT * FROM PreciosTB WHERE IdSuministro = ?");
            $cmdPrecios->bindValue(1, $idSuministro, PDO::PARAM_STR);
            $cmdPrecios->execute();
            $resultPrecios = array();
            while ($row = $cmdPrecios->fetch()) {
                array_push($resultPrecios, array(
                    "Nombre" => $row["Nombre"],
                    "Valor" => floatval($row["Valor"]),
                    "Factor" => floatval($row["Factor"])
                ));
            }

            array_push($array, $resultSuministro, $resultPrecios);
            return $array;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function ListarImpuesto()
    {
        try {
            $array = array();
            $cmdImpuesto = Database::getInstance()->getDb()->prepare("SELECT IdImpuesto,Nombre FROM ImpuestoTB");
            $cmdImpuesto->execute();
            while ($row = $cmdImpuesto->fetch()) {
                array_push($array, array(
                    "IdImpuesto" => $row["IdImpuesto"],
                    "Nombre" => $row["Nombre"]
                ));
            }
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function RegistrarSuministro($suministro)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT Clave FROM SuministroTB WHERE Clave = ?");
            $cmdValidate->bindParam(1, $suministro["Clave"], PDO::PARAM_STR);
            $cmdValidate->execute();
            if ($cmdValidate->fetch()) {
                Database::getInstance()->getDb()->rollback();
                return "duplicate";
            } else {

                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT NombreMarca FROM SuministroTB WHERE NombreMarca = ?");
                $cmdValidate->bindParam(1, $suministro["NombreMarca"], PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollback();
                    return "duplicatename";
                } else {

                    $codigoSuministro = Database::getInstance()->getDb()->prepare("SELECT dbo.Fc_Suministro_Codigo_Alfanumerico();");
                    $codigoSuministro->execute();
                    $idSuministro = $codigoSuministro->fetchColumn();

                    $image = $suministro['Imagen'] == null ? null : base64_decode($suministro['Imagen']);

                    $cmdSuministro = Database::getInstance()->getDb()->prepare("INSERT INTO SuministroTB(
                    IdSuministro,
                    Origen,
                    Clave,
                    ClaveAlterna,
                    NombreMarca,
                    NombreGenerico,

                    Categoria,
                    Marca,
                    Presentacion,
                    UnidadCompra,
                    UnidadVenta,

                    Estado,
                    StockMinimo,
                    StockMaximo,
                    Cantidad,

                    Impuesto,
                    TipoPrecio,
                    PrecioCompra,
                    PrecioVentaGeneral,
                    Lote,
                    Inventario,
                    ValorInventario,
                    Imagen,
                    ClaveSat,
                    NuevaImagen)
                    VALUES(
                        ?,--ID SUMINISTROS
                        ?,--ORIGREN
                        UPPER(?),--CLAVE
                        UPPER(?),--CLAVE ALTERNA
                        UPPER(?),--NOMBRE MARCA
                        UPPER(?),--NOMBRE GENERICO
                        ?,--CATEGORIA
                        ?,--MARCA
                        ?,--PRESENTACION
                        ?,--UNIDAD COMPRA
                        ?,--UNIDAD VENTA
                        ?,--ESTADO
                        ?,--STOCKMINIMO
                        ?,--STOCKMAXIMO
                        ?,--CANTIDAD
                        ?,--IMPUESTO
                        ?,--TIPO PRECIO
                        ?,--PRECIO COMPRA
                        ?,--PRECIO VENTA GENERAL
                        ?,--LOTE
                        ?,--INVENTARIO
                        ?,--VALOR INVENTARIO
                        '',
                        ?,--CLAVE
                        ?--NUEVA IMAGEN
                        )");

                    $cmdSuministro->bindParam(1, $idSuministro, PDO::PARAM_STR);
                    $cmdSuministro->bindParam(2, $suministro["Origen"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(3, $suministro["Clave"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(4, $suministro["ClaveAlterna"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(5, $suministro["NombreMarca"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(6, $suministro["NombreGenerico"], PDO::PARAM_STR);

                    $cmdSuministro->bindParam(7, $suministro["Categoria"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(8, $suministro["Marca"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(9, $suministro["Presentacion"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(10, $suministro["UnidadCompra"], PDO::PARAM_INT);
                    $cmdSuministro->bindParam(11, $suministro["UnidadVenta"], PDO::PARAM_INT);

                    $cmdSuministro->bindParam(12, $suministro["Estado"], PDO::PARAM_INT);
                    $cmdSuministro->bindParam(13, $suministro["StockMinimo"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(14, $suministro["StockMaximo"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(15, $suministro["Cantidad"], PDO::PARAM_STR);

                    $cmdSuministro->bindParam(16, $suministro["Impuesto"], PDO::PARAM_INT);
                    $cmdSuministro->bindParam(17, $suministro["TipoPrecio"], PDO::PARAM_BOOL);
                    $cmdSuministro->bindParam(18, $suministro["PrecioCompra"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(19, $suministro["PrecioVentaGeneral"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(20, $suministro["Lote"], PDO::PARAM_BOOL);
                    $cmdSuministro->bindParam(21, $suministro["Inventario"], PDO::PARAM_BOOL);
                    $cmdSuministro->bindParam(22, $suministro["ValorInventario"], PDO::PARAM_INT);

                    $cmdSuministro->bindParam(23, $suministro["ClaveUnica"], PDO::PARAM_STR);
                    $cmdSuministro->bindParam(24, $image, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
                    $cmdSuministro->execute();

                    $cmdPrecios = Database::getInstance()->getDb()->prepare("INSERT INTO PreciosTB(IdArticulo, IdSuministro, Nombre, Valor, Factor, Estado) VALUES(?,?,?,?,?,?)");
                    foreach ($suministro["ListaPrecios"] as $value) {
                        $cmdPrecios->execute(array(
                            "",
                            $idSuministro,
                            $value["nombre"],
                            $value["valor"],
                            ($value["factor"] <= 0 ? 1 : $value["factor"]),
                            true
                        ));
                    }

                    $cmdAlmacen = Database::getInstance()->getDb()->prepare("SELECT IdAlmacen FROM AlmacenTB");
                    $cmdAlmacen->execute();
                    while ($row = $cmdAlmacen->fetch()) {
                        if ($row["IdAlmacen"] != 0) {
                            $cmdCantidad = Database::getInstance()->getDb()->prepare("INSERT INTO CantidadTB(IdAlmacen,IdSuministro,StockMinimo,StockMaximo,Cantidad) VALUES(?,?,?,?,0)");
                            $cmdCantidad->execute(array(
                                $row["IdAlmacen"],
                                $idSuministro,
                                $suministro["StockMinimo"],
                                $suministro["StockMaximo"]
                            ));
                        }
                    }

                    Database::getInstance()->getDb()->commit();
                    return "registrado";
                }
            }
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function RegistrarAlmacenCantidad($suministro, $idAlmacen)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT IdSuministro FROM SuministroTB WHERE Clave = ?");
            $cmdValidate->bindParam(1, $suministro["Clave"], PDO::PARAM_STR);
            $cmdValidate->execute();
            if ($row = $cmdValidate->fetch()) {

                $suministro_almacen_insertar = Database::getInstance()->getDb()->prepare("INSERT INTO CantidadTB(IdAlmacen,IdSuministro,StockMinimo,StockMaximo,Cantidad) VALUES(?,?,?,?,?)");
                $suministro_almacen_insertar->execute(array($idAlmacen, $row["IdSuministro"], $suministro["StockMinimo"], $suministro["StockMaximo"], $suministro["Cantidad"]));

                $suministroKardex = Database::getInstance()->getDb()->prepare("INSERT INTO KardexSuministroTB
                    (IdSuministro,
                    Fecha,
                    Hora,
                    Tipo,
                    Movimiento,
                    Detalle,
                    Cantidad,
                    Costo,
                    Total,
                    IdAlmacen)
                    VALUES(?,GETDATE(),GETDATE(),?,?,?,?,?,?,?)");

                $suministroKardex->execute(array(
                    $row["IdSuministro"],
                    1,
                    2,
                    "INVENTARIO INICIAL",
                    $suministro["Cantidad"],
                    $suministro["PrecioCompra"],
                    $suministro["PrecioCompra"] * $suministro["Cantidad"],
                    $idAlmacen
                ));
            }

            Database::getInstance()->getDb()->commit();
            return "registrado";
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function ActualizarSuministro($suministro)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM SuministroTB WHERE IdSuministro = ?");
            $cmdValidate->bindParam(1, $suministro["IdSuministro"], PDO::PARAM_STR);
            $cmdValidate->execute();
            if ($cmdValidate->fetch()) {

                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT Clave FROM SuministroTB WHERE IdSuministro <> ? AND Clave = ?");
                $cmdValidate->bindParam(1, $suministro["IdSuministro"], PDO::PARAM_STR);
                $cmdValidate->bindParam(2, $suministro["Clave"], PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollback();
                    return "duplicate";
                } else {

                    $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT NombreMarca FROM SuministroTB WHERE IdSuministro <> ? AND NombreMarca = ?");
                    $cmdValidate->bindParam(1, $suministro["IdSuministro"], PDO::PARAM_STR);
                    $cmdValidate->bindParam(2, $suministro["NombreMarca"], PDO::PARAM_STR);
                    $cmdValidate->execute();
                    if ($cmdValidate->fetch()) {
                        Database::getInstance()->getDb()->rollback();
                        return "duplicatename";
                    } else {

                        $image = $suministro['Imagen'] == null ? null : base64_decode($suministro['Imagen']);

                        $cmdSuministro = Database::getInstance()->getDb()->prepare("UPDATE SuministroTB SET
                        Origen = ?,
                        Clave = UPPER(?),
                        ClaveAlterna = UPPER(?),
                        NombreMarca = UPPER(?),
                        NombreGenerico = UPPER(?),

                        Categoria = ?,
                        Marca = ?,
                        Presentacion = ?,
                        UnidadCompra = ?,
                        UnidadVenta = ?,

                        Estado = ?,
                        StockMinimo = ?,
                        StockMaximo = ?,

                        Impuesto = ?,
                        TipoPrecio = ?,
                        PrecioCompra = ?,
                        PrecioVentaGeneral = ?,
                        Lote = ?,
                        Inventario = ?,
                        ValorInventario = ?,

                        ClaveSat = ?,
                        NuevaImagen = ?
                        WHERE IdSuministro = ?");

                        $cmdSuministro->bindParam(1, $suministro["Origen"], PDO::PARAM_STR);
                        $cmdSuministro->bindParam(2, $suministro["Clave"], PDO::PARAM_STR);
                        $cmdSuministro->bindParam(3, $suministro["ClaveAlterna"], PDO::PARAM_STR);
                        $cmdSuministro->bindParam(4, $suministro["NombreMarca"], PDO::PARAM_STR);
                        $cmdSuministro->bindParam(5, $suministro["NombreGenerico"], PDO::PARAM_STR);

                        $cmdSuministro->bindParam(6, $suministro["Categoria"], PDO::PARAM_STR);
                        $cmdSuministro->bindParam(7, $suministro["Marca"], PDO::PARAM_STR);
                        $cmdSuministro->bindParam(8, $suministro["Presentacion"], PDO::PARAM_STR);
                        $cmdSuministro->bindParam(9, $suministro["UnidadCompra"], PDO::PARAM_INT);
                        $cmdSuministro->bindParam(10, $suministro["UnidadVenta"], PDO::PARAM_INT);

                        $cmdSuministro->bindParam(11, $suministro["Estado"], PDO::PARAM_INT);
                        $cmdSuministro->bindParam(12, $suministro["StockMinimo"], PDO::PARAM_STR);
                        $cmdSuministro->bindParam(13, $suministro["StockMaximo"], PDO::PARAM_STR);

                        $cmdSuministro->bindParam(14, $suministro["Impuesto"], PDO::PARAM_INT);
                        $cmdSuministro->bindParam(15, $suministro["TipoPrecio"], PDO::PARAM_BOOL);
                        $cmdSuministro->bindParam(16, $suministro["PrecioCompra"], PDO::PARAM_STR);
                        $cmdSuministro->bindParam(17, $suministro["PrecioVentaGeneral"], PDO::PARAM_STR);
                        $cmdSuministro->bindParam(18, $suministro["Lote"], PDO::PARAM_BOOL);
                        $cmdSuministro->bindParam(19, $suministro["Inventario"], PDO::PARAM_BOOL);
                        $cmdSuministro->bindParam(20, $suministro["ValorInventario"], PDO::PARAM_INT);

                        $cmdSuministro->bindParam(21, $suministro["ClaveUnica"], PDO::PARAM_STR);
                        $cmdSuministro->bindParam(22, $image, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
                        $cmdSuministro->bindParam(23, $suministro["IdSuministro"], PDO::PARAM_STR);
                        $cmdSuministro->execute();

                        $preciosBorrar = Database::getInstance()->getDb()->prepare("DELETE FROM PreciosTB WHERE IdSuministro = ?");
                        $preciosBorrar->bindParam(1, $suministro["IdSuministro"], PDO::PARAM_STR);
                        $preciosBorrar->execute();

                        $cmdPrecios = Database::getInstance()->getDb()->prepare("INSERT INTO PreciosTB(IdArticulo, IdSuministro, Nombre, Valor, Factor, Estado) VALUES(?,?,?,?,?,?)");
                        foreach ($suministro["ListaPrecios"] as $value) {
                            $cmdPrecios->execute(array(
                                "",
                                $suministro["IdSuministro"],
                                $value["nombre"],
                                $value["valor"],
                                ($value["factor"] <= 0 ? 1 : $value["factor"]),
                                true
                            ));
                        }
                        Database::getInstance()->getDb()->commit();
                        return "actualizado";
                    }
                }
            } else {
                Database::getInstance()->getDb()->rollback();
                return "noid";
            }
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }



    public static function ObtenerDetalleId($opcion, $idMantenimiento, $nombre)
    {
        try {
            $array = array();
            $cmdDetalle = Database::getInstance()->getDb()->prepare("{CALL Sp_Get_Detalle_IdNombre(?,?,?)}");
            $cmdDetalle->bindParam(1, $opcion, PDO::PARAM_INT);
            $cmdDetalle->bindParam(2, $idMantenimiento, PDO::PARAM_STR);
            $cmdDetalle->bindParam(3, $nombre, PDO::PARAM_STR);
            $cmdDetalle->execute();
            while ($row = $cmdDetalle->fetch()) {
                array_push($array, array(
                    "IdDetalle" => $row["IdDetalle"],
                    "Nombre" => $row["Nombre"]
                ));
            }
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function EliminarProductoById($idProducto)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM DetalleCompraTB WHERE IdArticulo = ? ");
            $cmdValidate->bindParam(1, $idProducto, PDO::PARAM_STR);
            $cmdValidate->execute();
            if ($cmdValidate->fetch()) {
                Database::getInstance()->getDb()->rollBack();
                return "compra";
            } else {
                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM DetalleVentaTB WHERE IdArticulo = ?");
                $cmdValidate->bindParam(1, $idProducto, PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollBack();
                    return "venta";
                } else {
                    $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM KardexSuministroTB WHERE IdSuministro = ?");
                    $cmdValidate->bindParam(1, $idProducto, PDO::PARAM_STR);
                    $cmdValidate->execute();
                    if ($cmdValidate->fetch()) {
                        Database::getInstance()->getDb()->rollBack();
                        return "kardex";
                    } else {
                        $cmdRemover = Database::getInstance()->getDb()->prepare("DELETE FROM SuministroTB WHERE IdSuministro = ?");
                        $cmdRemover->bindParam(1, $idProducto, PDO::PARAM_STR);
                        $cmdRemover->execute();
                        Database::getInstance()->getDb()->commit();
                        return "eliminado";
                    }
                }
            }
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollBack();
            return $ex->getMessage();
        }
    }

    public static function KardexSuministroById($opcion, $value, $idAlmacen)
    {
        try {

            $array = array();
            $cmdKardex = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Kardex_Suministro_By_Id(?,?,?)}");
            $cmdKardex->bindParam(1, $opcion, PDO::PARAM_INT);
            $cmdKardex->bindParam(2, $value, PDO::PARAM_STR);
            $cmdKardex->bindParam(3, $idAlmacen, PDO::PARAM_STR);
            $cmdKardex->execute();

            $arrayKardex = array();
            $cantidad = 0;
            $saldo = 0;

            $count = 0;
            while ($row = $cmdKardex->fetch()) {
                $count++;
                $cantidad = $cantidad + ($row["Tipo"] == 1 ? $row["Cantidad"] : -$row["Cantidad"]);
                $saldo = $saldo + ($row["Tipo"] == 1 ? $row["Total"] : -$row["Total"]);
                array_push($arrayKardex, array(
                    "Id" => $count,
                    "IdSuministro" => $row["IdSuministro"],
                    "Fecha" => $row["Fecha"],
                    "Hora" => $row["Hora"],
                    "Tipo" => $row["Tipo"],
                    "Nombre" => $row["Nombre"],
                    "Detalle" => $row["Detalle"],
                    "Cantidad" => floatval($row["Cantidad"]),
                    "Existencia" => floatval($cantidad),
                    "Costo" => floatval($row["Costo"]),
                    "Saldo" => floatval($saldo),
                    "Total" => floatval($row["Total"])
                ));
            }

            array_push($array, $arrayKardex, $cantidad, $saldo);

            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function Get_Suministro_By_Search(string $value)
    {
        try {
            $cmdSuministro = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Suministro_By_Search(?)}");
            $cmdSuministro->bindParam(1, $value, PDO::PARAM_STR);
            $cmdSuministro->execute();

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            return $cmdSuministro->fetch(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            return $ex->getMessage();
        }
    }
}
