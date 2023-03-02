<?php

namespace SysSoftIntegra\Src;

use Exception;
use SoapFault;
use DOMDocument;
use SysSoftIntegra\Src\Sunat;
use SysSoftIntegra\Src\SoapBuilder;

class SoapResult
{
    private $wsdlURL;

    private $file;

    private $filename;

    private $success = false;

    private $accepted = false;

    private $hashCode = "";

    private $description = "";

    private $ticket = "";

    private $message = "";

    private $code = "";

    private $filebase64 = "";

    private $hashZip = "";


    public function __construct($wsdlURL, $filename)
    {
        $this->wsdlURL = $wsdlURL;
        $this->filename = $filename;
    }

    public function sendBill($xmlSend)
    {
        try {
            $client = new SoapBuilder($this->wsdlURL, array('trace' => true));
            $client->SoapClientCall($xmlSend);
            $client->SoapCall("sendBill");
            $result = $client->__getLastResponse();

            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;
            $DOM->loadXML($result);

            $DocXML = $DOM->getElementsByTagName('applicationResponse');
            $response = "";
            foreach ($DocXML as $Nodo) {
                $response = $Nodo->nodeValue;
            }

            if ($response == "" || $response == null) {
                throw new Exception("No se pudo obtener el contenido del nodo applicationResponse.");
            }

            $cdr = base64_decode($response);
            $archivo = fopen('../files/R-' . $this->filename . '.zip', 'w+');
            fputs($archivo, $cdr);
            fclose($archivo);
            chmod('../files/R-' . $this->filename . '.zip', 0777);

            $isExtract = Sunat::extractZip('../files/R-' . $this->filename . '.zip', '../files/');
            if (!$isExtract) {
                throw new Exception("No se pudo extraer el contenido del archivo zip.");
            }

            $xml = file_get_contents('../files/R-' . $this->filename . '.xml');
            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;
            $DOM->loadXML($xml);

            $DocXML = $DOM->getElementsByTagName('ResponseCode');
            $code = "";
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

            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            if (file_exists('../files/R-' . $this->filename . '.zip')) {
                unlink('../files/R-' . $this->filename . '.zip');
            }

            if ($code == "0") {
                $this->setAccepted(true);
            } else {
                $this->setAccepted(false);
            }
            $this->setCode($code);
            $this->setDescription($description);
            $this->setHashCode($hashCode);
            $this->setSuccess(true);
        } catch (SoapFault $ex) {
            if (file_exists('../files/' . $this->filename . '.xml')) {
                unlink('../files/' . $this->filename . '.xml');
            }
            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            $code = preg_replace('/[^0-9]/', '', $ex->faultcode);
            $message = $ex->faultstring;
            $this->setSuccess(false);
            $this->setCode($code);
            $this->setDescription($message);
        } catch (Exception $ex) {
            if (file_exists('../files/' . $this->filename . '.xml')) {
                unlink('../files/' . $this->filename . '.xml');
            }
            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            if (file_exists('../files/R-' . $this->filename . '.zip')) {
                unlink('../files/R-' . $this->filename . '.zip');
            }
            $this->setSuccess(false);
            $this->setCode("-1");
            $this->setDescription($ex->getMessage());
        }
    }

    public function sendSumary($xmlSend)
    {
        try {
            $client = new SoapBuilder($this->wsdlURL, array('trace' => true));
            $client->SoapClientCall($xmlSend);
            $client->SoapCall("sendSummary");
            $result = $client->__getLastResponse();

            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;
            $DOM->loadXML($result);

            $DocXML = $DOM->getElementsByTagName('ticket');
            $ticket = "";
            foreach ($DocXML as $Nodo) {
                $ticket = $Nodo->nodeValue;
            }

            $this->setTicket($ticket);
            $this->setSuccess(true);
        } catch (SoapFault $ex) {
            $code = preg_replace('/[^0-9]/', '', $ex->faultcode);
            $message = $ex->faultstring;
            $this->setSuccess(false);
            $this->setCode($code);
            $this->setDescription($message);
        } catch (Exception $ex) {
            $this->setSuccess(false);
            $this->setCode('-1');
            $this->setDescription($ex->getMessage());
        }
    }

