<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use SysSoftIntegra\Model\MovimientoADO;

require __DIR__ . './../src/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "listipomovimiento") {
        $tipomovimientos = MovimientoADO::ListarInventario($_GET["ajuste"], $_GET["all"]);
        if (is_array($tipomovimientos)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $tipomovimientos
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $tipomovimientos
            ));
        }
        exit();
    } else if ($_GET["type"] == "listforidmovimiento") {
        $movimiento = MovimientoADO::ObtenerMovimientoInventarioById($_GET["idMovimiento"]);
        if ($movimiento) {
            print json_encode(array(
                "estado" => 1,
                "data" => $movimiento
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $movimiento
            ));
        }
        exit();
    } else if ($_GET["type"] == "cancelarmovimiento") {
        $result = MovimientoADO::CancelarMovimientoById($_GET["idMovimiento"]);
        if ($result === "deleted") {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Se anuló correctamente el Ajuste."
            ));
        } else if ($result === "exists") {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "El Ajuste ya está anulado."
            ));
        } else {
            print json_encode(array(
                "estado" => 3,
                "mensaje" => $result
            ));
        }
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);

    if ($body["type"] == "insertmovimiento") {
        $result = MovimientoADO::RegistrarMovimientoInventario($body);
        if ($result === "inserted") {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Registrado correctamente el movimiento."
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $result
            ));
        }
        exit();
    } else if ($body["type"] == "restarkardex") {
        $result = MovimientoADO::RestablecerInventario($body);
        if ($result === "inserted") {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Se restableció correctamente el kardex."
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $result
            ));
        }
        exit();
    }
}
