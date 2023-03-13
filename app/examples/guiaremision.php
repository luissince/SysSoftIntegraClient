<?php

set_time_limit(300);

use SysSoftIntegra\Src\SoapResult;
use SysSoftIntegra\Src\Sunat;
use SysSoftIntegra\Model\GuiaRemisionADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

$idGuiaRemision = $_GET['idGuiaRemision'];
$respuesta = GuiaRemisionADO::ListarDetalleGuiaRemisionPorId($idGuiaRemision);

$guiaremision = $respuesta["guiaremision"];
$guiaremisiondetalle = $respuesta["guiaremisiondetalle"];
$empresa = $respuesta["empresa"];

$fechaRegistro = new DateTime($guiaremision->FechaRegistro . "T" . $guiaremision->HoraRegistro);

$fechaTraslado = new DateTime($guiaremision->FechaTraslado . "T" . $guiaremision->HoraTraslado);

$xml = new DomDocument('1.0', 'utf-8');
// $xml->standalone         = true;
$xml->preserveWhiteSpace = false;

$Invoice = $xml->createElement('DespatchAdvice');
$Invoice = $xml->appendChild($Invoice);

$Invoice->setAttribute('xmlns', 'urn:oasis:names:specification:ubl:schema:xsd:DespatchAdvice-2');
$Invoice->setAttribute('xmlns:ds', 'http://www.w3.org/2000/09/xmldsig#');
$Invoice->setAttribute('xmlns:cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
$Invoice->setAttribute('xmlns:cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
$Invoice->setAttribute('xmlns:ext', 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');

$UBLExtension = $xml->createElement('ext:UBLExtensions');
$UBLExtension = $Invoice->appendChild($UBLExtension);

$ext = $xml->createElement('ext:UBLExtension');
$ext = $UBLExtension->appendChild($ext);
$contents = $xml->createElement('ext:ExtensionContent', ' ');
$contents = $ext->appendChild($contents);

//Version de UBL 2.1
$cbc = $xml->createElement('cbc:UBLVersionID', '2.1');
$cbc = $Invoice->appendChild($cbc);
$cbc = $xml->createElement('cbc:CustomizationID', '2.0');
$cbc = $Invoice->appendChild($cbc);
$cbc = $xml->createElement('cbc:ID', $guiaremision->Serie . "-" . $guiaremision->Numeracion);
$cbc = $Invoice->appendChild($cbc);

/**
 * FECHA Y HORA DE EMISIÓN
 */
$cbc = $xml->createElement('cbc:IssueDate', $fechaRegistro->format('Y-m-d'));
$cbc = $Invoice->appendChild($cbc);
$cbc = $xml->createElement('cbc:IssueTime', $fechaRegistro->format('H:i:s'));
$cbc = $Invoice->appendChild($cbc);
$cbc = $xml->createElement('cbc:DespatchAdviceTypeCode', $guiaremision->Codigo);
$cbc->setAttribute('listAgencyName', "PE:SUNAT");
$cbc->setAttribute('listName', "Tipo de Documento");
$cbc->setAttribute('listURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01");
$cbc = $Invoice->appendChild($cbc);

/**
 * DOCUMENTOS RELACIONADOS (Catalogo 41)
 */
$cac_additional_document_reference = $xml->createElement('cac:AdditionalDocumentReference');
$cac_additional_document_reference = $Invoice->appendChild($cac_additional_document_reference);

$cbc = $xml->createElement('cbc:ID', $guiaremision->SerieComRl . "-" . $guiaremision->NumeracionComRl);
$cbc = $cac_additional_document_reference->appendChild($cbc);

$cbc = $xml->createElement('cbc:DocumentTypeCode', $guiaremision->CodigoComRl);
$cbc->setAttribute('listAgencyName', "PE:SUNAT");
$cbc->setAttribute('listName', "Documento relacionado al transporte");
$cbc->setAttribute('listURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo61");
$cbc = $cac_additional_document_reference->appendChild($cbc);

$cbc = $xml->createElement('cbc:DocumentType', $guiaremision->NombreComRl);
$cbc = $cac_additional_document_reference->appendChild($cbc);

$cac_issuer_party = $xml->createElement('cac:IssuerParty');
$cac_issuer_party = $cac_additional_document_reference->appendChild($cac_issuer_party);

$cac_party_identification = $xml->createElement('cac:PartyIdentification');
$cac_party_identification = $cac_issuer_party->appendChild($cac_party_identification);

$cbc = $xml->createElement('cbc:ID', $empresa->NumeroDocumento);
$cbc->setAttribute('schemeID', $empresa->IdAuxiliar);
$cbc->setAttribute('schemeAgencyName', "PE:SUNAT");
$cbc->setAttribute('schemeName', "Documento de Identidad");
$cbc->setAttribute('schemeURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06");
$cbc = $cac_party_identification->appendChild($cbc);

/**
 * DATOS DE FIRMA
 */
$cac_signature = $xml->createElement('cac:Signature');
$cac_signature = $Invoice->appendChild($cac_signature);
$cbc = $xml->createElement('cbc:ID', $empresa->NumeroDocumento);
$cbc = $cac_signature->appendChild($cbc);
$cac_signatory = $xml->createElement('cac:SignatoryParty');
$cac_signatory = $cac_signature->appendChild($cac_signatory);
$cac = $xml->createElement('cac:PartyIdentification');
$cac = $cac_signatory->appendChild($cac);
$cbc = $xml->createElement('cbc:ID', $empresa->NumeroDocumento);
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

/**
 * DATOS DEL EMISOR (REMITENTE)
 */
$cac_despatch_supplier_party = $xml->createElement('cac:DespatchSupplierParty');
$cac_despatch_supplier_party = $Invoice->appendChild($cac_despatch_supplier_party);
$cac_party = $xml->createElement('cac:Party');
$cac_party = $cac_despatch_supplier_party->appendChild($cac_party);

$cac_party_identification = $xml->createElement('cac:PartyIdentification');
$cbc = $xml->createElement('cbc:ID', $empresa->NumeroDocumento);
$cbc->setAttribute('schemeID', $empresa->IdAuxiliar);
$cbc->setAttribute('schemeName', "Documento de Identidad");
$cbc->setAttribute('schemeAgencyName', "PE:SUNAT");
$cbc->setAttribute('schemeURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06");
$cbc = $cac_party_identification->appendChild($cbc);
$cac_party_identification = $cac_party->appendChild($cac_party_identification);

$cac_party_legal_entity = $xml->createElement('cac:PartyLegalEntity');
$cbc = $xml->createElement('cbc:RegistrationName');
$cbc->appendChild($xml->createCDATASection($empresa->RazonSocial));
$cbc = $cac_party_legal_entity->appendChild($cbc);
$cac_party_legal_entity = $cac_party->appendChild($cac_party_legal_entity);

/**
 * DATOS DEL RECEPTOR (DESTINATARIO)
 */
$cac_delivery_customer_party = $xml->createElement('cac:DeliveryCustomerParty');
$cac_delivery_customer_party = $Invoice->appendChild($cac_delivery_customer_party);
$cac_party = $xml->createElement('cac:Party');
$cac_party = $cac_delivery_customer_party->appendChild($cac_party);

$cac_party_identification = $xml->createElement('cac:PartyIdentification');
$cbc = $xml->createElement('cbc:ID', $guiaremision->NumeroCliRl);
$cbc->setAttribute('schemeID', $guiaremision->CodigoCliRl);
$cbc->setAttribute('schemeName', "Documento de Identidad");
$cbc->setAttribute('schemeAgencyName', "PE:SUNAT");
$cbc->setAttribute('schemeURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06");
$cbc = $cac_party_identification->appendChild($cbc);
$cac_party_identification = $cac_party->appendChild($cac_party_identification);

$cac_party_legal_entity = $xml->createElement('cac:PartyLegalEntity');
$cbc = $xml->createElement('cbc:RegistrationName');
$cbc->appendChild($xml->createCDATASection($guiaremision->InformacionCliRl));
$cbc = $cac_party_legal_entity->appendChild($cbc);
$cac_party_legal_entity = $cac_party->appendChild($cac_party_legal_entity);

/**
 * DATOS DE TRASLADO
 */
$cac_shipment = $xml->createElement('cac:Shipment');
$cac_shipment = $Invoice->appendChild($cac_shipment);

// ID OBLIGATORIO POR UBL
$cbc = $xml->createElement('cbc:ID', "SUNAT_Envio");
$cbc = $cac_shipment->appendChild($cbc);

// MOTIVO DEL TRASLADO
$cbc = $xml->createElement('cbc:HandlingCode', $guiaremision->CodigoMotivoTraslado);
$cbc->setAttribute('listAgencyName', "PE:SUNAT");
$cbc->setAttribute('listName', "Motivo de traslado");
$cbc->setAttribute('listURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo20");
$cbc = $cac_shipment->appendChild($cbc);

$cbc = $xml->createElement('cbc:HandlingInstructions', $guiaremision->NombreMotivoTraslado);
$cbc = $cac_shipment->appendChild($cbc);

// PESO BRUTO TOTAL DE LA CARGA
$cbc = $xml->createElement('cbc:GrossWeightMeasure', $guiaremision->PesoCarga);
$cbc->setAttribute('unitCode', $guiaremision->CodigoPesoCarga);
$cbc = $cac_shipment->appendChild($cbc);

if ($guiaremision->CodigoModalidadTraslado == "01") {
    /**
     * INDICADORES
     */
    $cac_shipment_stage = $xml->createElement('cac:ShipmentStage');
    $cac_shipment_stage = $cac_shipment->appendChild($cac_shipment_stage);

    // MODALIDAD DE TRANSPORTE
    $cbc = $xml->createElement('cbc:TransportModeCode', $guiaremision->CodigoModalidadTraslado);
    $cbc->setAttribute('listName', "Modalidad de traslado");
    $cbc->setAttribute('listAgencyName', "PE:SUNAT");
    $cbc->setAttribute('listURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo18");
    $cbc = $cac_shipment_stage->appendChild($cbc);

    // FECHA DE TRASLADO
    $cac_transit_period = $xml->createElement('cac:TransitPeriod');
    $cac_transit_period = $cac_shipment_stage->appendChild($cac_transit_period);
    $cbc = $xml->createElement('cbc:StartDate', $fechaTraslado->format('Y-m-d'));
    $cbc = $cac_transit_period->appendChild($cbc);

    // EMPRESA PÚBLICA QUE LLEVA LA MERCADERÍA
    $cac_carrier_party = $xml->createElement('cac:CarrierParty');
    $cac_carrier_party = $cac_shipment_stage->appendChild($cac_carrier_party);

    $cac_party_identification = $xml->createElement('cac:PartyIdentification');
    $cbc = $xml->createElement('cbc:ID', $guiaremision->NumeroDocumentoConducto);
    $cbc->setAttribute('schemeID', $guiaremision->CodigoConducto);
    $cbc = $cac_party_identification->appendChild($cbc);
    $cac_party_identification = $cac_carrier_party->appendChild($cac_party_identification);

    $cac_party_legal_entity = $xml->createElement('cac:PartyLegalEntity');
    $cbc = $xml->createElement('cbc:RegistrationName');
    $cbc->appendChild($xml->createCDATASection($guiaremision->InformacionConducto));
    $cbc = $cac_party_legal_entity->appendChild($cbc);
    $cbc = $xml->createElement('cbc:CompanyID', '0001');
    $cbc = $cac_party_legal_entity->appendChild($cbc);
    $cac_party_legal_entity = $cac_carrier_party->appendChild($cac_party_legal_entity);

    /**
     * DIRECCION Y UBIGEO DEL COMPROBANTE
     */
    $cac_delivery = $xml->createElement('cac:Delivery');
    $cac_delivery = $cac_shipment->appendChild($cac_delivery);

    // DIRECCION DEL PUNTO DE LLEGADA
    $cac_delivery_address = $xml->createElement('cac:DeliveryAddress');
    $cbc = $xml->createElement('cbc:ID', $guiaremision->CodigoUbigeoLlegada);
    $cbc->setAttribute('schemeAgencyName', "PE:INEI");
    $cbc->setAttribute('schemeName', "Ubigeos");
    $cbc = $cac_delivery_address->appendChild($cbc);
    $cac_address_line = $xml->createElement('cac:AddressLine');
    $cbc = $xml->createElement('cbc:Line', $guiaremision->DireccionLlegada);
    $cbc = $cac_address_line->appendChild($cbc);
    $cac_address_line = $cac_delivery_address->appendChild($cac_address_line);
    $cac_delivery_address = $cac_delivery->appendChild($cac_delivery_address);

    // DIRECCION DE PUNTO DE PARTIDA
    $cac_despatch = $xml->createElement('cac:Despatch');
    $cac_despatch = $cac_delivery->appendChild($cac_despatch);
    $cac_despatch_address = $xml->createElement('cac:DespatchAddress');
    $cbc = $xml->createElement('cbc:ID', $guiaremision->CodigoUbigeoPartida);
    $cbc->setAttribute('schemeAgencyName', "PE:INEI");
    $cbc->setAttribute('schemeName', "Ubigeos");
    $cbc = $cac_despatch_address->appendChild($cbc);
    $cac_address_line = $xml->createElement('cac:AddressLine');
    $cbc = $xml->createElement('cbc:Line', $guiaremision->DireccionPartida);
    $cbc = $cac_address_line->appendChild($cbc);
    $cac_address_line = $cac_despatch_address->appendChild($cac_address_line);
    $cac_despatch_address = $cac_despatch->appendChild($cac_despatch_address);

    /**
     * Transporte
     */
    $cac_transport_handling_unit = $xml->createElement('cac:TransportHandlingUnit');
    $cac_transport_handling_unit = $cac_shipment->appendChild($cac_transport_handling_unit);
} else {
    /**
     * INDICADORES
     */
    $cac_shipment_stage = $xml->createElement('cac:ShipmentStage');
    $cac_shipment_stage = $cac_shipment->appendChild($cac_shipment_stage);

    // MODALIDAD DE TRANSPORTE
    $cbc = $xml->createElement('cbc:TransportModeCode', $guiaremision->CodigoModalidadTraslado);
    $cbc->setAttribute('listName', "Modalidad de traslado");
    $cbc->setAttribute('listAgencyName', "PE:SUNAT");
    $cbc->setAttribute('listURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo18");
    $cbc = $cac_shipment_stage->appendChild($cbc);

    // FECHA DE TRASLADO
    $cac_transit_period = $xml->createElement('cac:TransitPeriod');
    $cac_transit_period = $cac_shipment_stage->appendChild($cac_transit_period);
    $cbc = $xml->createElement('cbc:StartDate', $fechaTraslado->format('Y-m-d'));
    $cbc = $cac_transit_period->appendChild($cbc);

    /**
     * CONDUCTOR PRINCIPAL
     */
    $cac_driver_person = $xml->createElement('cac:DriverPerson');
    $cac_driver_person = $cac_shipment_stage->appendChild($cac_driver_person);

    // TIPO Y NUMERO DE DOCUMENTO DE IDENTIDAD
    $cbc = $xml->createElement('cbc:ID', $guiaremision->NumeroDocumentoConducto);
    $cbc->setAttribute('schemeID', "1");
    $cbc->setAttribute('schemeName', "Documento de Identidad");
    $cbc->setAttribute('schemeAgencyName', "PE:SUNAT");
    $cbc->setAttribute('schemeURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06");
    $cbc = $cac_driver_person->appendChild($cbc);

    // NOMBRES
    $cbc = $xml->createElement('cbc:FirstName', $guiaremision->InformacionConducto);
    $cbc = $cac_driver_person->appendChild($cbc);

    // APELLIDOS
    $cbc = $xml->createElement('cbc:FamilyName', $guiaremision->InformacionConducto);
    $cbc = $cac_driver_person->appendChild($cbc);

    // TIPO DE CONDUCTOR: PRINCIPAL
    $cbc = $xml->createElement('cbc:JobTitle', "Principal");
    $cbc = $cac_driver_person->appendChild($cbc);

    /**
     * DIRECCION Y UBIGEO DEL COMPROBANTE
     */
    $cac_delivery = $xml->createElement('cac:Delivery');
    $cac_delivery = $cac_shipment->appendChild($cac_delivery);

    // DIRECCION DEL PUNTO DE LLEGADA
    $cac_delivery_address = $xml->createElement('cac:DeliveryAddress');
    $cbc = $xml->createElement('cbc:ID', $guiaremision->CodigoUbigeoLlegada);
    $cbc->setAttribute('schemeAgencyName', "PE:INEI");
    $cbc->setAttribute('schemeName', "Ubigeos");
    $cbc = $cac_delivery_address->appendChild($cbc);
    $cac_address_line = $xml->createElement('cac:AddressLine');
    $cbc = $xml->createElement('cbc:Line', $guiaremision->DireccionLlegada);
    $cbc = $cac_address_line->appendChild($cbc);
    $cac_address_line = $cac_delivery_address->appendChild($cac_address_line);
    $cac_delivery_address = $cac_delivery->appendChild($cac_delivery_address);

    // DIRECCION DE PUNTO DE PARTIDA
    $cac_despatch = $xml->createElement('cac:Despatch');
    $cac_despatch = $cac_delivery->appendChild($cac_despatch);
    $cac_despatch_address = $xml->createElement('cac:DespatchAddress');
    $cbc = $xml->createElement('cbc:ID', $guiaremision->CodigoUbigeoPartida);
    $cbc->setAttribute('schemeAgencyName', "PE:INEI");
    $cbc->setAttribute('schemeName', "Ubigeos");
    $cbc = $cac_despatch_address->appendChild($cbc);
    $cac_address_line = $xml->createElement('cac:AddressLine');
    $cbc = $xml->createElement('cbc:Line', $guiaremision->DireccionPartida);
    $cbc = $cac_address_line->appendChild($cbc);
    $cac_address_line = $cac_despatch_address->appendChild($cac_address_line);
    $cac_despatch_address = $cac_despatch->appendChild($cac_despatch_address);

    /**
     * LICENCIA DE CONDUCIR
     */
    $cac_identity_document_reference = $xml->createElement('cac:IdentityDocumentReference');
    $cac_identity_document_reference = $cac_driver_person->appendChild($cac_identity_document_reference);

    // NÚMERO DE LICENCIA
    $cbc = $xml->createElement('cbc:ID', $guiaremision->LicenciaConducirConducto);
    $cbc = $cac_identity_document_reference->appendChild($cbc);

    /**
     * Transporte
     */
    $cac_transport_handling_unit = $xml->createElement('cac:TransportHandlingUnit');
    $cac_transport_handling_unit = $cac_shipment->appendChild($cac_transport_handling_unit);

    $cac_transport_equipment = $xml->createElement('cac:TransportEquipment');
    //
    $cbc = $xml->createElement('cbc:ID', $guiaremision->NumeroPlaca);
    $cbc = $cac_transport_equipment->appendChild($cbc);

    $cac_transport_equipment = $cac_transport_handling_unit->appendChild($cac_transport_equipment);
}


/**
 * DETALLES DE BIENES A TRASLADAR
 */
$index = 0;
foreach ($guiaremisiondetalle as $key => $value) {
    $index++;

    $cac_despatch_line = $xml->createElement('cac:DespatchLine');
    $cbc = $xml->createElement('cbc:ID', $index);
    $cbc = $cac_despatch_line->appendChild($cbc);
    $cbc = $xml->createElement('cbc:DeliveredQuantity', $value->Cantidad);
    $cbc->setAttribute('unitCode', $value->CodigoMedida);
    $cbc = $cac_despatch_line->appendChild($cbc);

    $cac_order_line_reference = $xml->createElement('cac:OrderLineReference');
    $cbc = $xml->createElement('cbc:LineID', $index);
    $cbc = $cac_order_line_reference->appendChild($cbc);
    $cac_order_line_reference = $cac_despatch_line->appendChild($cac_order_line_reference);

    $cac_item = $xml->createElement('cac:Item');
    $cbc = $xml->createElement('cbc:Description');
    $cbc->appendChild($xml->createCDATASection($value->Descripcion));
    $cbc = $cac_item->appendChild($cbc);

    $cac_sellers_item_identification = $xml->createElement('cac:SellersItemIdentification');
    $cbc = $xml->createElement('cbc:ID', $value->IdSuministro);
    $cbc = $cac_sellers_item_identification->appendChild($cbc);
    $cac_sellers_item_identification = $cac_item->appendChild($cac_sellers_item_identification);

    $cac_item = $cac_despatch_line->appendChild($cac_item);
    $cac_despatch_line = $Invoice->appendChild($cac_despatch_line);
}

/**
 * 
 */
$xml->formatOutput = true;
$xml->saveXML();

$fileDir = __DIR__ . '/../files';

if (!file_exists($fileDir)) {
    mkdir($fileDir, 0777, true);
}

$filename = "" . $empresa->NumeroDocumento . "-" . $guiaremision->Codigo . "-" . $guiaremision->Serie . "-" . $guiaremision->Numeracion . "";
$xml->save('../files/' . $filename . '.xml');
chmod('../files/' . $filename . '.xml', 0777);

Sunat::signDocument($filename);

Sunat::createZip("../files/" . $filename . ".zip", "../files/" . $filename . ".xml", "" . $filename . ".xml");

$soapResult = new SoapResult('', $filename);
$soapResult->setConfigGuiaRemision("../files/" . $filename . ".zip");
$soapResult->sendGuiaRemision(
    [
        "NumeroDocumento" => $empresa->NumeroDocumento,
        "UsuarioSol" => $empresa->UsuarioSol,
        "ClaveSol" => $empresa->ClaveSol,
        "IdApiSunat" => $empresa->IdApiSunat,
        "ClaveApiSunat" => $empresa->ClaveApiSunat,
    ],
    [
        "numRucEmisor" => $empresa->NumeroDocumento,
        "codCpe" => $guiaremision->Codigo,
        "numSerie" => $guiaremision->Serie,
        "numCpe" => $guiaremision->Numeracion,
    ]
);

if ($soapResult->isSuccess()) {
    if ($soapResult->isAccepted()) {
        GuiaRemisionADO::CambiarEstadoSunatGuiaRemision($idGuiaRemision, $soapResult->getCode(), $soapResult->getMessage(), $soapResult->getHashCode(), Sunat::getXmlSign());
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        header($protocol . ' ' . 200 . ' ' . "OK");

        echo json_encode(array(
            "state" => $soapResult->isSuccess(),
            "accept" => $soapResult->isAccepted(),
            "code" => $soapResult->getCode(),
            "description" => $soapResult->getMessage()
        ));
    } else {
        GuiaRemisionADO::CambiarEstadoSunatGuiaRemisionUnico($idGuiaRemision, $soapResult->getCode(), $soapResult->getMessage());
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        header($protocol . ' ' . 200 . ' ' . "OK");

        echo json_encode(array(
            "state" => $soapResult->isSuccess(),
            "accept" => $soapResult->isAccepted(),
            "code" => $soapResult->getCode(),
            "description" => $soapResult->getMessage()
        ));
    }
} else {
    if ($soapResult->getCode() == "1033") {
        GuiaRemisionADO::CambiarEstadoSunatGuiaRemisionUnico($idGuiaRemision, "0", $soapResult->getMessage());
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        header($protocol . ' ' . 200 . ' ' . "OK");

        echo json_encode(array(
            "state" => false,
            "code" => $soapResult->getCode(),
            "description" => $soapResult->getMessage()
        ));
    } else {
        GuiaRemisionADO::CambiarEstadoSunatGuiaRemisionUnico($idGuiaRemision, $soapResult->getCode(), $soapResult->getMessage());
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        header($protocol . ' ' . 500 . ' ' . "Internal Server Error");

        echo json_encode($soapResult->getMessage());
    }
}
