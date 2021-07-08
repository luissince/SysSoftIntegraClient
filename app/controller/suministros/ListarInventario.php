<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/SuministrosADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $producto = $_GET['producto'];
    $existencia = $_GET['existencia'];
    $nombre = $_GET['nombre'];
    $opcion = $_GET['opcion'];
    $categoria = $_GET['categoria'];
    $marca = $_GET['marca'];
    $posicionPagina = $_GET['posicionPagina'];
    $filasPorPagina = $_GET['filasPorPagina'];
    //$search = $_GET['search'];
    $result = SuministrosADO::ListarInventario($producto, $existencia, $nombre, $opcion, $categoria, $marca, $posicionPagina, $filasPorPagina);
    if (is_array($result)) {
        print json_encode(array(
            "estado" => 1,
            "data" => $result[0],
            "total" => $result[1]
        ));
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => $result
        ));
    }
    exit();
}