    public function sendGetStatus($xmlSend)
    {
        try {
            $client = new SoapBuilder($this->wsdlURL, array('trace' => true));
            $client->SoapClientCall($xmlSend);
            $client->SoapCall("getStatus");
            $result = $client->__getLastResponse();

            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;
            $DOM->loadXML($result);

            $DocXML = $DOM->getElementsByTagName('status');
            $status = "";
            foreach ($DocXML as $Nodo) {
                $status = $Nodo->nodeValue;
            }
            if ($status == "") {
                throw new Exception("No se pudo obtener el contenido del nodo status.");
            }
            $cdr = base64_decode($status);
            $archivo = fopen('../files/R-' . $this->filename . '.zip', 'w+');
            fputs($archivo, $cdr);
            fclose($archivo);
            chmod('../files/R-' . $this->filename . '.zip', 0777);

            $isExtract = Sunat::extractZip('../files/R-' . $this->filename . '.zip', '../files/');
            if (!$isExtract) {
                throw new Exception("No se pudo extraer el contenido del archivo zip.");
            }

            $xml = file_get_contents('../files/R-' . $this->filename . '.xml');
            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;
            $DOM->loadXML($xml);

            $DocXML = $DOM->getElementsByTagName('ResponseCode');
            $code = "";
            foreach ($DocXML as $Nodo) {
                $code = $Nodo->nodeValue;
            }

            $DocXML = $DOM->getElementsByTagName('Description');
            $description = "";
            foreach ($DocXML as $Nodo) {
                $description = $Nodo->nodeValue;
            }

            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            if (file_exists('../files/R-' . $this->filename . '.zip')) {
                unlink('../files/R-' . $this->filename . '.zip');
            }

            if ($code == "0") {
                $this->setAccepted(true);
            } else {
                $this->setAccepted(false);
            }

            $this->setCode($code);
            $this->setDescription($description);
            $this->setSuccess(true);
        } catch (SoapFault $ex) {
            if (file_exists('../files/' . $this->filename . '.xml')) {
                unlink('../files/' . $this->filename . '.xml');
            }
            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            $code = preg_replace('/[^0-9]/', '', $ex->faultcode);
            $message = $ex->faultstring;
            $this->setSuccess(false);
            $this->setCode($code);
            $this->setDescription($message);
        } catch (Exception $ex) {
            if (file_exists('../files/' . $this->filename . '.xml')) {
                unlink('../files/' . $this->filename . '.xml');
            }
            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            if (file_exists('../files/R-' . $this->filename . '.zip')) {
                unlink('../files/R-' . $this->filename . '.zip');
            }
            $this->setSuccess(false);
            $this->setCode("-1");
            $this->setDescription($ex->getMessage());
        }
    }

