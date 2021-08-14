<?php

class Autoload_Static
{
    public static function files()
    {
        return array(
            'SysSoftIntegra\\Model\\VentasAdo' => __DIR__  . '/../model/VentasAdo.php',
            'SysSoftIntegra\\Model\\DetalleAdo' => __DIR__  . '/../model/DetalleAdo.php',
            'SysSoftIntegra\\Src\\Sunat' => __DIR__  . '/Sunat.php',
            'SysSoftIntegra\\Src\\SoapResult' => __DIR__  . '/SoapResult.php',
            'SysSoftIntegra\\Src\\SoapBuilder' => __DIR__  . '/SoapBuilder.php',
            'SysSoftIntegra\\Src\\NumberLleters' => __DIR__  . '/NumberLleters.php',
            'SysSoftIntegra\\Src\\GenerateXml' => __DIR__  . '/GenerateXml.php',
            'SysSoftIntegra\\Src\\GenerateXml' => __DIR__  . '/GenerateXml.php',
            'Phpspreadsheet\\Vendor\\Autload' => __DIR__ . '/../sunat/lib/phpspreadsheet/vendor/autoload.php',
            'RobRichards\\XMLSecLibs\\XMLSecurityDSig' => __DIR__ . '/../sunat/lib/robrichards/src/XMLSecurityDSig.php',
            'RobRichards\\XMLSecLibs\\XMLSecurityKey' => __DIR__ . '/../sunat/lib/robrichards/src/XMLSecurityKey.php'
        );
    }
}
