<?php

declare(strict_types=1);

namespace Migrate;

use SysSoftIntegra\Src\ConfigHeader;
use PDO;
use Exception;

require __DIR__ . './../src/autoload.php';


class Migrate
{

    function __construct()
    {
        new ConfigHeader();
    }

    public function init()
    {
        try {
            // -----------------------------------------
            // BASE DE DATOS ORIGEN
            // -----------------------------------------
            $pdo = new PDO(
                "sqlsrv:Server=localhost,1433;Database=SysSoftIntegra",
                "sa",
                "123456",
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $cmdTableOrigen = $pdo->prepare("SELECT 
            TABLE_CATALOG,
            TABLE_SCHEMA,
            TABLE_NAME 
            FROM INFORMATION_SCHEMA.TABLES 
            ORDER BY TABLE_NAME ASC");
            $cmdTableOrigen->execute();

            $dbOrigen = array();

            while ($row = $cmdTableOrigen->fetch(PDO::FETCH_OBJ)) {
                $cmdColumn =   $pdo->prepare("SELECT COLUMN_NAME,DATA_TYPE
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA = '$row->TABLE_SCHEMA'
                AND TABLE_NAME = '$row->TABLE_NAME'
                ORDER BY ORDINAL_POSITION");
                $cmdColumn->execute();

                $column = array();
                while ($rowc = $cmdColumn->fetch(PDO::FETCH_OBJ)) {
                    array_push($column, $rowc);
                }

                $array = array();
                array_push($array, $row, $column);

                array_push($dbOrigen, $array);
            }


            // -----------------------------------------
            // BASE DE DATOS DESTINO
            // -----------------------------------------
            $pdo = new PDO(
                "sqlsrv:Server=localhost,1433;Database=Prueba",
                "sa",
                "123456",
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $cmdTableDestino = $pdo->prepare("SELECT 
            TABLE_CATALOG,
            TABLE_SCHEMA,
            TABLE_NAME 
            FROM INFORMATION_SCHEMA.TABLES 
            ORDER BY TABLE_NAME ASC");
            $cmdTableDestino->execute();

            $dbDestino = array();

            while ($row = $cmdTableDestino->fetch(PDO::FETCH_OBJ)) {
                $cmdColumn =   $pdo->prepare("SELECT COLUMN_NAME,DATA_TYPE
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA = '$row->TABLE_SCHEMA'
                AND TABLE_NAME = '$row->TABLE_NAME'
                ORDER BY ORDINAL_POSITION");
                $cmdColumn->execute();

                $column = array();
                while ($rowc = $cmdColumn->fetch(PDO::FETCH_OBJ)) {
                    array_push($column, $rowc);
                }

                $array = array();
                array_push($array, $row, $column);

                array_push($dbDestino, $array);
            }

            foreach ($dbOrigen as  $origin) {
                $obOrigen = $origin;
                $tableOrigen =   $obOrigen[0];
                $columnsOrigen =   $obOrigen[1];
                $filter = array_filter($dbDestino, function ($object) use ($tableOrigen) {
                    echo $object[0]->TABLE_NAME;
                    echo "\n";
                    return array();
                    
                });
                print_r($filter);
                echo "\n";
                // foreach ($dbDestino as $destino){
                // $obDestino = $destino;
                // $tableDestino =   $obDestino[0];
                // $columnsDestino =   $obDestino[1];

                // if($tableOrigen ->TABLE_NAME == $tableDestino->TABLE_NAME){
                // echo $tableDestino->TABLE_NAME;
                // echo "\n";



                // break;
                // }else{
                // echo "TABLA NO EXISTENTE";
                // echo "\n";
                // echo $tableDestino->TABLE_CATALOG."->".$tableDestino->TABLE_NAME;
                // echo "\n";
                // echo "\n";
                // break;
                // }

                // print_r($tableDestino->TABLE_NAME);
            }
            // print_r($table);
            // echo "<br>";
            // }

            // $object = $table[0];

            // echo isset($object[1]) ? "yes":"no";
            // print_r($object[1]);

            // print json_encode($table);
            exit();
        } catch (Exception $ex) {
            // print json_encode($ex);
            exit();
        }
    }
}


$migrate = new Migrate();
$migrate->init();