    public function sendGetStatusCdr($xmlSend)
    {
        try {
            $client = new SoapBuilder($this->wsdlURL, array('trace' => true));
            $client->SoapClientCall($xmlSend);
            $client->SoapCall("getStatusCdr");
            $result = $client->__getLastResponse();

            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;

            if ($DOM->loadXML($result)) {
                $DocXML = $DOM->getElementsByTagName('statusCode');
                $code = "";
                foreach ($DocXML as $Nodo) {
                    $code = $Nodo->nodeValue;
                }

                $DocXML = $DOM->getElementsByTagName('statusMessage');
                $message = "";
                foreach ($DocXML as $Nodo) {
                    $message = $Nodo->nodeValue;
                }

                $DocXML = $DOM->getElementsByTagName('content');
                $content = "";
                foreach ($DocXML as $Nodo) {
                    $content = $Nodo->nodeValue;
                }

                if ($content != "") {
                    $cdr = base64_decode($content);
                    $archivo = fopen('../../files/R-' . $this->filename . '.zip', 'w+');
                    fputs($archivo, $cdr);
                    fclose($archivo);
                    chmod('../../files/R-' . $this->filename . '.zip', 0777);

                    $isExtract = Sunat::extractZip('../../files/R-' . $this->filename . '.zip', '../../files/');
                    if (!$isExtract) {
                        throw new Exception("No se pudo extraer el contenido del archivo zip.");
                    }

                    $xml = file_get_contents('../../files/' . $isExtract[0]);
                    $DOM = new DOMDocument('1.0', 'utf-8');
                    $DOM->preserveWhiteSpace = FALSE;
                    $DOM->loadXML($xml);

                    $DocXML = $DOM->getElementsByTagName('ResponseCode');
                    $code = "";
                    foreach ($DocXML as $Nodo) {
                        $code = $Nodo->nodeValue;
                    }

                    $DocXML = $DOM->getElementsByTagName('Description');
                    $description = "";
                    foreach ($DocXML as $Nodo) {
                        $description = $Nodo->nodeValue;
                    }

                    $this->setAccepted(true);
                    $this->setCode($code);
                    $this->setMessage($message);
                    $this->setDescription($description);
                    $this->setSuccess(true);
                    $this->setFile('R-' . $this->filename . '.zip');
                } else {
                    $this->setAccepted(false);
                    $this->setCode($code);
                    $this->setMessage($message);
                    $this->setSuccess(true);
                }
            } else {
                throw new Exception("No se pudo obtener el xml de respuesta.");
            }
        } catch (SoapFault $ex) {
            $code = preg_replace('/[^0-9]/', '', $ex->faultcode);
            $message = $ex->faultstring;
            $this->setSuccess(false);
            $this->setCode($code);
            $this->setMessage($message);
        } catch (Exception $ex) {
            $this->setSuccess(false);
            $this->setCode("-1");
            $this->setMessage($ex->getMessage());
        }
    }

    public function sendGetStatusValid($xmlSend)
    {
        try {
            $client = new SoapBuilder($this->wsdlURL, array('trace' => true));
            $client->SoapClientCall($xmlSend);
            $client->SoapCall("getStatus");
            $result = $client->__getLastResponse();

            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;

            if ($DOM->loadXML($result)) {

                $DocXML = $DOM->getElementsByTagName('statusCode');
                $code = "";
                foreach ($DocXML as $Nodo) {
                    $code = $Nodo->nodeValue;
                }

                $DocXML = $DOM->getElementsByTagName('statusMessage');
                $message = "";
                foreach ($DocXML as $Nodo) {
                    $message = $Nodo->nodeValue;
                }

                if ($code == "0001") {
                    $this->setAccepted(true);
                } else {
                    $this->setAccepted(false);
                }
                $this->setCode($code);
                $this->setMessage($message);
                $this->setSuccess(true);
            } else {
                throw new Exception("No se pudo obtener el xml de respuesta.");
            }
        } catch (SoapFault $ex) {
            $code = preg_replace('/[^0-9]/', '', $ex->faultcode);
            $message = $ex->faultstring;
            $this->setSuccess(false);
            $this->setCode($code);
            $this->setMessage($message);
        } catch (Exception $ex) {
            $this->setSuccess(false);
            $this->setCode("-1");
            $this->setMessage($ex->getMessage());
        }
    }

