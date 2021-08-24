<?php
set_time_limit(300);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use SysSoftIntegra\Src\SoapResult;
use SysSoftIntegra\Src\Sunat;

require __DIR__ . './../../src/autoload.php';

$get['rucSol'] = $_GET["rucSol"];
$get['userSol'] = $_GET["userSol"];
$get['passSol'] = $_GET["passSol"];
$get['ruc'] = $_GET["ruc"];
$get['tipo'] = $_GET["tipo"];
$get['serie'] = $_GET["serie"];
$get['numero'] = $_GET["numero"];
$get['cdr'] = $_GET["cdr"];

$fileDir = __DIR__ . '/../../files';

if (!file_exists($fileDir)) {
    mkdir($fileDir, 0777, true);
}

$soapResult = new SoapResult('../../resources/wsdl/billConsultService.wsdl', $get["ruc"] . "-" . $get["tipo"] . "-" . $get["serie"] . "-" . $get["numero"]);
$soapResult->sendGetStatusCdr(Sunat::xmlGetStatusCdr($get));
echo json_encode(array(
    "state" => true,
    "code" => $soapResult->getCode(),
    "descripcon" => $soapResult->getDescription()
));

// $result = process($get);

// if (isset($result)) {
//     if ($result->isSuccess()) {
//         if (!is_null($result->getCdrResponse())) {
//             if (!is_null($filename)) {
//                 $file = '/files/' . $filename;
//             } else {
//                 $file = "";
//             }
//             echo json_encode(array(
//                 "state" => true,
//                 "code" => 1,
//                 "typecode" => $result->getCode(),
//                 "message" => $result->getMessage(),
//                 "comprobante" => $result->getCdrResponse()->getDescription(),
//                 "descripcon" => $result->getCdrResponse()->getNotes(),
//                 "file" => $file
//             ));
//         } else {
//             echo json_encode(array(
//                 "state" => true,
//                 "code" => 2,
//                 "typecode" => $result->getCode(),
//                 "message" => $result->getMessage(),
//             ));
//         }
//     } else {
//         echo json_encode(array(
//             "state" => true,
//             "code" => 3,
//             "typecode" => $result->getCode(),
//             "message" => $result->getMessage(),
//             "descripcon" => $result->getError()->getMessage()
//         ));
//     }
// } else {
//     echo json_encode(array(
//         "state" => false,
//         "code" => 0,
//         "description" => "Error en la respuesta"
//     ));
// }
