<?php

require  './lib/mpdf/vendor/autoload.php';
require  './../src/autoload.php';

use SysSoftIntegra\Model\VentasADO;
use Mpdf\Mpdf;

$procedencia = $_GET["procedencia"];
$fechaInicial = $_GET['fechaInicial'];
$fechaFinal = $_GET['fechaFinal'];
$tipoComprobante = $_GET['tipoComprobante'];
$idCliente = $_GET['idCliente'];
$idVendedor = $_GET['idVendedor'];
$tipoCobro = $_GET['tipoCobro'];
$metodo = $_GET['metodo'];
$idMetodo = $_GET['idMetodo'];

$venta = VentasADO::Sp_Reporte_General_Ventas($procedencia, $fechaInicial, $fechaFinal, $tipoComprobante, $idCliente, $idVendedor, $tipoCobro, $metodo, $idMetodo);

if (!is_array($venta)) {
    return $venta;
}

$html = '<html>
<head>
<style>
    body {
        font-family: Arial;
        font-size: 10pt;
    }

    table tr td, p{
        font-family: Arial;
    }

    table tr td{
        vertical-align: top;
    }
    
    .td-body-left{
        text-align: left;
        padding: 10px;
        width: 50%;
    }

    a {
        color:#969696;
    }

    .td-total-text{
        text-align: left;
        font-size: 12px;
        font-weight: bold;
        padding: 5px 10px;
        width: 50%;
    }

    .td-total-monto{
        text-align: left;
        font-size: 12px;
        padding: 0px 10px 10px 10px;
        width: 50%;
    }

    .td-title-left{
        padding:10px;
        width:50%;
        border-bottom:1px solid #000000;
    }

    .td-title-right{
        padding:10px;
        width:50%;
        text-align:right;
        border-bottom:1px solid #000000;
    }

    .th-table-detailt{
        background-color:black;
        color:white;
        padding:5px 3px 5px 3px;
        font-size:12px;
        border: 1px solid #000000;
    }

    .td-table-detailt{
        padding:5px 10px;
        font-size:12px;
        border-left: 1px solid #000000;
        border-bottom: 1px solid #000000;
    }
    
    .td-table-detailt-end{
        border-right: 1px solid #000000;
    }
</style>
</head>
<body>

    <!--mpdf
    <htmlpageheader name="myheader">
        <table width="100%">
            <tr>
                <td width="50%" style="color:#969696; ">
                    <span style="font-weight: bold; font-size: 9pt;">
                        Generado por <a href="http://syssoftintegra.com/" target="_blank">www.syssoftintegra.com</a>
                    </span>
                </td>
                <td width="50%" style="color:#969696;text-align: right;">
                    <span style="font-weight: bold; font-size: 9pt;">
                        ' . date("d/m/Y") . '
                    </span>
                </td>
            </tr>
        </table>
    </htmlpageheader>
    <htmlpagefooter name="myfooter">
        <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
            Página {PAGENO} de {nb}
        </div>
    </htmlpagefooter>
    <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
    <sethtmlpagefooter name="myfooter" value="on" />
    mpdf-->

    <table width="100%" border="0" cellspacing="0">

        <tr>
            <td class="td-title-left">
                <h3>Reporte General de Ventas</h3>
            </td>

            <td class="td-title-right"> 
                <h4>Periodo: ' . date("d/m/Y", strtotime($fechaInicial)) . ' al ' . date("d/m/Y", strtotime($fechaFinal)) . '</h4>
            </td>
        </tr>

        <tr>
            <td class="td-body-left">
                <span>Documento:</span>
                <span>' . $_GET["nombreComprobante"] . '</span>
            </td>
            
            <td class="td-body-left">
                <span>Tipo:</span>
                <span>' .  $_GET["nombreCobro"]  . '</span>
            </td>
        </tr>

        <tr>
            <td class="td-body-left">
                <span>Cliente:</span>
                <span>' .  $_GET["nombreCliente"]  . '</span>
            </td>
            
            <td class="td-body-left">
                <span>Metodo:</span>
                <span>' .  $_GET["nombreMetodo"] . '</span>
            </td>
        </tr>

        <tr>
            <td class="td-body-left">
                <span>Vendedor:</span>
                <span>' . $_GET["nombreVendedor"]  . '</span>
            </td>
        </tr>
        
    </table>

    <table width="100%" border="0" cellspacing="0">
        <tr>
            <th class="th-table-detailt"> Fecha</th>
            <th class="th-table-detailt"> Cliente</th>
            <th class="th-table-detailt"> Comprobante</th>
            <th class="th-table-detailt"> Tipo de Venta</th>
            <th class="th-table-detailt"> Metodo Cobro</th>
            <th class="th-table-detailt"> Estado</th>
            <th class="th-table-detailt"> Total</th>
        </tr>';

