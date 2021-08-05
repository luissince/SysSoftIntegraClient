<?php

set_time_limit(300);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

// use Greenter\Model\Client\Client;
// use Greenter\Model\Company\Company;
// use Greenter\Model\Company\Address;
// use Greenter\Model\Sale\Invoice;
// use Greenter\Model\Sale\SaleDetail;
// use Greenter\Model\Sale\Legend;
// use Greenter\Ws\Services\SunatEndpoints;

require __DIR__ . './../sunat/lib/robrichards/src/xmlseclibs.php';

use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;

// require __DIR__ . './../vendor/autoload.php';
include __DIR__ . './../src/GenerateCoinToLetters.php';
include_once __DIR__ . './../model/VentasADO.php';

// $util = Util::getInstance();
$gcl = new GenerateCoinToLetters();

$idventa = $_GET['idventa'];
$detalleventa = VentasADO::ListarDetalleVentPorId($idventa);

if (!is_array($detalleventa)) {

    echo json_encode(array(
        "state" => false,
        "code" => "-1",
        "description" => $detalleventa
    ));
} else {

    $detalle = $detalleventa[0]['detalle'];
    $empresa = $detalleventa[1];
    $cliente = $detalleventa[2];
    $venta = $detalleventa[3];

    $xml = new DomDocument('1.0', 'utf-8');
    // $xml->standalone         = true;
    $xml->preserveWhiteSpace = false;

    $Invoice = $xml->createElement('Invoice');
    $Invoice = $xml->appendChild($Invoice);

    $Invoice->setAttribute('xmlns', 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2');
    $Invoice->setAttribute('xmlns:cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
    $Invoice->setAttribute('xmlns:cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
    $Invoice->setAttribute('xmlns:ccts', "urn:un:unece:uncefact:documentation:2");
    $Invoice->setAttribute('xmlns:ds', "http://www.w3.org/2000/09/xmldsig#");
    $Invoice->setAttribute('xmlns:ext', "urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2");
    $Invoice->setAttribute('xmlns:qdt', "urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2");
    $Invoice->setAttribute('xmlns:sac', "urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1");
    $Invoice->setAttribute('xmlns:udt', "urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2");
    $Invoice->setAttribute('xmlns:xsi', "http://www.w3.org/2001/XMLSchema-instance");

    $UBLExtension = $xml->createElement('ext:UBLExtensions');
    $UBLExtension = $Invoice->appendChild($UBLExtension);

    $ext = $xml->createElement('ext:UBLExtension');
    $ext = $UBLExtension->appendChild($ext);
    $contents = $xml->createElement('ext:ExtensionContent', ' ');
    $contents = $ext->appendChild($contents);

    $date = new DateTime($venta->FechaVenta . "T" . $venta->HoraVenta);

    //Version de UBL 2.1
    $cbc = $xml->createElement('cbc:UBLVersionID', '2.1');
    $cbc = $Invoice->appendChild($cbc);
    $cbc = $xml->createElement('cbc:CustomizationID', '2.0');
    $cbc = $Invoice->appendChild($cbc);
    $cbc = $xml->createElement('cbc:ID', $venta->Serie . '-' . $venta->Numeracion);  // numero de factura
    $cbc = $Invoice->appendChild($cbc);
    $cbc = $xml->createElement('cbc:IssueDate', $date->format('Y-m-d'));   // fecha de emision
    $cbc = $Invoice->appendChild($cbc);
    $cbc = $xml->createElement('cbc:IssueTime', $date->format('H:i:s'));   // hora de emision
    $cbc = $Invoice->appendChild($cbc);
    $cbc = $xml->createElement('cbc:InvoiceTypeCode', $venta->TipoComprobante);
    $cbc = $Invoice->appendChild($cbc);
    $cbc->setAttribute('listID', "0101");
    $cbc = $xml->createElement('cbc:Note');
    $cbc->appendChild($xml->createCDATASection($gcl->getResult(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP), $venta->NombreMoneda)));
    $cbc = $Invoice->appendChild($cbc);
    $cbc->setAttribute('languageLocaleID', "1000");
    $cbc = $xml->createElement('cbc:DocumentCurrencyCode', $venta->TipoMoneda);
    $cbc = $Invoice->appendChild($cbc);


    // DATOS DE FIRMA
    $cac_signature = $xml->createElement('cac:Signature');
    $cac_signature = $Invoice->appendChild($cac_signature);
    $cbc = $xml->createElement('cbc:ID',  $empresa->NumeroDocumento);
    $cbc = $cac_signature->appendChild($cbc);
    $cac_signatory = $xml->createElement('cac:SignatoryParty');
    $cac_signatory = $cac_signature->appendChild($cac_signatory);
    $cac = $xml->createElement('cac:PartyIdentification');
    $cac = $cac_signatory->appendChild($cac);
    $cbc = $xml->createElement('cbc:ID',  $empresa->NumeroDocumento);
    $cbc = $cac->appendChild($cbc);
    $cac = $xml->createElement('cac:PartyName');
    $cac = $cac_signatory->appendChild($cac);
    $cbc = $xml->createElement('cbc:Name');
    $cbc->appendChild($xml->createCDATASection($empresa->RazonSocial));
    $cbc = $cac->appendChild($cbc);
    $cac = $xml->createElement('cac:ExternalReference');
    $cac_digital = $xml->createElement('cac:DigitalSignatureAttachment');
    $cac_digital = $cac_signature->appendChild($cac_digital);
    $cac = $cac_digital->appendChild($cac);
    $cbc = $xml->createElement('cbc:URI', '#SysSoftIntegra');
    $cbc = $cac->appendChild($cbc);

    // DATOS EMISOR
    $cac_SupplierParty = $xml->createElement('cac:AccountingSupplierParty');
    $cac_SupplierParty = $Invoice->appendChild($cac_SupplierParty);
    $cac_party = $xml->createElement('cac:Party');
    $cac_party = $cac_SupplierParty->appendChild($cac_party);
    $PartyIdentification = $xml->createElement('cac:PartyIdentification');
    $PartyIdentification = $cac_party->appendChild($PartyIdentification);
    $cbc = $xml->createElement('cbc:ID', $empresa->NumeroDocumento);
    $cbc->setAttribute('schemeID', "6");
    $cbc = $PartyIdentification->appendChild($cbc);
    $PartyName = $xml->createElement('cac:PartyName');
    $PartyName = $cac_party->appendChild($PartyName);
    $cbc = $xml->createElement('cbc:Name');
    $cbc->appendChild($xml->createCDATASection($empresa->NombreComercial));
    $cbc = $PartyName->appendChild($cbc);
    $PartyLegalEntity = $xml->createElement('cac:PartyLegalEntity');
    $PartyLegalEntity = $cac_party->appendChild($PartyLegalEntity);
    $cbc = $xml->createElement('cbc:RegistrationName');
    $cbc->appendChild($xml->createCDATASection($empresa->RazonSocial));
    $cbc = $PartyLegalEntity->appendChild($cbc);
    $RegistrationAddress = $xml->createElement('cac:RegistrationAddress');
    $RegistrationAddress = $PartyLegalEntity->appendChild($RegistrationAddress);
    $cbc = $xml->createElement('cbc:ID', $empresa->CodigoUbigeo);
    $cbc = $RegistrationAddress->appendChild($cbc);
    $cbc = $xml->createElement('cbc:AddressTypeCode', "0000");
    $cbc = $RegistrationAddress->appendChild($cbc);
    $cbc = $xml->createElement('cbc:CityName', $empresa->Provincia);
    $cbc = $RegistrationAddress->appendChild($cbc);
    $cbc = $xml->createElement('cbc:CountrySubentity', $empresa->Departamento);
    $cbc = $RegistrationAddress->appendChild($cbc);
    $cbc = $xml->createElement('cbc:District', $empresa->Distrito);
    $cbc = $RegistrationAddress->appendChild($cbc);
    $AddressLine = $xml->createElement('cac:AddressLine');
    $AddressLine = $RegistrationAddress->appendChild($AddressLine);
    $cbc = $xml->createElement('cbc:Line');
    $cbc->appendChild($xml->createCDATASection($empresa->Domicilio));
    $cbc = $AddressLine->appendChild($cbc);
    $CountryLine = $xml->createElement('cac:Country');
    $CountryLine = $RegistrationAddress->appendChild($CountryLine);
    $cbc = $xml->createElement('cbc:IdentificationCode', "PE");
    $cbc = $CountryLine->appendChild($cbc);

    // DATOS DEL CLIENTE
    $cac_CustomerParty = $xml->createElement('cac:AccountingCustomerParty');
    $cac_CustomerParty = $Invoice->appendChild($cac_CustomerParty);
    $cac_party = $xml->createElement('cac:Party');
    $cac_party = $cac_CustomerParty->appendChild($cac_party);
    $PartyIdentification = $xml->createElement('cac:PartyIdentification');
    $PartyIdentification = $cac_party->appendChild($PartyIdentification);
    $cbc = $xml->createElement('cbc:ID', $cliente->NumeroDocumento);
    $cbc->setAttribute('schemeID', $cliente->IdAuxiliar);
    $cbc = $PartyIdentification->appendChild($cbc);
    $PartyLegalEntity = $xml->createElement('cac:PartyLegalEntity');
    $PartyLegalEntity = $cac_party->appendChild($PartyLegalEntity);
    $cbc = $xml->createElement('cbc:RegistrationName');
    $cbc->appendChild($xml->createCDATASection($cliente->Informacion));
    $cbc = $PartyLegalEntity->appendChild($cbc);

    //FORMA PAGO
    $PaymentTerms = $xml->createElement('cac:PaymentTerms'); //
    $PaymentTerms = $Invoice->appendChild($PaymentTerms);
    $cbc = $xml->createElement('cbc:ID', "FormaPago");
    $cbc = $PaymentTerms->appendChild($cbc);
    $cbc = $xml->createElement('cbc:PaymentMeansID', "Contado");
    $cbc = $PaymentTerms->appendChild($cbc);

    /// TOTALES 
    $cac_TaxTotal = $xml->createElement('cac:TaxTotal');
    $cac_TaxTotal = $Invoice->appendChild($cac_TaxTotal);
    $cbc = $xml->createElement('cbc:TaxAmount', number_format(round($detalleventa[0]['totalimpuesto'], 2, PHP_ROUND_HALF_UP), 2, '.', ''));
    $cbc->setAttribute('currencyID', $venta->TipoMoneda);
    $cbc = $cac_TaxTotal->appendChild($cbc);

    if ($detalleventa[0]['totalimpuesto'] > 0) {
        $cac_TaxSubtotal = $xml->createElement('cac:TaxSubtotal');
        $cac_TaxSubtotal = $cac_TaxTotal->appendChild($cac_TaxSubtotal);
        $cbc = $xml->createElement('cbc:TaxableAmount', number_format(round($detalleventa[0]['opgravada'], 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc = $cac_TaxSubtotal->appendChild($cbc);
        $cbc->setAttribute('currencyID', $venta->TipoMoneda);
        $cbc = $xml->createElement('cbc:TaxAmount', number_format(round($detalleventa[0]['totalimpuesto'], 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc = $cac_TaxSubtotal->appendChild($cbc);
        $cbc->setAttribute('currencyID', $venta->TipoMoneda);
        $cac_TaxCategory = $xml->createElement('cac:TaxCategory');
        $cac_TaxCategory = $cac_TaxSubtotal->appendChild($cac_TaxCategory);
        $cac_TaxScheme = $xml->createElement('cac:TaxScheme');
        $cac_TaxScheme = $cac_TaxCategory->appendChild($cac_TaxScheme);
        $cbc = $xml->createElement('cbc:ID', '1000');
        $cbc = $cac_TaxScheme->appendChild($cbc);
        $cbc = $xml->createElement('cbc:Name', 'IGV');
        $cbc = $cac_TaxScheme->appendChild($cbc);
        $cbc = $xml->createElement('cbc:TaxTypeCode', 'VAT');
        $cbc = $cac_TaxScheme->appendChild($cbc);
    } else {

        $cac_TaxSubtotal = $xml->createElement('cac:TaxSubtotal');
        $cac_TaxSubtotal = $cac_TaxTotal->appendChild($cac_TaxSubtotal);
        $cbc = $xml->createElement('cbc:TaxableAmount', number_format(round($detalleventa[0]['opexonerada'], 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc = $cac_TaxSubtotal->appendChild($cbc);
        $cbc->setAttribute('currencyID', $venta->TipoMoneda);
        $cbc = $xml->createElement('cbc:TaxAmount', number_format(round($detalleventa[0]['totalimpuesto'], 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc = $cac_TaxSubtotal->appendChild($cbc);
        $cbc->setAttribute('currencyID', $venta->TipoMoneda);
        $cac_TaxCategory = $xml->createElement('cac:TaxCategory');
        $cac_TaxCategory = $cac_TaxSubtotal->appendChild($cac_TaxCategory);
        $cac_TaxScheme = $xml->createElement('cac:TaxScheme');
        $cac_TaxScheme = $cac_TaxCategory->appendChild($cac_TaxScheme);
        $cbc = $xml->createElement('cbc:ID', '9997');
        $cbc = $cac_TaxScheme->appendChild($cbc);
        $cbc = $xml->createElement('cbc:Name', 'EXO');
        $cbc = $cac_TaxScheme->appendChild($cbc);
        $cbc = $xml->createElement('cbc:TaxTypeCode', 'VAT');
        $cbc = $cac_TaxScheme->appendChild($cbc);
    }

    // LEGAL MONETARY TOTAL  
    $cac_LegalMonetaryTotal = $xml->createElement('cac:LegalMonetaryTotal');
    $cac_LegalMonetaryTotal = $Invoice->appendChild($cac_LegalMonetaryTotal);
    $cbc = $xml->createElement('cbc:LineExtensionAmount', number_format(round($detalleventa[0]['totalsinimpuesto'], 2, PHP_ROUND_HALF_UP), 2, '.', '')); //
    $cbc = $cac_LegalMonetaryTotal->appendChild($cbc);
    $cbc->setAttribute('currencyID',  $venta->TipoMoneda);
    $cbc = $xml->createElement('cbc:TaxInclusiveAmount', number_format(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP), 2, '.', ''));
    $cbc = $cac_LegalMonetaryTotal->appendChild($cbc);
    $cbc->setAttribute('currencyID',  $venta->TipoMoneda);
    $cbc = $xml->createElement('cbc:PayableAmount', number_format(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP), 2, '.', '')); //
    $cbc = $cac_LegalMonetaryTotal->appendChild($cbc);
    $cbc->setAttribute('currencyID',  $venta->TipoMoneda);

    $idlinea = 0;
    foreach ($detalle as $value) {
        $idlinea++;
        $cantidad = $value['Cantidad'];
        $impuesto = $value['ValorImpuesto'];
        $precioVenta = $value['PrecioVenta'];

        $precioBruto = $precioVenta / (($impuesto / 100.00) + 1);
        $impuestoGenerado = $precioBruto * ($impuesto / 100.00);

        $impuestoTotal = $impuestoGenerado * $cantidad;
        $importeBrutoTotal = $precioBruto * $cantidad;

        $importeNeto = $precioBruto + $impuestoGenerado;
        $importeNetoTotal = $importeBrutoTotal + $impuestoTotal;

        $InvoiceLine = $xml->createElement('cac:InvoiceLine');
        $InvoiceLine = $Invoice->appendChild($InvoiceLine);
        $cbc = $xml->createElement('cbc:ID', $idlinea);
        $cbc = $InvoiceLine->appendChild($cbc);
        $cbc = $xml->createElement('cbc:InvoicedQuantity', number_format(round($cantidad, 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc = $InvoiceLine->appendChild($cbc);
        $cbc->setAttribute('unitCode', "NIU");
        $cbc = $xml->createElement('cbc:LineExtensionAmount', number_format(round($importeBrutoTotal, 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc = $InvoiceLine->appendChild($cbc);
        $cbc->setAttribute('currencyID', $venta->TipoMoneda);
        $pricing = $xml->createElement('cac:PricingReference');
        $pricing = $InvoiceLine->appendChild($pricing);
        $cac = $xml->createElement('cac:AlternativeConditionPrice');
        $cac = $pricing->appendChild($cac);
        $cbc = $xml->createElement('cbc:PriceAmount', number_format(round($importeNeto, 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc = $cac->appendChild($cbc);
        $cbc->setAttribute('currencyID', $venta->TipoMoneda);
        $cbc = $xml->createElement('cbc:PriceTypeCode', '01');
        $cbc = $cac->appendChild($cbc);

        $taxtotal = $xml->createElement('cac:TaxTotal');
        $taxtotal = $InvoiceLine->appendChild($taxtotal);
        $cbc = $xml->createElement('cbc:TaxAmount', number_format(round($impuestoTotal, 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc = $taxtotal->appendChild($cbc);
        $cbc->setAttribute('currencyID', $venta->TipoMoneda);
        $taxtsubtotal = $xml->createElement('cac:TaxSubtotal');
        $taxtsubtotal = $taxtotal->appendChild($taxtsubtotal);
        $cbc = $xml->createElement('cbc:TaxableAmount', number_format(round($importeBrutoTotal, 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc = $taxtsubtotal->appendChild($cbc);
        $cbc->setAttribute('currencyID', $venta->TipoMoneda);
        $cbc = $xml->createElement('cbc:TaxAmount', number_format(round($impuestoTotal, 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc = $taxtsubtotal->appendChild($cbc);
        $cbc->setAttribute('currencyID', $venta->TipoMoneda);
        $taxtcategory = $xml->createElement('cac:TaxCategory');
        $taxtcategory = $taxtsubtotal->appendChild($taxtcategory);
        $cbc = $xml->createElement('cbc:Percent', round($impuesto, 0, PHP_ROUND_HALF_UP));
        $cbc = $taxtcategory->appendChild($cbc);
        $cbc = $xml->createElement('cbc:TaxExemptionReasonCode', $value["Codigo"]);
        $cbc = $taxtcategory->appendChild($cbc);


        if ($value["Codigo"] == '10') {
            $igvcod = 'VAT';
            $igvnum = '1000';
            $igvname = 'IGV';
        } else {
            $igvcod = 'VAT';
            $igvnum = '9997';
            $igvname = 'EXO';
        }

        $taxscheme = $xml->createElement('cac:TaxScheme');
        $taxscheme = $taxtcategory->appendChild($taxscheme);
        $cbc = $xml->createElement('cbc:ID', $igvnum);
        $cbc = $taxscheme->appendChild($cbc);
        $cbc = $xml->createElement('cbc:Name', $igvname);
        $cbc = $taxscheme->appendChild($cbc);
        $cbc = $xml->createElement('cbc:TaxTypeCode', $igvcod);
        $cbc = $taxscheme->appendChild($cbc);

        $item = $xml->createElement('cac:Item');
        $item = $InvoiceLine->appendChild($item);
        $cbc = $xml->createElement('cbc:Description');
        $cbc->appendChild($xml->createCDATASection($value['NombreMarca']));
        $cbc = $item->appendChild($cbc);
        $price = $xml->createElement('cac:Price');
        $price = $InvoiceLine->appendChild($price);
        $cbc = $xml->createElement('cbc:PriceAmount', number_format(round($precioBruto, 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc = $price->appendChild($cbc);
        $cbc->setAttribute('currencyID', $venta->TipoMoneda);
    }

    //CREAR ARCHIVO
    $xml->formatOutput = true;
    $strings_xml       = $xml->saveXML();

    $filename = $empresa->NumeroDocumento . '-' . $venta->TipoComprobante . '-' . $venta->Serie . '-' . $venta->Numeracion;
    $xml->save('../files/' . $filename . '.xml');
    chmod('../files/' . $filename . '.xml', 0777);


    $doc = new DOMDocument();
    $doc->load('./../files/' . $filename . '.xml');

    $objDSig = new XMLSecurityDSig();
    $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
    $objDSig->addReference(
        $doc,
        XMLSecurityDSig::SHA1,
        array('http://www.w3.org/2000/09/xmldsig#enveloped-signature'),
        array('force_uri' => true)
    );


    $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'private'));

    $objKey->loadKey('./../resources/private_key.pem', true);
    $objDSig->sign($objKey);
    $objDSig->add509Cert(file_get_contents('./../resources/public_key.pem'), true, false, array('subjectName' => true));
    $objDSig->appendSignature($doc->getElementsByTagName('ExtensionContent')->item(0));


    $doc->save('../files/' . $filename . '.xml');
    chmod('../files/' . $filename . '.xml', 0777);

    ## Creación del archivo .ZIP
    $zip = new ZipArchive();
    $zip->open("../files/" . $filename . ".zip", ZipArchive::CREATE);
    $zip->addFile("../files/" . $filename . ".xml", "" . $filename . ".xml");
    $zip->close();


    # Procedimiento para enviar comprobante a la SUNAT
    class feedSoap extends SoapClient
    {
        public $XMLStr = "";
        public function setXMLStr($value)
        {
            $this->XMLStr = $value;
        }
        public function getXMLStr()
        {
            return $this->XMLStr;
        }
        public function __doRequest($request, $location, $action, $version, $one_way = 0)
        {
            $request = $this->XMLStr;
            $dom = new DOMDocument('1.0');
            try {
                $dom->loadXML($request);
            } catch (DOMException $e) {
                die($e->code);
            }
            $request = $dom->saveXML();
            //Solicitud
            return parent::__doRequest($request, $location, $action, $version, $one_way = 0);
        }
        public function SoapClientCall($SOAPXML)
        {
            return $this->setXMLStr($SOAPXML);
        }
    }

    function soapCall($url, $callFunction = "", $XMLString)
    {
        $client = new feedSoap($url, array('trace' => true));
        $client->SoapClientCall($XMLString);
        $client->__call("$callFunction", array(), array());
        return $client->__getLastResponse();
    }


    //Estructura del XML para la conexión
    $XMLString = '<?xml version="1.0" encoding="UTF-8"?>
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.sunat.gob.pe" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
    <soapenv:Header>
        <wsse:Security>
            <wsse:UsernameToken Id="ABC-123">
                <wsse:Username>' . $empresa->NumeroDocumento . '' . $empresa->UsuarioSol . '</wsse:Username>
                <wsse:Password>' . $empresa->ClaveSol . '</wsse:Password>
            </wsse:UsernameToken>
        </wsse:Security>
    </soapenv:Header>
    <soapenv:Body>
        <ser:sendBill>
            <fileName>' . $filename . '.zip</fileName>
            <contentFile>' . base64_encode(file_get_contents('../files/' . $filename . '.zip')) . '</contentFile>
        </ser:sendBill>
    </soapenv:Body>
    </soapenv:Envelope>';

    //URL para enviar las solicitudes a SUNAT
    //$wsdlURL = 'https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService?wsdl';   // pra pruebas beta
    $wsdlURL = 'billService.wsdl'; // para produccion

    //Realizamos la llamada a nuestra función
    try {
        $result = soapCall($wsdlURL, $callFunction = "sendBill", $XMLString);

        //Descargamos el Archivo Response
        $archivo = fopen('C' . $filename . '.xml', 'w+');
        fputs($archivo, $result);
        fclose($archivo);

        //LEEMOS EL ARCHIVO XML*
        $xml = simplexml_load_file('C' . $filename . '.xml');
        foreach ($xml->xpath('//applicationResponse') as $response) {
        }

        //AQUI DESCARGAMOS EL ARCHIVO CDR(CONSTANCIA DE RECEPCIÓN)
        $cdr = base64_decode($response);
        $archivo = fopen('../files/R-' . $filename . '.zip', 'w+');
        fputs($archivo, $cdr);
        fclose($archivo);
        chmod('../files/R-' . $filename . '.zip', 0777);

        $zip = new ZipArchive();
        $zip->open('../files/R-' . $filename . '.zip');
        $zip->extractTo('../files/');
        $zip->close();

        $xml = file_get_contents('../files/R-' . $filename . '.xml');
        $DOM = new DOMDocument('1.0', 'ISO-8859-1');
        $DOM->preserveWhiteSpace = FALSE;
        $DOM->loadXML($xml);

        $DocXML = $DOM->getElementsByTagName('ResponseCode');
        $description = "";
        foreach ($DocXML as $Nodo) {
            $code = $Nodo->nodeValue;
        }

        $DocXML = $DOM->getElementsByTagName('Description');
        $description = "";
        foreach ($DocXML as $Nodo) {
            $description = $Nodo->nodeValue;
        }

        $DocXML = $DOM->getElementsByTagName('DigestValue');
        $hashCode = "";
        foreach ($DocXML as $Nodo) {
            $hashCode = $Nodo->nodeValue;
        }

        unlink('C' . $filename . '.xml');
        unlink('../files/' . $filename . '.zip');

        echo json_encode(array(
            "state" => true,
            "code" => $code,
            "description" => $description
        ));
    } catch (Exception $ex) {
        echo json_encode(array(
            "state" => false,
            "code" => "0",
            "description" => $ex->getMessage()
        ));
    }









    // Cliente
    // $client = new Client();
    // $client->setTipoDoc($cliente->IdAuxiliar)
    //     ->setNumDoc($cliente->NumeroDocumento)
    //     ->setRznSocial($cliente->Informacion);

    // // Empresa

    // $company = new Company();
    // $company->setRuc($empresa->NumeroDocumento)
    //     ->setNombreComercial($empresa->NombreComercial)
    //     ->setRazonSocial($empresa->RazonSocial)
    //     ->setAddress((new Address())
    //         ->setUbigueo($empresa->CodigoUbigeo)
    //         ->setDistrito($empresa->Distrito)
    //         ->setProvincia($empresa->Provincia)
    //         ->setDepartamento($empresa->Departamento)
    //         ->setUrbanizacion('')
    //         ->setCodLocal('0000')
    //         ->setDireccion($empresa->Domicilio))
    //     ->setEmail($empresa->Telefono)
    //     ->setTelephone($empresa->Email);

    // // Venta
    // $invoice = new Invoice();
    // $invoice
    //     ->setUblVersion('2.1')
    //     ->setTipoOperacion('0101')
    //     ->setTipoDoc($venta->TipoComprobante)
    //     ->setSerie($venta->Serie)
    //     ->setCorrelativo($venta->Numeracion)
    //     ->setFechaEmision(new DateTime($venta->FechaVenta . "T" . $venta->HoraVenta))
    //     ->setTipoMoneda($venta->TipoMoneda)
    //     ->setCompany($company)
    //     ->setClient($client)
    //     ->setMtoOperExoneradas(round($detalleventa[0]['opexonerada'], 2, PHP_ROUND_HALF_UP))
    //     ->setMtoOperGravadas(round($detalleventa[0]['opgravada'], 2, PHP_ROUND_HALF_UP)) //5.10
    //     ->setMtoIGV(round($detalleventa[0]['totalimpuesto'], 2, PHP_ROUND_HALF_UP)) //0.92
    //     ->setTotalImpuestos(round($detalleventa[0]['totalimpuesto'], 2, PHP_ROUND_HALF_UP)) //0.92
    //     ->setValorVenta(round($detalleventa[0]['totalsinimpuesto'], 2, PHP_ROUND_HALF_UP)) //5.10
    //     ->setSubTotal(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP)) //6
    //     ->setMtoImpVenta(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP)) //6
    // ;

    // $detail = [];

    // foreach ($detalle as $value) {
    //     $cantidad = $value['Cantidad'];
    //     $impuesto = $value['ValorImpuesto'];
    //     $precioVenta = $value['PrecioVenta'];

    //     $precioBruto = $precioVenta / (($impuesto / 100.00) + 1);
    //     $impuestoGenerado = $precioBruto * ($impuesto / 100.00);
    //     $impuestoTotal = $impuestoGenerado * $cantidad;
    //     $importeBrutoTotal = $precioBruto * $cantidad;
    //     $importeNeto = $precioBruto + $impuestoGenerado;
    //     $importeNetoTotal = $importeBrutoTotal + $impuestoTotal;

    //     $item1 = new SaleDetail();
    //     $item1->setCodProducto($value['ClaveSat'])
    //         ->setUnidad($value['CodigoUnidad'])
    //         ->setCantidad(round($cantidad, 2, PHP_ROUND_HALF_UP))
    //         ->setDescripcion($value['NombreMarca'])
    //         ->setMtoBaseIgv($importeBrutoTotal) //18 50*2
    //         ->setPorcentajeIgv(round($impuesto, 0, PHP_ROUND_HALF_UP))
    //         ->setIgv($impuestoTotal)
    //         ->setTipAfeIgv($value["Codigo"])
    //         ->setTotalImpuestos($impuestoTotal)
    //         ->setMtoValorVenta($importeBrutoTotal)
    //         ->setMtoValorUnitario(round($precioBruto, 2, PHP_ROUND_HALF_UP))
    //         ->setMtoPrecioUnitario($importeNeto);
    //     array_push($detail, $item1);
    // }

    // $legend = new Legend();
    // $legend->setCode('1000')
    //     ->setValue($util->ConvertirNumerosLetras(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP), $venta->NombreMoneda));

    // $invoice->setDetails($detail)
    //     ->setLegends([$legend]);

    // // Envio a SUNAT.
    // //FE_BETA
    // //FE_PRODUCCION
    // $point = SunatEndpoints::FE_PRODUCCION;
    // $see = $util->getSee($point, $empresa->NumeroDocumento, $empresa->UsuarioSol, $empresa->ClaveSol);
    // $res = $see->send($invoice);
    // $util->writeXml($invoice, $see->getFactory()->getLastXml());
    // $hash = $util->getHashCode($invoice);

    // if ($res->isSuccess()) {
    //     $cdr = $res->getCdrResponse();
    //     $util->writeCdr($invoice, $res->getCdrZip());
    //     // $util->showResponse($invoice, $cdr);
    //     if ($cdr->isAccepted()) {
    //         VentasADO::CambiarEstadoSunatVenta($idventa, $cdr->getCode(), $cdr->getDescription(), $hash, $see->getFactory()->getLastXml());
    //         echo json_encode(array(
    //             "state" => $res->isSuccess(),
    //             "accept" => $cdr->isAccepted(),
    //             "id" => $cdr->getId(),
    //             "code" => $cdr->getCode(),
    //             "description" => $cdr->getDescription()
    //         ));
    //     } else {
    //         VentasADO::CambiarEstadoSunatVenta($idventa, $cdr->getCode(), $cdr->getDescription(), $hash, $see->getFactory()->getLastXml());
    //         echo json_encode(array(
    //             "state" => $res->isSuccess(),
    //             "accept" => $cdr->isAccepted(),
    //             "id" => $cdr->getId(),
    //             "code" => $cdr->getCode(),
    //             "description" => $cdr->getDescription()
    //         ));
    //     }
    //     exit();
    // } else {

    //     if ($res->getError()->getCode() === "1033") {
    //         VentasADO::CambiarEstadoSunatVentaUnico($idventa, "0", $res->getError()->getMessage(), $hash);
    //         echo json_encode(array(
    //             "state" => false,
    //             "code" => $res->getError()->getCode(),
    //             "description" => $res->getError()->getMessage()
    //         ));
    //     } else {
    //         VentasADO::CambiarEstadoSunatVenta($idventa, $res->getError()->getCode(), $res->getError()->getMessage(), $hash, $see->getFactory()->getLastXml());
    //         echo json_encode(array(
    //             "state" => false,
    //             "code" => $res->getError()->getCode(),
    //             "description" => $res->getError()->getMessage()
    //         ));
    //     }
    //     exit();
    // }
}
