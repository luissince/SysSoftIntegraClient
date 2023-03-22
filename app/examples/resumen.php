﻿<?php

set_time_limit(300);

use SysSoftIntegra\Src\SoapResult;
use SysSoftIntegra\Src\Sunat;
use SysSoftIntegra\Model\VentasADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

$idventa = $_GET['idventa'];
$detalleventa = VentasADO::ListarDetalleVentaPorId($idventa);

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
    $correlativoActual = $detalleventa[4];
    $correlativo = ($correlativoActual === 0) ? (intval($venta->Correlativo) + 1) : ($correlativoActual + 1);
    date_default_timezone_set('America/Lima');
    $currentDate = new DateTime('now');

    $xml = new DomDocument('1.0', 'utf-8');
    // $xml->standalone         = true;
    $xml->preserveWhiteSpace = false;

    $Invoice = $xml->createElement('SummaryDocuments');
    $Invoice = $xml->appendChild($Invoice);

    $Invoice->setAttribute('xmlns', 'urn:sunat:names:specification:ubl:peru:schema:xsd:SummaryDocuments-1');
    $Invoice->setAttribute('xmlns:sac', 'urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1');
    $Invoice->setAttribute('xmlns:ext', 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');
    $Invoice->setAttribute('xmlns:ds', 'http://www.w3.org/2000/09/xmldsig#');
    $Invoice->setAttribute('xmlns:cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
    $Invoice->setAttribute('xmlns:cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');



    $UBLExtension = $xml->createElement('ext:UBLExtensions');
    $UBLExtension = $Invoice->appendChild($UBLExtension);

    $ext = $xml->createElement('ext:UBLExtension');
    $ext = $UBLExtension->appendChild($ext);
    $contents = $xml->createElement('ext:ExtensionContent', ' ');
    $contents = $ext->appendChild($contents);

    $date = new DateTime($venta->FechaVenta . "T" . $venta->HoraVenta);

    //Version de UBL 2.0
    $cbc = $xml->createElement('cbc:UBLVersionID', '2.0');
    $cbc = $Invoice->appendChild($cbc);
    $cbc = $xml->createElement('cbc:CustomizationID', '1.1');
    $cbc = $Invoice->appendChild($cbc);
    $cbc = $xml->createElement('cbc:ID', 'RC-' . $currentDate->format('Ymd') . '-' . $correlativo);
    $cbc = $Invoice->appendChild($cbc);
    $cbc = $xml->createElement('cbc:ReferenceDate', $date->format('Y-m-d'));
    $cbc = $Invoice->appendChild($cbc);
    $cbc = $xml->createElement('cbc:IssueDate', $currentDate->format('Y-m-d'));
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
    $CustomerAssignedAccountID = $xml->createElement('cbc:CustomerAssignedAccountID', $empresa->NumeroDocumento);
    $CustomerAssignedAccountID = $cac_SupplierParty->appendChild($CustomerAssignedAccountID);
    $AdditionalAccountID = $xml->createElement('cbc:AdditionalAccountID', '6');
    $AdditionalAccountID = $cac_SupplierParty->appendChild($AdditionalAccountID);
    $cac_party = $xml->createElement('cac:Party');
    $cac_party = $cac_SupplierParty->appendChild($cac_party);
    $PartyLegalEntity = $xml->createElement('cac:PartyLegalEntity');
    $PartyLegalEntity = $cac_party->appendChild($PartyLegalEntity);
    $cbc = $xml->createElement('cbc:RegistrationName');
    $cbc->appendChild($xml->createCDATASection($empresa->RazonSocial));
    $cbc = $PartyLegalEntity->appendChild($cbc);

    // DOCUMENTO ASOCIADO
    $SummaryDocumentsLine = $xml->createElement('sac:SummaryDocumentsLine');
    $SummaryDocumentsLine = $Invoice->appendChild($SummaryDocumentsLine);
    $LineID = $xml->createElement('cbc:LineID', '1');
    $LineID = $SummaryDocumentsLine->appendChild($LineID);
    $DocumentTypeCode = $xml->createElement('cbc:DocumentTypeCode', $venta->TipoComprobante);
    $DocumentTypeCode = $SummaryDocumentsLine->appendChild($DocumentTypeCode);
    $ID = $xml->createElement('cbc:ID', $venta->Serie . '-' . $venta->Numeracion);
    $ID = $SummaryDocumentsLine->appendChild($ID);

    $AccountingCustomerParty = $xml->createElement('cac:AccountingCustomerParty');
    $AccountingCustomerParty = $SummaryDocumentsLine->appendChild($AccountingCustomerParty);
    $CustomerAssignedAccountID = $xml->createElement('cbc:CustomerAssignedAccountID', $cliente->NumeroDocumento);
    $CustomerAssignedAccountID = $AccountingCustomerParty->appendChild($CustomerAssignedAccountID);
    $AdditionalAccountID = $xml->createElement('cbc:AdditionalAccountID', $cliente->IdAuxiliar);
    $AdditionalAccountID = $AccountingCustomerParty->appendChild($AdditionalAccountID);

    $Status = $xml->createElement('cac:Status');
    $Status = $SummaryDocumentsLine->appendChild($Status);
    $ConditionCode = $xml->createElement('cbc:ConditionCode', '3');
    $ConditionCode = $Status->appendChild($ConditionCode);

    $TotalAmount = $xml->createElement('sac:TotalAmount', number_format(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP), 2, '.', '')); //
    $TotalAmount = $SummaryDocumentsLine->appendChild($TotalAmount);
    $TotalAmount->setAttribute('currencyID',  $venta->TipoMoneda);

    if ($detalleventa[0]['totalimpuesto'] > 0) {
        $BillingPayment = $xml->createElement('sac:BillingPayment');
        $cbc = $xml->createElement('cbc:PaidAmount', number_format(round($detalleventa[0]['opgravada'], 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc->setAttribute('currencyID', "PEN");
        $cbc = $BillingPayment->appendChild($cbc);

        $cbc = $xml->createElement('cbc:InstructionID', '01');
        $cbc = $BillingPayment->appendChild($cbc);

        $BillingPayment = $SummaryDocumentsLine->appendChild($BillingPayment);
    } else {
        $BillingPayment = $xml->createElement('sac:BillingPayment');
        $cbc = $xml->createElement('cbc:PaidAmount', number_format(round($detalleventa[0]['opexonerada'], 2, PHP_ROUND_HALF_UP), 2, '.', ''));
        $cbc->setAttribute('currencyID', "PEN");
        $cbc = $BillingPayment->appendChild($cbc);

        $cbc = $xml->createElement('cbc:InstructionID', '02');
        $cbc = $BillingPayment->appendChild($cbc);

        $BillingPayment = $SummaryDocumentsLine->appendChild($BillingPayment);
    }

    $cac_TaxTotal = $xml->createElement('cac:TaxTotal');
    $cac_TaxTotal = $SummaryDocumentsLine->appendChild($cac_TaxTotal);
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

    //CREAR ARCHIVO
    $xml->formatOutput = true;
    $xml->saveXML();

    $fileDir = __DIR__ . '/../files';

    if (!file_exists($fileDir)) {
        mkdir($fileDir, 0777, true);
    }

    $filename = $empresa->NumeroDocumento . '-RC-' . $currentDate->format('Ymd') . '-' . $correlativo;
    $xml->save('../files/' . $filename . '.xml');
    chmod('../files/' . $filename . '.xml', 0777);

    Sunat::signDocument($filename);

    Sunat::createZip("../files/" . $filename . ".zip", "../files/" . $filename . ".xml", "" . $filename . ".xml");

    $soapResult = new SoapResult('../resources/wsdl/billService.wsdl', $filename);
    $soapResult->sendSumary(Sunat::xmlSendSummary($empresa->NumeroDocumento, $empresa->UsuarioSol, $empresa->ClaveSol, $filename . '.zip', Sunat::generateBase64File('../files/' . $filename . '.zip')));

    if ($soapResult->isSuccess()) {
        $soapResult->sendGetStatus(Sunat::xmlGetStatus($empresa->NumeroDocumento, $empresa->UsuarioSol, $empresa->ClaveSol, $soapResult->getTicket()));
        if ($soapResult->isSuccess()) {
            if ($soapResult->isAccepted()) {
                VentasADO::CambiarEstadoSunatResumen($idventa, $soapResult->getCode(),  $soapResult->getDescription(), $correlativo, $currentDate->format('Y-m-d'));
                $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
                header($protocol . ' ' . 200 . ' ' . "OK");

                echo json_encode(array(
                    "state" => $soapResult->isSuccess(),
                    "accept" => $soapResult->isAccepted(),
                    "code" => $soapResult->getCode(),
                    "description" => $soapResult->getDescription()
                ));
            } else {
                VentasADO::CambiarEstadoSunatResumen($idventa, $soapResult->getCode(),  $soapResult->getDescription(), $correlativo, $currentDate->format('Y-m-d'));
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
            VentasADO::CambiarEstadoSunatResumen($idventa, $soapResult->getCode(),  $soapResult->getDescription(), $correlativo, $currentDate->format('Y-m-d'));
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . 200 . ' ' . "OK");

            echo json_encode(array(
                "state" => false,
                "code" => $soapResult->getCode(),
                "description" => $soapResult->getDescription()
            ));
        }
    } else {
        VentasADO::CambiarEstadoSunatResumen($idventa, $soapResult->getCode(),  $soapResult->getDescription(), $correlativo, $currentDate->format('Y-m-d'));
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

        echo json_encode(array("message" =>$soapResult->getDescription()));
    }
}
