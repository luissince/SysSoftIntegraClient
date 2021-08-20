<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use SysSoftIntegra\Model\SuministrosADO;

require __DIR__ . './../src/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if ($_GET["type"] == "listainventario") {
        $producto = $_GET['producto'];
        $existencia = $_GET['existencia'];
        $nombre = $_GET['nombre'];
        $opcion = $_GET['opcion'];
        $categoria = $_GET['categoria'];
        $marca = $_GET['marca'];
        $idAlmacen = $_GET['idAlmacen'];
        $posicionPagina = $_GET['posicionPagina'];
        $filasPorPagina = $_GET['filasPorPagina'];
        //$search = $_GET['search'];
        $result = SuministrosADO::ListarInventario($producto, $existencia, $nombre, $opcion, $categoria, $marca, $idAlmacen, $posicionPagina, $filasPorPagina);
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
    } else if ($_GET["type"] == "modalproductos") {
        $tipo = $_GET["tipo"];
        $value = $_GET["value"];
        $posicionPagina = $_GET["posicionPagina"];
        $filasPorPagina = $_GET["filasPorPagina"];
        //$search = $_GET['search'];
        $suministros = SuministrosADO::ListarSuministroView($tipo, $value, $posicionPagina, $filasPorPagina);
        if (is_array($suministros)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $suministros[0],
                "total" => $suministros[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $suministros
            ));
        }
        exit();
    } else if ($_GET["type"] == "kardexlista") {
        $kardex = SuministrosADO::KardexSuministroById(0, $_GET["idSuministro"], $_GET["idAlmacen"]);
        if (is_array($kardex)) {
            print json_encode(array(
                "estado" => 1,
                "kardex" => $kardex[0],
                "cantidad" => $kardex[1],
                "saldo" => $kardex[2],
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $producto
            ));
        }
        exit();
    } else if ($_GET["type"] == "getproducto") {
        $producto = SuministrosADO::ObtenerSuministroById($_GET["idSuministro"]);
        if (is_array($producto)) {
            print json_encode(array(
                "estado" => 1,
                "suministro" => $producto[0],
                "precios" => $producto[1],
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $producto
            ));
        }
        exit();
    } else if ($_GET["type"] === "listaproductos") {
        $opcion = $_GET["opcion"];
        $clave = $_GET["clave"];
        $nombre = $_GET["nombre"];
        $posicionPagina = $_GET["posicionPagina"];
        $filasPorPagina = $_GET["filasPorPagina"];
        $suministros = SuministrosADO::ListarSuministros(intval($opcion), $clave, $nombre, 0, 0, intval($posicionPagina), intval($filasPorPagina));
        if (is_array($suministros)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $suministros[0],
                "total" => $suministros[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $suministros
            ));
        }
        exit();
    } else if ($_GET["type"] === "impuestos") {
        $impuestos = SuministrosADO::ListarImpuesto();
        if (is_array($impuestos)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $impuestos
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $impuestos
            ));
        }
        exit();
    } else if ($_GET["type"] === "detalles") {
        $detalle = SuministrosADO::ObtenerDetalleId("4", $_GET["mantenimiento"], $_GET["nombre"]);
        if (is_array($detalle)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $detalle
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $detalle
            ));
        }
        exit();
    } else if ($_GET["type"] == "listmovimiento") {
        $init = $_GET["init"];
        $opcion = $_GET["opcion"];
        $movimiento = $_GET["movimiento"];
        $fechaInicial = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];
        $posicionPagina = $_GET['posicionPagina'];
        $filasPorPagina = $_GET['filasPorPagina'];
        $listarMovimiento = SuministrosADO::ListarMoviminentos($init, $opcion, $movimiento, $fechaInicial, $fechaFinal, intval($posicionPagina), intval($filasPorPagina));
        if (is_array($listarMovimiento)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $listarMovimiento[0],
                "total" => $listarMovimiento[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $listarMovimiento
            ));
        }
        exit();
    } else if ($_GET["type"] == "getsuministroformovimiento") {
        $idSuministro = $_GET["idSuministro"];
        //$search = $_GET['search'];
        $suministro = SuministrosADO::ObtenerSuministroForMovimiento($idSuministro);
        if (!is_null($suministro)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $suministro
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $suministro
            ));
        }
        exit();
    } else if ($_GET["type"] == "listallsuministro") {
        $suministro = SuministrosADO::ListarTodosSuministros();
        if (is_array($suministro)) {
            print json_encode(array(
                "estado" => 1,
                "suministros" => $suministro
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $suministro
            ));
        }
        exit();
    } else if ($_GET["type"] == "listallnegativo") {
        $suministro = SuministrosADO::ListarSuministroNegativos();
        if (is_array($suministro)) {
            print json_encode(array(
                "estado" => 1,
                "suministros" => $suministro
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $suministro
            ));
        }
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);

    if ($body["type"] == "updatesuministro") {
        $result = SuministrosADO::ActualizarSuministro($body);
        if ($result === "actualizado") {
            print json_encode(array(
                "estado" => 1,
                "message" => "Se actualizó correctamente el producto."
            ));
        } else if ($result === "noid") {
            print json_encode(array(
                "estado" => 4,
                "message" => "El id del producto fue alterado o no cargo bien los datos, intente nuevamente."
            ));
        } else if ($result === "duplicate") {
            print json_encode(array(
                "estado" => 2,
                "message" => "No se puede haber 2 producto con la misma clave."
            ));
        } else if ($result === "duplicatename") {
            print json_encode(array(
                "estado" => 3,
                "message" => "No se puede haber 2 producto con el mismo nombre."
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "message" => $result,
                "precios" => $body["ListaPrecios"]
            ));
        }
    } else if ($body["type"] == "insertsuministro") {
        $result = SuministrosADO::RegistrarSuministro($body);
        if ($result === "registrado") {
            print json_encode(array(
                "estado" => 1,
                "message" => "Se registró correctamente el producto."
            ));
        } else if ($result === "duplicate") {
            print json_encode(array(
                "estado" => 2,
                "message" => "No se puede haber 2 producto con la misma clave."
            ));
        } else if ($result === "duplicatename") {
            print json_encode(array(
                "estado" => 3,
                "message" => "No se puede haber 2 producto con el mismo nombre."
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "message" => $result,
            ));
        }
    } else if ($body["type"] == "removesuministro") {
        $result = SuministrosADO::EliminarProductoById($body["IdSuministro"]);
        if ($result === "eliminado") {
            print json_encode(array(
                "estado" => 1,
                "message" => "Se elimino correctamente el producto."
            ));
        } else if ($result === "kardex") {
            print json_encode(array(
                "estado" => 2,
                "message" => "No se puede eliminar el producto por que esta asociado a un movimiento de kardex."
            ));
        } else if ($result === "venta") {
            print json_encode(array(
                "estado" => 3,
                "message" => "No se puede eliminar el producto por que esta asociado a una venta."
            ));
        } else if ($result === "compra") {
            print json_encode(array(
                "estado" => 4,
                "message" => "No se puede eliminar el producto por que esta asociado a una compra."
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "message" => $result,
            ));
        }
        exit();
    }
}
