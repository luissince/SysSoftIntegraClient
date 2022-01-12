<?php

namespace SysSoftIntegra\Src;

class Tools
{

    public static function calculateTax(float $porcentaje, float $valor)
    {
        return (float) ($valor * ($porcentaje / 100.00));
    }

    public static function calculateTaxBruto(float $impuesto, float $monto)
    {
        return $monto / (($impuesto + 100) * 0.01);
    }

    public static function formatNumber($numeracion, $length = 6)
    {
        return strlen($numeracion) > $length ? $numeracion : substr(str_repeat(0, $length) . $numeracion, -$length);
    }

    public static function roundingValue(float $valor, int $decimals = 2)
    {
        return number_format(round($valor, 2, PHP_ROUND_HALF_UP), $decimals, '.', '');
    }

    public static function printErrorJson($result)
    {
        header('Content-Type: application/json; charset=UTF-8');
        print json_encode($result);
    }

    public static function showImageReport($image)
    {
        return $image == "" ?  '<img src="./../../view/images/logo.png" />' : '<img width="120" src="data:image/(png|jpg|gif);base64, ' . $image . '"/>';
    }
}
