<?php

set_time_limit(300);

use SysSoftIntegra\Model\VentasADO;

require __DIR__ . "/lib/phpspreadsheet/vendor/autoload.php";
require __DIR__ . './../src/autoload.php';

$fechaInicio = $_GET["txtFechaInicial"];
$fechaFinal = $_GET["txtFechaFinal"];

$result = VentasADO::GetReporteGeneralVentas($fechaInicio, $fechaFinal, intval($_GET["facturado"]));
$ventas = $result[0];
$empresa = $result[1];

$montotatal = 0;
$textsunat = "";

foreach ($ventas as $key => $value) {
    $date = date("d/m/Y", strtotime($value["FechaVenta"]));
    $textsunat .= $empresa->NumeroDocumento . "|" .
        trim($value["TipoComprobante"]) . "|" .
        trim($value["Serie"]) . "|" .
        trim($value["Numeracion"]) . "|" .
        $date . "|" .
        number_format(floatval(($value["Base"] + $value["Igv"])), 2, '.', '') . "\n";
}


$fp = fopen("myText.txt", "wb");
fwrite($fp, $textsunat);
fclose($fp);
