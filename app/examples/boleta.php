<?php

set_time_limit(300);

use SysSoftIntegra\Src\SoapResult;
use SysSoftIntegra\Src\Sunat;
use SysSoftIntegra\Src\NumberLleters;
use SysSoftIntegra\Model\VentasADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

$idventa = $_GET['idventa'];
$detalleventa = VentasADO::ListarDetalleVentPorId($idventa);
$gcl = new NumberLleters();

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
    $credito = $detalleventa[5];

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
    if ($venta->Tipo == 2) {
        if ($venta->TipoCredito == 1) {
            $PaymentTerms = $xml->createElement('cac:PaymentTerms');
            $PaymentTerms = $Invoice->appendChild($PaymentTerms);
            $cbc = $xml->createElement('cbc:ID', "FormaPago");
            $cbc = $PaymentTerms->appendChild($cbc);
            $cbc = $xml->createElement('cbc:PaymentMeansID', "Credito");
            $cbc = $PaymentTerms->appendChild($cbc);
            $cbc = $xml->createElement('cbc:Amount', number_format(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP), 2, '.', ''));
            $cbc->setAttribute('currencyID', $venta->TipoMoneda);
            $cbc = $PaymentTerms->appendChild($cbc);

            $countPm = 0;
            foreach ($credito as $value) {
                $countPm++;
                $cuotaV = $countPm <= 9 ? "Cuota00" . $countPm : "Cuota" . $countPm;
                $PaymentTerms = $xml->createElement('cac:PaymentTerms');
                $PaymentTerms = $Invoice->appendChild($PaymentTerms);
                $cbc = $xml->createElement('cbc:ID', "FormaPago");
                $cbc = $PaymentTerms->appendChild($cbc);
                $cbc = $xml->createElement('cbc:PaymentMeansID', $cuotaV);
                $cbc = $PaymentTerms->appendChild($cbc);
                $cbc = $xml->createElement('cbc:Amount', number_format(round($value->Monto, 2, PHP_ROUND_HALF_UP), 2, '.', ''));
                $cbc->setAttribute('currencyID', $venta->TipoMoneda);
                $cbc = $PaymentTerms->appendChild($cbc);
                $cbc = $xml->createElement('cbc:PaymentDueDate', date("Y-m-d", strtotime($value->FechaPago)));
                $cbc = $PaymentTerms->appendChild($cbc);
            }
        } else {
            $PaymentTerms = $xml->createElement('cac:PaymentTerms');
            $PaymentTerms = $Invoice->appendChild($PaymentTerms);
            $cbc = $xml->createElement('cbc:ID', "FormaPago");
            $cbc = $PaymentTerms->appendChild($cbc);
            $cbc = $xml->createElement('cbc:PaymentMeansID', "Credito");
            $cbc = $PaymentTerms->appendChild($cbc);
            $cbc = $xml->createElement('cbc:Amount', number_format(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP), 2, '.', ''));
            $cbc->setAttribute('currencyID', $venta->TipoMoneda);
            $cbc = $PaymentTerms->appendChild($cbc);

            $PaymentTerms = $xml->createElement('cac:PaymentTerms');
            $PaymentTerms = $Invoice->appendChild($PaymentTerms);
            $cbc = $xml->createElement('cbc:ID', "FormaPago");
            $cbc = $PaymentTerms->appendChild($cbc);
            $cbc = $xml->createElement('cbc:PaymentMeansID', "Cuota001");
            $cbc = $PaymentTerms->appendChild($cbc);
            $cbc = $xml->createElement('cbc:Amount', number_format(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP), 2, '.', ''));
            $cbc->setAttribute('currencyID', $venta->TipoMoneda);
            $cbc = $PaymentTerms->appendChild($cbc);
            $cbc = $xml->createElement('cbc:PaymentDueDate', date("Y-m-d", strtotime($venta->FechaVencimiento)));
            $cbc = $PaymentTerms->appendChild($cbc);
        }
    } else {
        $PaymentTerms = $xml->createElement('cac:PaymentTerms');
        $PaymentTerms = $Invoice->appendChild($PaymentTerms);
        $cbc = $xml->createElement('cbc:ID', "FormaPago");
        $cbc = $PaymentTerms->appendChild($cbc);
        $cbc = $xml->createElement('cbc:PaymentMeansID', "Contado");
        $cbc = $PaymentTerms->appendChild($cbc);
    }


    // TOTALES 
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
        $cbc->setAttribute('unitCode', $value["CodigoUnidad"]);
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
        $cbc = $xml->createElement('cbc:PriceAmount', number_format(round($precioBruto, 4, PHP_ROUND_HALF_UP), 4, '.', ''));
        $cbc = $price->appendChild($cbc);
        $cbc->setAttribute('currencyID', $venta->TipoMoneda);
    }

    //CREAR ARCHIVO
    $xml->formatOutput = true;
    $xml->saveXML();

    $fileDir = __DIR__ . '/../files';

    if (!file_exists($fileDir)) {
        mkdir($fileDir, 0777, true);
    }

    $filename = $empresa->NumeroDocumento . '-' . $venta->TipoComprobante . '-' . $venta->Serie . '-' . $venta->Numeracion;
    $xml->save('../files/' . $filename . '.xml');
    chmod('../files/' . $filename . '.xml', 0777);

    Sunat::signDocument($filename);

    Sunat::createZip("../files/" . $filename . ".zip", "../files/" . $filename . ".xml", "" . $filename . ".xml");

    $soapResult = new SoapResult('../resources/wsdl/billService.wsdl', $filename);
    $soapResult->sendBill(Sunat::xmlSendBill($empresa->NumeroDocumento, $empresa->UsuarioSol, $empresa->ClaveSol, $filename . '.zip', base64_encode(file_get_contents('../files/' . $filename . '.zip'))));

    if ($soapResult->isSuccess()) {
        if ($soapResult->isAccepted()) {
            VentasADO::CambiarEstadoSunatVenta($idventa, $soapResult->getCode(), $soapResult->getDescription(), $soapResult->getHashCode(), Sunat::getXmlSign());
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            echo json_encode(array(
                "state" => $soapResult->isSuccess(),
                "accept" => $soapResult->isAccepted(),
                "code" => $soapResult->getCode(),
                "description" => $soapResult->getDescription()
            ));
        } else {
            VentasADO::CambiarEstadoSunatVentaUnico($idventa, $soapResult->getCode(), $soapResult->getDescription());
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            echo json_encode(array(
                "state" => $soapResult->isSuccess(),
                "accept" => $soapResult->isAccepted(),
                "code" => $soapResult->getCode(),
                "description" => $soapResult->getDescription()
            ));
        }
    } else {
        if ($soapResult->getCode() == "1033") {
            VentasADO::CambiarEstadoSunatVentaUnico($idventa, "0", $soapResult->getDescription());
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            echo json_encode(array(
                "state" => false,
                "code" => $soapResult->getCode(),
                "description" => $soapResult->getDescription()
            ));
        } else {
            VentasADO::CambiarEstadoSunatVentaUnico($idventa, $soapResult->getCode(), $soapResult->getDescription());
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

            echo json_encode($soapResult->getDescription());
        }
    }
}