$totalcontado = 0;
$totalcredito = 0;
$totalcreditopagado = 0;
$totalanulado = 0;

$efectivo = 0;
$tarjeta = 0;
$mixto = 0;
$deposito = 0;

foreach ($venta as $value) {
    $html .= '<tr>
            <td class="td-table-detailt">' . date('d/m/Y', strtotime($value["FechaVenta"])) . '</td>
            <td class="td-table-detailt">' . $value["NumeroDocumento"] . '<br>' . $value["Cliente"] . '</td>
            <td class="td-table-detailt">' . $value["Nombre"] . '<br>' . $value["Serie"] . '-' . $value["Numeracion"] . '</td>
            <td class="td-table-detailt">' . $value["TipoName"] . '</td>
            <td class="td-table-detailt">' . $value["FormaName"] . '</td>
            <td class="td-table-detailt">' . $value["EstadoName"] . '</td>
            <td class="td-table-detailt td-table-detailt-end">' . $value["Simbolo"] . ' ' . number_format(round($value["Total"], 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
        </tr>';

    if ($value["IdNotaCredito"] == 1) {
        $totalanulado += $value["Total"];
    } else {
        if ($value["Estado"] == 3) {
            $totalanulado += $value["Total"];
        } else {
            if ($value["Tipo"] == 1 &&  $value["Estado"] == 1 || $value["Tipo"] == 1 &&  $value["Estado"] == 4) {
                $totalcontado += $value["Total"];
            } else if ($value["Tipo"] == 2 &&  $value["Estado"] == 1) {
                $totalcreditopagado += $value["Total"];
            } else {
                $totalcredito += $value["Total"];
            }
        }
    }

    if ($value["IdNotaCredito"] == 0 && $value["Estado"] != 3) {
        if ($value["Estado"] == 2 &&  $value["Estado"] == 1) {
            //                        efectivo += vt.getImporteNeto();
        } else if ($value["Estado"] == 1 ||  $value["Estado"] == 4) {
            if ($value["FormaName"] == "EFECTIVO") {
                $efectivo += $value["Total"];
            } else if ($value["FormaName"] == "TARJETA") {
                $tarjeta += $value["Total"];
            } else if ($value["FormaName"] == "MIXTO") {
                $efectivo += $value["Efectivo"];
                $tarjeta += $value["Tarjeta"];
            } else {
                $deposito += $value["Total"];
            }
        }
    }
}

$html .= '
    </table>

    <br>
    
    <table width="100%" border="0" cellspacing="0">
        <tr>
            <td class="td-total-text">
                <span>VENTAS COBRADAS</span>             
            </td>
        
            <td class="td-total-text">
                <span>EFECTIVO</span>                
            </td>
        </tr>

        <tr>
            <td class="td-total-monto">
                <span>' . number_format(round($totalcreditopagado, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</span>             
            </td>

            <td class="td-total-monto">
                <span>' . number_format(round($efectivo, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</span>             
            </td>
        </tr>

        <tr>
            <td class="td-total-text">
                <span>VENTAS AL CRÉDITO</span>             
            </td>
        
            <td class="td-total-text">
                <span>TARJETA</span>                
            </td>
        </tr>

        <tr>
            <td class="td-total-monto">
                <span>' . number_format(round($totalcredito, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</span>             
            </td>

            <td class="td-total-monto">
                <span>' . number_format(round($tarjeta, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</span>             
            </td>
        </tr>

        <tr>
            <td class="td-total-text">
                <span>VENTAS ANULADAS</span>             
            </td>
        
            <td class="td-total-text">
                <span>DEPOSITO</span>                
            </td>
        </tr>

        <tr>
            <td class="td-total-monto">
                <span>' . number_format(round($totalanulado, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</span>             
            </td>

            <td class="td-total-monto">
                <span>' . number_format(round($deposito, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</span>             
            </td>
        </tr>

        <tr>
            <td class="td-total-text">
                <span>VENTAS AL CONTADO</span>             
            </td>
        </tr>

        <tr>
            <td class="td-total-monto">
                <span>' . number_format(round($totalcontado, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</span>             
            </td>
        </tr>
    </table>

</body>
</html>
';

$mpdf = new Mpdf([
    'margin_left' => 5,
    'margin_right' => 5,
    'margin_top' => 12,
    'margin_bottom' => 12,
    'margin_header' => 5,
    'margin_footer' => 5,
    'mode' => 'utf-8',
    'format' => 'A4',
    'orientation' => 'P'
]);

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Reporte de Ventas");
$mpdf->SetAuthor("Syssoft Integra");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output("Reporte de Ventas.pdf", 'I');
