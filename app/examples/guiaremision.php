<?php

set_time_limit(300);

use SysSoftIntegra\Src\SoapResult;
use SysSoftIntegra\Src\Sunat;
use SysSoftIntegra\Src\NumberLleters;
use SysSoftIntegra\Model\GuiaRemisionADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

$idGuiaRemision = $_GET['idGuiaRemision'];
$detalleguiaremision = GuiaRemisionADO::ListarDetalleGuiaRemisionPorId($idGuiaRemision);

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
$cbc = $xml->createElement('cbc:ID', "T001-121");  // numero de factura
$cbc = $Invoice->appendChild($cbc);
$cbc = $xml->createElement('cbc:IssueDate', "2023-02-06");   // fecha de emision
$cbc = $Invoice->appendChild($cbc);
$cbc = $xml->createElement('cbc:IssueTime', "11:25:55");   // hora de emision
$cbc = $Invoice->appendChild($cbc);
$cbc = $xml->createElement('cbc:DespatchAdviceTypeCode', "09");
$cbc->setAttribute('listAgencyName', "PE:SUNAT");
$cbc->setAttribute('listName', "Tipo de Documento");
$cbc->setAttribute('listURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01");
$cbc = $Invoice->appendChild($cbc);

// DATOS DE FIRMA
$cac_signature = $xml->createElement('cac:Signature');
$cac_signature = $Invoice->appendChild($cac_signature);
$cbc = $xml->createElement('cbc:ID', "20161515648");
$cbc = $cac_signature->appendChild($cbc);
$cac_signatory = $xml->createElement('cac:SignatoryParty');
$cac_signatory = $cac_signature->appendChild($cac_signatory);
$cac = $xml->createElement('cac:PartyIdentification');
$cac = $cac_signatory->appendChild($cac);
$cbc = $xml->createElement('cbc:ID', "20161515648");
$cbc = $cac->appendChild($cbc);
$cac = $xml->createElement('cac:PartyName');
$cac = $cac_signatory->appendChild($cac);
$cbc = $xml->createElement('cbc:Name');
$cbc->appendChild($xml->createCDATASection("GREENTER S.A.C."));
$cbc = $cac->appendChild($cbc);
$cac = $xml->createElement('cac:ExternalReference');
$cac_digital = $xml->createElement('cac:DigitalSignatureAttachment');
$cac_digital = $cac_signature->appendChild($cac_digital);
$cac = $cac_digital->appendChild($cac);
$cbc = $xml->createElement('cbc:URI', '#SysSoftIntegra');
$cbc = $cac->appendChild($cbc);

// DATOS DEL EMISOR
$cac_despatch_supplier_party = $xml->createElement('cac:DespatchSupplierParty');
$cac_despatch_supplier_party = $Invoice->appendChild($cac_despatch_supplier_party);
$cac_party = $xml->createElement('cac:Party');
$cac_party = $cac_despatch_supplier_party->appendChild($cac_party);

$cac_party_identification = $xml->createElement('cac:PartyIdentification');
$cbc = $xml->createElement('cbc:ID', "20161515648");
$cbc->setAttribute('schemeID', "6");
$cbc->setAttribute('schemeName', "Documento de Identidad");
$cbc->setAttribute('schemeAgencyName', "PE:SUNAT");
$cbc->setAttribute('schemeURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06");
$cbc = $cac_party_identification->appendChild($cbc);
$cac_party_identification = $cac_party->appendChild($cac_party_identification);

$cac_party_legal_entity = $xml->createElement('cac:PartyLegalEntity');
$cbc = $xml->createElement('cbc:RegistrationName');
$cbc->appendChild($xml->createCDATASection("GREENTER S.A.C."));
$cbc = $cac_party_legal_entity->appendChild($cbc);
$cac_party_legal_entity = $cac_party->appendChild($cac_party_legal_entity);

// DATOS DEL RECEPTOR
$cac_delivery_customer_party = $xml->createElement('cac:DeliveryCustomerParty');
$cac_delivery_customer_party = $Invoice->appendChild($cac_delivery_customer_party);
$cac_party = $xml->createElement('cac:Party');
$cac_party = $cac_delivery_customer_party->appendChild($cac_party);

$cac_party_identification = $xml->createElement('cac:PartyIdentification');
$cbc = $xml->createElement('cbc:ID', "20000000002");
$cbc->setAttribute('schemeID', "6");
$cbc->setAttribute('schemeName', "Documento de Identidad");
$cbc->setAttribute('schemeAgencyName', "PE:SUNAT");
$cbc->setAttribute('schemeURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06");
$cbc = $cac_party_identification->appendChild($cbc);
$cac_party_identification = $cac_party->appendChild($cac_party_identification);

$cac_party_legal_entity = $xml->createElement('cac:PartyLegalEntity');
$cbc = $xml->createElement('cbc:RegistrationName');
$cbc->appendChild($xml->createCDATASection("EMPRESA DEST 1."));
$cbc = $cac_party_legal_entity->appendChild($cbc);
$cac_party_legal_entity = $cac_party->appendChild($cac_party_legal_entity);

// DETALLE DE LA GUIA
$cac_shipment = $xml->createElement('cac:Shipment');
$cac_shipment = $Invoice->appendChild($cac_shipment);

$cbc = $xml->createElement('cbc:ID', "SUNAT_Envio");
$cbc = $cac_shipment->appendChild($cbc);

$cbc = $xml->createElement('cbc:HandlingCode', "01");
$cbc->setAttribute('listAgencyName', "PE:SUNAT");
$cbc->setAttribute('listName', "Motivo de traslado");
$cbc->setAttribute('listURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo20");
$cbc = $cac_shipment->appendChild($cbc);

$cbc = $xml->createElement('cbc:GrossWeightMeasure', "12.500");
$cbc->setAttribute('unitCode', "KGM");
$cbc = $cac_shipment->appendChild($cbc);

$cac_shipment_stage = $xml->createElement('cac:ShipmentStage');
$cac_shipment_stage = $cac_shipment->appendChild($cac_shipment_stage);

$cbc = $xml->createElement('cbc:TransportModeCode', '01');
$cbc->setAttribute('listName', "Modalidad de traslado");
$cbc->setAttribute('listAgencyName', "PE:SUNAT");
$cbc->setAttribute('listURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo18");
$cbc = $cac_shipment_stage->appendChild($cbc);

$cac_transit_period = $xml->createElement('cac:TransitPeriod');
$cac_transit_period = $cac_shipment_stage->appendChild($cac_transit_period);
$cbc = $xml->createElement('cbc:StartDate', '2023-02-06');
$cbc = $cac_transit_period->appendChild($cbc);


$cac_carrier_party = $xml->createElement('cac:CarrierParty');
$cac_carrier_party = $cac_shipment_stage->appendChild($cac_carrier_party);

$cac_party_identification = $xml->createElement('cac:PartyIdentification');
$cbc = $xml->createElement('cbc:ID', '20000000002');
$cbc->setAttribute('schemeID', "6");
$cbc = $cac_party_identification->appendChild($cbc);
$cac_party_identification = $cac_carrier_party->appendChild($cac_party_identification);


$cac_party_legal_entity = $xml->createElement('cac:PartyLegalEntity');
$cbc = $xml->createElement('cbc:RegistrationName');
$cbc->appendChild($xml->createCDATASection("TRANSPORTES S.A.C"));
$cbc = $cac_party_legal_entity->appendChild($cbc);
$cbc = $xml->createElement('cbc:CompanyID','0001');
$cbc = $cac_party_legal_entity->appendChild($cbc);
$cac_party_legal_entity = $cac_carrier_party->appendChild($cac_party_legal_entity);


$cac_delivery = $xml->createElement('cac:Delivery');
$cac_delivery = $cac_shipment->appendChild($cac_delivery);
$cac_delivery_address = $xml->createElement('cac:DeliveryAddress');
$cbc = $xml->createElement('cbc:ID','150101');
$cbc->setAttribute('schemeAgencyName', "PE:INEI");
$cbc->setAttribute('schemeName', "Ubigeos");
$cbc = $cac_delivery_address->appendChild($cbc);
$cac_address_line = $xml->createElement('cac:AddressLine');
$cbc = $xml->createElement('cbc:Line','AV LIMA');
$cbc = $cac_address_line->appendChild($cbc);
$cac_address_line = $cac_delivery_address->appendChild($cac_address_line);
$cac_delivery_address = $cac_delivery->appendChild($cac_delivery_address);

$cac_despatch = $xml->createElement('cac:Despatch');
$cac_despatch = $cac_delivery->appendChild($cac_despatch);
$cac_despatch_address = $xml->createElement('cac:DespatchAddress');
$cbc = $xml->createElement('cbc:ID','150203');
$cbc->setAttribute('schemeAgencyName', "PE:INEI");
$cbc->setAttribute('schemeName', "Ubigeos");
$cbc = $cac_despatch_address->appendChild($cbc);
$cac_address_line = $xml->createElement('cac:AddressLine');
$cbc = $xml->createElement('cbc:Line','AV ITALIA');
$cbc = $cac_address_line->appendChild($cbc);
$cac_address_line = $cac_despatch_address->appendChild($cac_address_line);
$cac_despatch_address = $cac_despatch->appendChild($cac_despatch_address);

$cac_despatch_line = $xml->createElement('cac:DespatchLine');
$cbc = $xml->createElement('cbc:ID','1');
$cbc = $cac_despatch_line->appendChild($cbc);
$cbc = $xml->createElement('cbc:DeliveredQuantity','2');
$cbc->setAttribute('unitCode', "ZZ");
$cbc = $cac_despatch_line->appendChild($cbc);

$cac_order_line_reference = $xml->createElement('cac:OrderLineReference');
$cbc = $xml->createElement('cbc:LineID','1');
$cbc = $cac_order_line_reference->appendChild($cbc);
$cac_order_line_reference = $cac_despatch_line->appendChild($cac_order_line_reference);

$cac_item = $xml->createElement('cac:Item');
$cbc = $xml->createElement('cbc:Description');
$cbc->appendChild($xml->createCDATASection("PROD 1"));
$cbc = $cac_item->appendChild($cbc);

$cac_sellers_item_identification = $xml->createElement('cac:SellersItemIdentification');
$cbc = $xml->createElement('cbc:ID','PROD1');
$cbc = $cac_sellers_item_identification->appendChild($cbc);
$cac_sellers_item_identification = $cac_item->appendChild($cac_sellers_item_identification);

$cac_item = $cac_despatch_line->appendChild($cac_item);
$cac_despatch_line = $Invoice->appendChild($cac_despatch_line);

// $cbc = $xml->createElement('cbc:ID', "20161515648");
// $cbc = $cac_despatch_supplier_party->appendChild($cbc);
// $cac_signatory = $xml->createElement('cac:SignatoryParty');
// $cac_signatory = $cac_despatch_supplier_party->appendChild($cac_signatory);
// $cac = $xml->createElement('cac:PartyIdentification');
// $cac = $cac_signatory->appendChild($cac);
// $cbc = $xml->createElement('cbc:ID', "20161515648");
// $cbc = $cac->appendChild($cbc);
// $cac = $xml->createElement('cac:PartyName');
// $cac = $cac_signatory->appendChild($cac);
// $cbc = $xml->createElement('cbc:Name');
// $cbc->appendChild($xml->createCDATASection("GREENTER S.A.C."));
// $cbc = $cac->appendChild($cbc);
// $cac = $xml->createElement('cac:ExternalReference');
// $cac_digital = $xml->createElement('cac:DigitalSignatureAttachment');
// $cac_digital = $cac_despatch_supplier_party->appendChild($cac_digital);
// $cac = $cac_digital->appendChild($cac);
// $cbc = $xml->createElement('cbc:URI', '#SysSoftIntegra');
// $cbc = $cac->appendChild($cbc);

//CREAR ARCHIVO
$xml->formatOutput = true;
$xml->saveXML();

$fileDir = __DIR__ . '/../files';

if (!file_exists($fileDir)) {
    mkdir($fileDir, 0777, true);
}


$filename = "guia de remision";
$xml->save('../files/' . $filename . '.xml');
chmod('../files/' . $filename . '.xml', 0777);

Sunat::signDocument($filename);