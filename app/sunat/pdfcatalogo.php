<?php

require  './lib/mpdf/vendor/autoload.php';
require  './lib/phpqrcode/vendor/autoload.php';
require  './../src/autoload.php';

use SysSoftIntegra\Model\SuministrosADO;
use SysSoftIntegra\Model\EmpresaADO;
use Mpdf\Mpdf;

$empresa = EmpresaADO::ObtenerEmpresa();
$lista = SuministrosADO::ListarTodosSuministros();

// header('Content-Type: application/json; charset=UTF-8');
// print json_encode(array($empresa, $lista));
// return;


$photo = $empresa->Image == "" ?  '<img src="./../../view/images/logo.png" />' : '<img width="160" src="data:image/(png|jpg|gif);base64, ' . $empresa->Image . '" />';


$html = '<html>
<head>
    <style>
        body{
            color:black;
            font-family: "Arial";
            font-size:10pt;
            
        }

        a{
            text-decoration: none;    
            color:back;       
        }
        

        p{
            text-transform: uppercase;
            padding:0;
            margin:5pt 5pt;
        }
    </style>
</head>
<body>
    <!--mpdf
    <htmlpagefooter name="myfooter">
        <div style="font-size: 9pt; text-align: center; padding-top: 0mm; ">
            Página {PAGENO} de {nb}
        </div>
    </htmlpagefooter>
    <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
    <sethtmlpagefooter name="myfooter" value="on" />
    mpdf-->
        
        <div style="               
        background: rgb(253,190,255);
            background: linear-gradient(top down, rgba(255,226,226,1) 0%, rgba(252,174,182,1) 100%);
        height:100%;
        padding-top:20mm;
        ">

            <div style="text-align: center;margin-bottom:20mm;">' . $photo . '</div>

            <h1 style="text-align: center;">CATALOGO ' . $empresa->NombreComercial . '</h1>

            <h3 style="text-align: center;">01/01/2022</h3>

            <div style="background-color:#f7a5a5;margin-top:20mm;">              
                <p>Razón Social: ' . $empresa->RazonSocial . '</p>
                <p>Email: ' . $empresa->Email . '</p>
                <p>Celular: ' . $empresa->Celular . '</p>
                <p>Pagina Web: ' . $empresa->PaginaWeb . '</p>
            </div>
        </div>  

                    
</body>
</html>
';

$htmlbody = '';

foreach ($lista as $value) {
    $imagen = $value->Imagen == "" ? './../../resource/images/noimage.png' : './../../resource/catalogo/' . $value->Imagen;
    $htmlbody .= '
    <div style="
        width:225px;
        float:left;  
        
        text-align:center;    
        ">
            <img width="150" height="150" src="' .   $imagen . '" />
            <br>
            <br>
            <div style="background-color:#f7a5a5;padding:5px;">
                <h3>' . $value->NombreMarca . '</h3>
                <h3>S/ ' . number_format(round(($value->PrecioVentaGeneral), 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</h3>
            </div>          
        </div>
    ';
}

$html .= '';


$mpdf = new Mpdf([
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 10,
    'margin_bottom' => 10,
    'margin_header' => 10,
    'margin_footer' => 10,
    'mode' => 'utf-8',
    'format' => 'A4',
    'orientation' => 'P'
]);

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Catalogo Leat Sac");
$mpdf->SetAuthor("Syssoft Integra");
$mpdf->SetWatermarkText("");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->useSubstitutions = false;
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);
$mpdf->addPage();
$mpdf->WriteHTML($htmlbody);
// Output a PDF file directly to the browser
$mpdf->Output("catalogo.pdf", 'I');
