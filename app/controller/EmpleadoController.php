<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use SysSoftIntegra\Model\EmpleadoADO;

require __DIR__ . './../src/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "login") {
        $usuario = $_GET['usuario'];
        $clave = $_GET['clave'];
        $result = EmpleadoADO::Login($usuario, $clave);
        if (is_object($result)) {
            session_start();
            $_SESSION["IdEmpleado"] = $result->IdEmpleado;
            $_SESSION["Nombres"] = $result->Nombres;
            $_SESSION["Apellidos"] = $result->Apellidos;
            $_SESSION["Estado"] = $result->Estado;
            $_SESSION["Rol"] = $result->Rol;
            $_SESSION["RolName"] = $result->RolName;
            echo json_encode(array(
                "estado" => 1,
                "empleado" => $result
            ));
        } else if ($result == false) {
            echo json_encode(array(
                "estado" => 2,
                "message" => "Usuario o contraseña incorrecta."
            ));
        } else {
            echo json_encode(array(
                "estado" => 0,
                "message" => $result
            ));
        }
        exit();
    } else if ($_GET["type"] == "predeterminate") {
        echo json_encode(EmpleadoADO::GetClientePredetermined());
        exit();
    } else if ($_GET["type"] == "GetListEmpleados") {
        echo json_encode(EmpleadoADO::GetListEmpleados());
        exit();
    } else if ($_GET["type"] == "fillempleado") {
        echo json_encode(EmpleadoADO::FillEmpleados($_GET["search"]));
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}