    public function sendGuiaRemision(array $uri)
    {
        try {
            $headers = array(
                'Content-Type: application/x-www-form-urlencoded'
            );

            $data = array(
                'grant_type' => 'password',
                'scope' => urlencode('https://api-cpe.sunat.gob.pe'),
                'client_id' => urlencode('test-85e5b0ae-255c-4891-a595-0b98c65c9854'),
                'client_secret' => urlencode('test-Hty/M6QshYvPgItX2P0+Kw=='),
                'username' => '20547848307MODDATOS',
                'password' => 'MODDATOS',
            );

            $fields = "";
            $index = 0;
            foreach ($data as $key => $val) {
                $index++;
                $fields .= $index == count($data) ? $key . "=" . $val : $key . "=" . $val . "&";
            }

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://gre-test.nubefact.com/v1/clientessol/test-85e5b0ae-255c-4891-a595-0b98c65c9854/oauth2/token');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 0);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($curl);

            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($http_code == 200) {
                $result = (object)json_decode($response);

                $this->sendApiSunatGuiaRemision($result->access_token, implode("-", $uri));
            } else {
                if ($response) {
                    if (file_exists('../files/' . $this->filename . '.xml')) {
                        unlink('../files/' . $this->filename . '.xml');
                    }
                    if (file_exists('../files/' . $this->filename . '.zip')) {
                        unlink('../files/' . $this->filename . '.zip');
                    }

                    $result = (object)json_decode($response);

                    $this->setSuccess(false);
                    $this->setCode($result->cod);
                    $this->setMessage($result->msg);
                } else {
                    if (file_exists('../files/' . $this->filename . '.xml')) {
                        unlink('../files/' . $this->filename . '.xml');
                    }
                    if (file_exists('../files/' . $this->filename . '.zip')) {
                        unlink('../files/' . $this->filename . '.zip');
                    }

                    $this->setSuccess(false);
                    $this->setCode("-1");
                    $this->setMessage("Se presento una condicion inesperada que impidio completar el
                    Request");
                }
            }
        } catch (Exception $ex) {
            if (file_exists('../files/' . $this->filename . '.xml')) {
                unlink('../files/' . $this->filename . '.xml');
            }
            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }

            $this->setSuccess(false);
            $this->setCode("-1");
            $this->setMessage($ex->getMessage());
        }
    }

