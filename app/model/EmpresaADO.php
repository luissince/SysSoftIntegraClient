<?php

namespace SysSoftIntegra\Model;

use SysSoftIntegra\Src\Tools;
use SysSoftIntegra\DataBase\Database;
use PDO;
use Exception;

class EmpresaADO
{

    function construct()
    {
    }

    public static function Index()
    {
        try {
            $cmdEmpresa = Database::getInstance()->getDb()->prepare("SELECT 
            Telefono,
            Celular,
            Domicilio,
            Email,
            Telefono,
            NombreComercial
            FROM EmpresaTB");
            $cmdEmpresa->execute();

            Tools::httpStatus200();

            return $cmdEmpresa->fetch(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            Tools::httpStatus500();

            return $ex->getMessage();
        }
    }

    public static function ObtenerEmpresa()
    {
        try {
            $comando = Database::getInstance()->getDb()->prepare("SELECT 
            TOP 1 
            e.*,
            u.IdUbigeo,
            u.Departamento,
            u.Provincia,
            u.Distrito
            FROM EmpresaTB AS e
            LEFT JOIN UbigeoTB AS u ON u.IdUbigeo = e.Ubigeo");
            $comando->execute();
            $row = $comando->fetch();
            $resultEmpresa  = (object)array(
                "IdEmpresa" => $row['IdEmpresa'],
                "GiroComercial" => $row['GiroComercial'],
                "Nombre" => $row['Nombre'],
                "Telefono" => $row['Telefono'],
                "Celular" => $row['Celular'],
                "PaginaWeb" => $row['PaginaWeb'],
                "Email" => $row['Email'],
                "Terminos" => $row['Terminos'],
                "Condiciones" => $row['Condiciones'],
                "Domicilio" => $row['Domicilio'],
                "TipoDocumento" => $row['TipoDocumento'],
                "NumeroDocumento" => $row['NumeroDocumento'],
                "RazonSocial" => $row['RazonSocial'],
                "NombreComercial" => $row['NombreComercial'],
                "Image" => $row['Image'] == null ? "" : base64_encode($row['Image']),
                "IdUbigeo" => $row['IdUbigeo'] == null ?  0 : $row['IdUbigeo'],
                "Ubigeo" => $row['Ubigeo'] == null ?  '' : $row['Ubigeo'],
                "Departamento" => $row['Departamento'] == null ?  '' : $row['Departamento'],
                "Provincia" => $row['Provincia'] == null ?  '' : $row['Provincia'],
                "Distrito" => $row['Distrito'] == null ? '' : $row['Distrito'],
                "UsuarioSol" => $row['UsuarioSol'],
                "ClaveSol" => $row['ClaveSol'],
                "CertificadoRuta" => $row['CertificadoRuta'],
                "CertificadoClave" => $row['CertificadoClave'],
                "IdApiSunat" => $row['IdApiSunat'],
                "ClaveApiSunat" => $row['ClaveApiSunat']
            );

            Tools::httpStatus200();

            return $resultEmpresa;
        } catch (Exception $ex) {
            Tools::httpStatus500();

            return $ex->getMessage();
        }
    }

    public static function ReporteEmpresa()
    {
        try {
            $cmdEmpresa = Database::getInstance()->getDb()->prepare("SELECT TOP 1 
            d.IdAuxiliar,
            e.NumeroDocumento,
            e.RazonSocial,
            e.NombreComercial,
            e.Domicilio,
            e.Telefono,
            e.Celular,
            e.Email,
            e.Terminos,
            e.Condiciones,
            e.PaginaWeb,
            e.Image
            FROM EmpresaTB AS e 
            INNER JOIN DetalleTB AS d ON e.TipoDocumento = d.IdDetalle AND d.IdMantenimiento = '0003'");
            $cmdEmpresa->execute();
            $rowEmpresa = $cmdEmpresa->fetch();
            $empresa  = (object)array(
                "IdAuxiliar" => $rowEmpresa['IdAuxiliar'],
                "NumeroDocumento" => $rowEmpresa['NumeroDocumento'],
                "RazonSocial" => $rowEmpresa['RazonSocial'],
                "NombreComercial" => $rowEmpresa['NombreComercial'],
                "Domicilio" => $rowEmpresa['Domicilio'],
                "Telefono" => $rowEmpresa['Telefono'],
                "PaginaWeb" => $rowEmpresa['PaginaWeb'],
                "Email" => $rowEmpresa['Email'],
                "Terminos" => $rowEmpresa['Terminos'],
                "Celular" => $rowEmpresa['Celular'],
                "Condiciones" => $rowEmpresa['Condiciones'],
                "Image" => $rowEmpresa['Image'] == null ? "" : base64_encode($rowEmpresa['Image'])
            );

            return  $empresa;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function FiltrarUbigeo(string $search)
    {
        try {
            $cmdUbigeo = Database::getInstance()->getDb()->prepare("{CALL Sp_Obtener_Ubigeo_BySearch(?)}");
            $cmdUbigeo->bindParam(1, $search, PDO::PARAM_STR);
            $cmdUbigeo->execute();
            Tools::httpStatus200();

            return $cmdUbigeo->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            Tools::httpStatus500();

            return $ex->getMessage();
        }
    }

    public static function CrudEmpresa($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $path = "";
            if ($body["certificadoType"] == 1) {

                $ext = pathinfo($body['certificadoName'], PATHINFO_EXTENSION);
                $file_path = $body['txtNumDocumento'] . "." . $ext;
                $path = "../resources/" . $file_path;
                $move = move_uploaded_file($body['certificadoNameTmp'], $path);
                if (!$move) {
                    throw new Exception('Problemas al subir el certificado.');
                }

                $pkcs12 = file_get_contents($path);
                $certificados = array();
                $respuesta = openssl_pkcs12_read($pkcs12, $certificados, $body['txtClaveCertificado']);

                if ($respuesta) {
                    $publicKeyPem  = $certificados['cert'];
                    $privateKeyPem = $certificados['pkey'];

                    file_put_contents('../resources/private_key.pem', $privateKeyPem);
                    file_put_contents('../resources/public_key.pem', $publicKeyPem);
                    chmod("../resources/private_key.pem", 0777);
                    chmod("../resources/public_key.pem", 0777);
                } else {
                    throw new Exception('Error en crear las llaves del certificado.');
                }
            } else {
                $path = $body["certificadoUrl"];
            }

            if ($body["imageType"] == 1) {
                $comando = Database::getInstance()->getDb()->prepare("UPDATE EmpresaTB SET 
                NumeroDocumento = ?,
                RazonSocial=?,
                NombreComercial=?,
                Domicilio=?,
                Telefono = ?,
                Celular=?,
                PaginaWeb=?,
                Email=?,
                Terminos=?,
                Condiciones=?,
                Image=?,
                Ubigeo=?,
                UsuarioSol=?,
                ClaveSol=?,
                CertificadoRuta=?,
                CertificadoClave=?,
                IdApiSunat=?,
                ClaveApiSunat=?
                WHERE IdEmpresa = ?");
                $comando->bindParam(1, $body['txtNumDocumento'], PDO::PARAM_STR);
                $comando->bindParam(2, $body['txtRazonSocial'], PDO::PARAM_STR);
                $comando->bindParam(3, $body['txtNomComercial'], PDO::PARAM_STR);
                $comando->bindParam(4, $body['txtDireccion'], PDO::PARAM_STR);
                $comando->bindParam(5, $body['txtTelefono'], PDO::PARAM_STR);
                $comando->bindParam(6, $body['txtCelular'], PDO::PARAM_STR);
                $comando->bindParam(7, $body['txtPaginWeb'], PDO::PARAM_STR);
                $comando->bindParam(8, $body['txtEmail'], PDO::PARAM_STR);
                $comando->bindParam(9, $body['txtTerminos'], PDO::PARAM_STR);
                $comando->bindParam(10, $body['txtCodiciones'], PDO::PARAM_STR);
                $comando->bindParam(11, $body['image'],  PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
                $comando->bindParam(12, $body['cbUbigeo'], PDO::PARAM_INT);
                $comando->bindParam(13, $body['txtUsuarioSol'], PDO::PARAM_STR);
                $comando->bindParam(14, $body['txtClaveSol'], PDO::PARAM_STR);
                $comando->bindParam(15, $path, PDO::PARAM_STR);
                $comando->bindParam(16, $body['txtClaveCertificado'], PDO::PARAM_STR);
                $comando->bindParam(17, $body['txtIdApiSunat'], PDO::PARAM_STR);
                $comando->bindParam(18, $body['txtClaveApiSunat'], PDO::PARAM_STR);
                $comando->bindParam(19, $body['idEmpresa'], PDO::PARAM_INT);
                $comando->execute();
            } else {
                $comando = Database::getInstance()->getDb()->prepare("UPDATE EmpresaTB SET 
                NumeroDocumento = ?,
                RazonSocial=?,
                NombreComercial=?,
                Domicilio=?,
                Telefono = ?,
                Celular=?,
                PaginaWeb=?,
                Email=?,
                Terminos=?,
                Condiciones=?,
                Ubigeo=?,
                UsuarioSol=?,
                ClaveSol=?,
                CertificadoRuta=?,
                CertificadoClave=?,
                IdApiSunat=?,
                ClaveApiSunat=?
                WHERE IdEmpresa = ?");
                $comando->bindParam(1, $body['txtNumDocumento'], PDO::PARAM_STR);
                $comando->bindParam(2, $body['txtRazonSocial'], PDO::PARAM_STR);
                $comando->bindParam(3, $body['txtNomComercial'], PDO::PARAM_STR);
                $comando->bindParam(4, $body['txtDireccion'], PDO::PARAM_STR);
                $comando->bindParam(5, $body['txtTelefono'], PDO::PARAM_STR);
                $comando->bindParam(6, $body['txtCelular'], PDO::PARAM_STR);
                $comando->bindParam(7, $body['txtPaginWeb'], PDO::PARAM_STR);
                $comando->bindParam(8, $body['txtEmail'], PDO::PARAM_STR);
                $comando->bindParam(9, $body['txtTerminos'], PDO::PARAM_STR);
                $comando->bindParam(10, $body['txtCodiciones'], PDO::PARAM_STR);
                $comando->bindParam(11, $body['cbUbigeo'], PDO::PARAM_INT);
                $comando->bindParam(12, $body['txtUsuarioSol'], PDO::PARAM_STR);
                $comando->bindParam(13, $body['txtClaveSol'], PDO::PARAM_STR);
                $comando->bindParam(14, $path, PDO::PARAM_STR);
                $comando->bindParam(15, $body['txtClaveCertificado'], PDO::PARAM_STR);
                $comando->bindParam(16, $body['txtIdApiSunat'], PDO::PARAM_STR);
                $comando->bindParam(17, $body['txtClaveApiSunat'], PDO::PARAM_STR);
                $comando->bindParam(18, $body['idEmpresa'], PDO::PARAM_INT);
                $comando->execute();
            }

            Database::getInstance()->getDb()->commit();

            Tools::httpStatus201();

            return array(
                "state" => 1,
                "message" => "Se modificó correctamente los datos."
            );
        } catch (Exception $ex) {
            unlink('../resources/' . $file_path);
            Database::getInstance()->getDb()->rollback();

            Tools::httpStatus500();

            return $ex->getMessage();
        }
    }
}
