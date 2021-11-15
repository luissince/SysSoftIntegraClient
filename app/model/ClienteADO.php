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

            return array("estado" => 1, "data" =>  $arrayVenta, "total" => $resultTotal);
        } catch (PDOException $ex) {
            return array("estado" => 2,  "mensaje" => $ex->getMessage());
        }
    }

    public static function GetByIdCliente($idCliente)
    {
        try {
            $cmdCliente = Database::getInstance()->getDb()->prepare("{call Sp_Get_Cliente_By_Id(?)}");
            $cmdCliente->bindParam(1, $idCliente, PDO::PARAM_STR);
            $cmdCliente->execute();
            return array("estado" => 1, "data" => $cmdCliente->fetchObject());
        } catch (Exception $ex) {
            return array("estado" => 0, $ex->getMessage());
        }
    }

    public static function CrudCliente($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT IdCliente FROM ClienteTB WHERE IdCliente = ?");
            $cmdValidate->bindParam(1, $body["IdCliente"], PDO::PARAM_STR);
            $cmdValidate->execute();
            if ($cmdValidate->fetch()) {

                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT NumeroDocumento FROM ClienteTB WHERE IdCliente <> ? AND NumeroDocumento = ?");
                $cmdValidate->bindParam(1, $body["IdCliente"], PDO::PARAM_STR);
                $cmdValidate->bindParam(2, $body["NumeroDocumento"], PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollback();
                    return array(
                        "estado" => 3,
                        "message" => "No se puede haber 2 personas con el mismo documento de identidad."
                    );
                } else {

                    $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT NumeroDocumento FROM ClienteTB WHERE IdCliente <> ? AND Informacion = ?");
                    $cmdValidate->bindParam(1, $body["IdCliente"], PDO::PARAM_STR);
                    $cmdValidate->bindParam(2, $body["Informacion"], PDO::PARAM_STR);
                    $cmdValidate->execute();
                    if ($cmdValidate->fetch()) {
                        Database::getInstance()->getDb()->rollback();
                        return array(
                            "estado" => 2,
                            "message" => "No se puede haber 2 personas con la misma información."
                        );
                    } else {
                        $cmdCliente = Database::getInstance()->getDb()->prepare("UPDATE ClienteTB SET TipoDocumento=?,NumeroDocumento=?,Informacion=UPPER(?),Telefono=?,Celular=?,Email=?,Direccion=?,Representante=?,Estado=? WHERE IdCliente = ?");
                        $cmdCliente->bindParam(1, $body["TipoDocumento"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(2, $body["NumeroDocumento"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(3, $body["Informacion"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(4, $body["Telefono"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(5, $body["Celular"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(6, $body["Email"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(7, $body["Direccion"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(8, $body["Representante"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(9, $body["Estado"], PDO::PARAM_BOOL);
                        $cmdCliente->bindParam(10, $body["IdCliente"], PDO::PARAM_BOOL);
                        $cmdCliente->execute();

                        Database::getInstance()->getDb()->commit();
                        return array(
                            "estado" => 1,
                            "message" => "Se actualizó correctamente el cliente."
                        );
                    }
                }
            } else {

                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT NumeroDocumento FROM ClienteTB WHERE NumeroDocumento = ?");
                $cmdValidate->bindParam(1, $body["NumeroDocumento"], PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollback();
                    return array(
                        "estado" => 3,
                        "message" => "No se puede haber 2 personas con el mismo documento de identidad."
                    );
                } else {

                    $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT NumeroDocumento FROM ClienteTB WHERE Informacion = ?");
                    $cmdValidate->bindParam(1, $body["Informacion"], PDO::PARAM_STR);
                    $cmdValidate->execute();
                    if ($cmdValidate->fetch()) {
                        Database::getInstance()->getDb()->rollback();
                        return array(
                            "estado" => 2,
                            "message" => "No se puede haber 2 personas con la misma información."
                        );
                    } else {

                        $codCliente = Database::getInstance()->getDb()->prepare("SELECT dbo.Fc_Cliente_Codigo_Alfanumerico();");
                        $codCliente->execute();
                        $idCliente = $codCliente->fetchColumn();

                        $cmdCliente = Database::getInstance()->getDb()->prepare("INSERT INTO ClienteTB(IdCliente,TipoDocumento,NumeroDocumento,Informacion,Telefono,Celular,Email,Direccion,Representante,Estado,Predeterminado,Sistema) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
                        $cmdCliente->bindParam(1, $idCliente, PDO::PARAM_STR);
                        $cmdCliente->bindParam(2, $body["TipoDocumento"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(3, $body["NumeroDocumento"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(4, $body["Informacion"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(5, $body["Telefono"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(6, $body["Celular"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(7, $body["Email"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(8, $body["Direccion"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(9, $body["Representante"], PDO::PARAM_STR);
                        $cmdCliente->bindParam(10, $body["Estado"], PDO::PARAM_BOOL);
                        $cmdCliente->bindParam(11, $body["Predeterminado"], PDO::PARAM_BOOL);
                        $cmdCliente->bindParam(12, $body["Sistema"], PDO::PARAM_BOOL);
                        $cmdCliente->execute();
                        Database::getInstance()->getDb()->commit();
                        return array(
                            "estado" => 1,
                            "message" => "Se registró correctamente el cliente."
                        );
                    }
                }
            }
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return array(
                "estado" => 0,
                "message" => $ex->getMessage(),
            );
        }
    }

    public static function DeleteCliente($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM VentaTB WHERE Cliente = ?");
            $cmdValidate->bindParam(1, $body["IdCliente"], PDO::PARAM_STR);
            $cmdValidate->execute();
            if ($cmdValidate->fetch()) {
                Database::getInstance()->getDb()->rollback();
                return array(
                    "estado" => 2,
                    "message" => "No se puede eliminar al cliente porque tiene asociado ventas."
                );
            } else {
                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM ClienteTB WHERE IdCliente = ? AND Sistema = 1");
                $cmdValidate->bindParam(1, $body["IdCliente"], PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollback();
                    return array(
                        "estado" => 3,
                        "message" => "No se puede eliminar el cliente porque es propio del sistema."
                    );
                } else {
                    $cmdCliente = Database::getInstance()->getDb()->prepare("DELETE FROM ClienteTB WHERE IdCliente = ?");
                    $cmdCliente->bindParam(1, $body["IdCliente"], PDO::PARAM_STR);
                    $cmdCliente->execute();

                    Database::getInstance()->getDb()->commit();
                    return array(
                        "estado" => 1,
                        "message" => "Se elimino correctamente el cliente."
                    );
                }
            }
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return array(
                "estado" => 0,
                "message" => $ex->getMessage(),
            );
        }
    }

    public static function PredeterminateCliente($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdCliente = Database::getInstance()->getDb()->prepare("UPDATE ClienteTB SET Predeterminado = 0");
            $cmdCliente->execute();

            $cmdPredeterminate = Database::getInstance()->getDb()->prepare("UPDATE ClienteTB SET Predeterminado = 1 WHERE IdCliente = ?");
            $cmdPredeterminate->bindParam(1, $body["IdCliente"], PDO::PARAM_BOOL);
            $cmdPredeterminate->execute();

            Database::getInstance()->getDb()->commit();
            return array(
                "estado" => 1,
                "message" => "Se puso al cliente como predeterminado correctamente."
            );
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return array(
                "estado" => 0,
                "message" => $ex->getMessage(),
            );
        }
    }
}