    private function sendApiSunatGuiaRemision(string $token, string $uri)
    {
        try {
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token . ''
            );

            $data = array(
                'archivo' => array(
                    'nomArchivo' => '' . $this->filename . '.zip',
                    'arcGreZip' => $this->filebase64,
                    'hashZip' => $this->hashZip,
                )
            );

            $data_string = json_encode($data);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://gre-test.nubefact.com/v1/contribuyente/gem/comprobantes/' . $uri . '');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 0);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($curl);

            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($http_code == 200) {
                $result = (object)json_decode($response);
                $this->ticket = $result->numTicket;
                $this->sendGetStatusGuiaRemision($token);
            } else {
                if ($response) {
                    if (file_exists('../files/' . $this->filename . '.xml')) {
                        unlink('../files/' . $this->filename . '.xml');
                    }
                    if (file_exists('../files/' . $this->filename . '.zip')) {
                        unlink('../files/' . $this->filename . '.zip');
                    }

                    $result = (object)json_decode($response);

                    $this->setSuccess(false);
                    $this->setCode($result->cod);
                    if (isset($result->exc)) {
                        $this->setMessage($result->exc);
                    } else {
                        $this->setMessage($result->msg);
                    }
                } else {
                    if (file_exists('../files/' . $this->filename . '.xml')) {
                        unlink('../files/' . $this->filename . '.xml');
                    }
                    if (file_exists('../files/' . $this->filename . '.zip')) {
                        unlink('../files/' . $this->filename . '.zip');
                    }

                    $this->setSuccess(false);
                    $this->setCode("-1");
                    $this->setMessage("Se presento una condicion inesperada que impidio completar el
                    Request");
                }
            }
        } catch (Exception $ex) {
            if (file_exists('../files/' . $this->filename . '.xml')) {
                unlink('../files/' . $this->filename . '.xml');
            }
            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }

            $this->setSuccess(false);
            $this->setCode("-1");
            $this->setMessage($ex->getMessage());
        }
    }

    private function sendGetStatusGuiaRemision(string $token)
    {
        try {
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token . ''
            );

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://gre-test.nubefact.com/v1/contribuyente/gem/comprobantes/envios/' .  $this->ticket . '');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 0);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($curl);

            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($http_code == 200) {
                $result = (object)json_decode($response);
                if ($result->codRespuesta == "0") {
                    $cdr = base64_decode($result->arcCdr);
                    $archivo = fopen('../files/R-' . $this->filename . '.zip', 'w+');
                    fputs($archivo, $cdr);
                    fclose($archivo);
                    chmod('../files/R-' . $this->filename . '.zip', 0777);

                    $isExtract = Sunat::extractZip('../files/R-' . $this->filename . '.zip', '../files/');
                    if (!$isExtract) {
                        throw new Exception("No se pudo extraer el contenido del archivo zip.");
                    }

                    if (file_exists('../files/' . $this->filename . '.zip')) {
                        unlink('../files/' . $this->filename . '.zip');
                    }
                    if (file_exists('../files/R-' . $this->filename . '.zip')) {
                        unlink('../files/R-' . $this->filename . '.zip');
                    }

                    $this->setAccepted(true);
                    $this->setCode($result->codRespuesta);
                    $this->setMessage("La Guía de remisión fue declarada correctamente.");
                    $this->setSuccess(true);
                } else if ($result->codRespuesta == "98") {
                    if (file_exists('../files/' . $this->filename . '.xml')) {
                        unlink('../files/' . $this->filename . '.xml');
                    }
                    if (file_exists('../files/' . $this->filename . '.zip')) {
                        unlink('../files/' . $this->filename . '.zip');
                    }

                    $this->setAccepted(true);
                    $this->setCode($result->codRespuesta);
                    $this->setMessage("El proceso de envío, consulte en un par de minutos nuevamente.");
                    $this->setSuccess(true);
                } else if ($result->codRespuesta == "99") {
                    if (file_exists('../files/' . $this->filename . '.xml')) {
                        unlink('../files/' . $this->filename . '.xml');
                    }
                    if (file_exists('../files/' . $this->filename . '.zip')) {
                        unlink('../files/' . $this->filename . '.zip');
                    }
                    
                    $this->setAccepted(false);
                    $this->setCode($result->codRespuesta);
                    if (isset($result->error)) {
                        $this->setMessage($result->error->desError);
                    } else {
                        $this->setMessage("Se genero un problema, comuníquese con su proveedor del software.");
                    }
                    $this->setSuccess(true);
                } else {
                    if (file_exists('../files/' . $this->filename . '.xml')) {
                        unlink('../files/' . $this->filename . '.xml');
                    }
                    if (file_exists('../files/' . $this->filename . '.zip')) {
                        unlink('../files/' . $this->filename . '.zip');
                    }

                    $this->setAccepted(false);
                    $this->setCode($result->codRespuesta);
                    $this->setMessage("Se genero un problema, comuníquese con su proveedor del software.");
                    $this->setSuccess(true);
                }
            } else {
                if ($response) {
                    if (file_exists('../files/' . $this->filename . '.xml')) {
                        unlink('../files/' . $this->filename . '.xml');
                    }
                    if (file_exists('../files/' . $this->filename . '.zip')) {
                        unlink('../files/' . $this->filename . '.zip');
                    }

                    $result = (object)json_decode($response);
                    
                    $this->setSuccess(false);
                    $this->setCode($result->cod);
                    $this->setMessage($result->msg);
                } else {
                    if (file_exists('../files/' . $this->filename . '.xml')) {
                        unlink('../files/' . $this->filename . '.xml');
                    }
                    if (file_exists('../files/' . $this->filename . '.zip')) {
                        unlink('../files/' . $this->filename . '.zip');
                    }

                    $this->setSuccess(false);
                    $this->setCode("-1");
                    $this->setMessage("Se presento una condicion inesperada que impidio completar el
                    Request");
                }
            }
        } catch (Exception $ex) {
            if (file_exists('../files/' . $this->filename . '.xml')) {
                unlink('../files/' . $this->filename . '.xml');
            }
            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            
            $this->setSuccess(false);
            $this->setCode("-1");
            $this->setMessage($ex->getMessage());
        }
    }

    public function setConfigGuiaRemision(string $filezip)
    {
        $this->filebase64 = Sunat::generateBase64File($filezip);
        $this->hashZip = Sunat::generateHashFile("sha256", $filezip);
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function isAccepted()
    {
        return $this->accepted;
    }

    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getHashCode()
    {
        return $this->hashCode;
    }

    public function setHashCode($hashCode)
    {
        $this->hashCode = $hashCode;
    }

    public function getTicket()
    {
        return $this->ticket;
    }

    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }
}
