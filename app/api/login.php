<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

require_once __DIR__ . './../database/DataBaseConexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = json_decode(file_get_contents("php://input"), true);
    $usuario = $body["usuario"];
    $clave = $body["clave"];

    $result = EmpleadoAdo::Login($usuario, $clave);

    if (is_object($result)) {
        echo json_encode(array(
            "state" => 1,
            "empleado" => $result
        ));
    } else if ($result == false) {
        echo json_encode(array(
            "state" => 2,
            "message" => "El usuario o contraseña son incorrectas."
        ));
    } else {
        echo json_encode(array(
            "state" => 0,
            "message" => "Error de conexión del servidor, intente nuevamente en un par de minutos."
        ));
    }
    exit;
}


class EmpleadoAdo
{

    function construct()
    {
    }

    public static function Login($usuario, $clave)
    {
        try {
            $cmdLogin = Database::getInstance()->getDb()->prepare("{CALL Sp_Validar_Ingreso(?,?)}");
            $cmdLogin->bindParam(1, $usuario, PDO::PARAM_STR);
            $cmdLogin->bindParam(2, $clave, PDO::PARAM_STR);
            $cmdLogin->execute();
            $resultLogin = $cmdLogin->fetchObject();
            return $resultLogin;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
