<?php

ini_set('max_execution_time', '300');
ini_set("pcre.backtrack_limit", "10000000");
ini_set('memory_limit', '-1');

include_once('../model/SuministrosADO.php');
require __DIR__ . "/lib/phpspreadsheet/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$inputFileType = 'Xlsx';
$inputFileName = './data.xlsx';

/**  Create a new Reader of the type defined in $inputFileType  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
/**  Advise the Reader that we only want to load cell data  **/
$reader->setReadDataOnly(true);

$array = array();

$worksheetData = $reader->listWorksheetInfo($inputFileName);

foreach ($worksheetData as $worksheet) {

    $sheetName = $worksheet['worksheetName'];

    /**  Load $inputFileName to a Spreadsheet Object  **/
    $reader->setLoadSheetsOnly($sheetName);
    $spreadsheet = $reader->load($inputFileName);

    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();
    array_push($array, $rows);
}


$html = '<table>
<thead>
<tr>
<th>#</th>
<th>Cod. de barras</th>
<th>Cod. Interno</th>
<th>Descripción</th>
<th>Stock mínimo</th>
<th>Stock actual</th>
<th>Costo</th>
<th>Precio de venta</th>
</tr>
</thead>
<tbody>';

$count = 0;

for ($i = 0; $i < count($array); $i++) {
    $row = $array[$i];
    for ($j = 0; $j < count($row); $j++) {
        if ($j > 0) {
            $count++;
            //number_format(round(($venta->SubTotal), 2, PHP_ROUND_HALF_UP), 2, '.', '')
            //<td>'.(str_contains('http',$row[$j][1])?"telachupo": $row[$j][1]).'</td>
            // $html .= '<tr>
            // <td>'.$row[$j][0].'</td>
            // <td>'.(preg_match('/\bhttp\b/',trim($row[$j][1]))? "CB".$count: $row[$j][1]).'</td>
            // <td>'.(preg_match('/\bhttp\b/',trim($row[$j][2]))? "CA".$count: $row[$j][2]).'</td>
            // <td>'.trim(strtoupper($row[$j][3])).'</td>
            // <td>'.number_format(round(($row[$j][5]), 2, PHP_ROUND_HALF_UP), 2, '.', '').'</td>
            // <td>'.number_format(round(($row[$j][6]), 2, PHP_ROUND_HALF_UP), 2, '.', '').'</td>
            // <td>'.number_format(round(($row[$j][7]), 2, PHP_ROUND_HALF_UP), 2, '.', '').'</td>
            // <td>'.number_format(round(($row[$j][9]), 2, PHP_ROUND_HALF_UP), 2, '.', '').'</td>
            // </tr>';
            $suministro["Clave"]  =  $row[$j][1];
            $suministro["ClaveAlterna"] =  "" . $row[$j][2];
            // $suministro["NombreMarca"] = trim(strtoupper($row[$j][3]));
            // $suministro["NombreGenerico"] = "";

            // $suministro["Categoria"] = 24;
            // $suministro["Marca"] = 0;
            // $suministro["Presentacion"] = 0;
            // $suministro["UnidadCompra"] = 58;
            // $suministro["UnidadVenta"] = 3;

            // $suministro["Estado"] = 1;
            $suministro["StockMinimo"] = is_numeric($row[$j][10]) ? round(($row[$j][10]), 2, PHP_ROUND_HALF_UP) : 0;
            $suministro["StockMaximo"] = is_numeric($row[$j][9]) ? round(($row[$j][9]), 2, PHP_ROUND_HALF_UP) : 0;
            $suministro["Cantidad"] = is_numeric($row[$j][8]) ? round(($row[$j][8]), 2, PHP_ROUND_HALF_UP) : 0;

            // $suministro["Impuesto"] = 1;
            // $suministro["TipoPrecio"] = 1;
            $suministro["PrecioCompra"] = is_numeric($row[$j][4]) ? round(($row[$j][4]), 2, PHP_ROUND_HALF_UP) : 0;
            $suministro["PrecioVentaGeneral"] = is_numeric($row[$j][5]) ? round(($row[$j][5]), 2, PHP_ROUND_HALF_UP) : 0;
            // $suministro["Lote"] = 0;
            // $suministro["Inventario"] = 1;
            // $suministro["ValorInventario"] = 1;

            // $suministro["ClaveUnica"] = "";
            // $suministro["Imagen"] = null;

            // $suministro["ListaPrecios"] = array(array(
            //     "nombre" => "Precio 2",
            //     "valor" => is_numeric($row[$j][6]) ? round(($row[$j][6]), 2, PHP_ROUND_HALF_UP) : 0,
            //     "factor" => 1
            // ), array(
            //     "nombre" => "Precio 3",
            //     "valor" => is_numeric($row[$j][7]) ? round(($row[$j][7]), 2, PHP_ROUND_HALF_UP) : 0,
            //     "factor" => 1
            // ));

            // echo $count." - ".$row[$j][0] .'<br>';
            $result = SuministrosADO::RegistrarAlmacenCantidad($suministro,2);
            //         $row[$j][0],
            //         $row[$j][1],
            //         $row[$j][2],
            //         $row[$j][3],
            //         $row[$j][4],
            //         $row[$j][5],
            //         $row[$j][6],
            //         $row[$j][7],
            //         $row[$j][8],
            //         $row[$j][9],
            //         $row[$j][10],
            //         $row[$j][11],
            //         $row[$j][12],
            //         $row[$j][13],
            //         $row[$j][14],
            //         $row[$j][15],
            //         $row[$j][16],
            //         $row[$j][17],
            //         $row[$j][18],
            // ));
            if ($result == "registrado") {
                // echo 'bien<br>';
            } else {
                echo "<h1>'.$result.'</h1>";
            }
        }
    }
}

$html .= '</tbody>
</table>';


echo $html;
