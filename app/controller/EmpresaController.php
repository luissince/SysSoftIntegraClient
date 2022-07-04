<?php

// use SysSoftIntegra\Model\EmpresaADO;
// use SysSoftIntegra\Controller\BaseController;

// require __DIR__ . './../src/autoload.php';

// class EmpresaController extends BaseController
// {
//     /**
//      * "/empresa/get" Endpoint - Get list of users
//      */
//     public function getEmpresa()
//     {
//         if (strtoupper($this->getMethod()) == 'GET') {
//             $result = EmpresaADO::ObtenerEmpresa();
//             if (is_array($result)) {
//                 $this->sendOutput(
//                     $result,
//                     array($this->getContentTypeJson(), $this->getStatus200())
//                 );
//             } else {
//                 $this->sendOutput(
//                     $result,
//                     array($this->getContentTypeJson(), $this->getStatus500())
//                 );
//             }
//         } else {
//             $this->sendOutput(
//                 "Method not supported",
//                 array($this->getContentTypeJson(), $this->getStatus422())
//             );
//         }
//     }
// }

use SysSoftIntegra\Model\EmpresaADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "getempresa") {
        print json_encode(EmpresaADO::ObtenerEmpresa());
        exit();
    } else if ($_GET["type"] == "fillubigeo") {
        print json_encode(EmpresaADO::FiltrarUbigeo($_GET["search"]));
        exit();
    } else if ($_GET["type"] == "indexempresa") {
        print json_encode(EmpresaADO::Index());
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body["idEmpresa"] = $_POST["idEmpresa"];
    $body["txtNumDocumento"] = $_POST["txtNumDocumento"];
    $body["txtRazonSocial"] = $_POST["txtRazonSocial"];
    $body["txtNomComercial"] = $_POST["txtNomComercial"];
    $body["txtDireccion"] = $_POST["txtDireccion"];
    $body["txtTelefono"] = $_POST["txtTelefono"];
    $body["txtCelular"] = $_POST["txtCelular"];
    $body["txtPaginWeb"] = $_POST["txtPaginWeb"];
    $body["txtEmail"] = $_POST["txtEmail"];
    $body["txtTerminos"] = $_POST["txtTerminos"];
    $body["txtCodiciones"] = $_POST["txtCodiciones"];
    $body["cbUbigeo"] = $_POST["cbUbigeo"];

    $body["imageType"] = $_POST["imageType"];
    $body["image"] = $_POST["imageType"] != 0 ? fopen($_FILES['image']['tmp_name'], 'rb') : null;

    $body["txtUsuarioSol"] = $_POST["txtUsuarioSol"];
    $body["txtClaveSol"] = $_POST["txtClaveSol"];
    //    
    $body["certificadoUrl"] = $_POST["certificadoUrl"];
    $body["certificadoType"] = $_POST["certificadoType"];
    $body["certificadoName"] = $_POST["certificadoType"] == 1 ? $_FILES['certificado']['name'] : '';
    $body["certificadoNameTmp"] = $_POST["certificadoType"] == 1 ? $_FILES['certificado']['tmp_name'] : '';

    $body["txtClaveCertificado"] = $_POST["txtClaveCertificado"];

    echo json_encode(EmpresaADO::CrudEmpresa($body));
    exit();
}
