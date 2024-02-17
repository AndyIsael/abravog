<?php

class FuncionesAyuda
{
    public static function convertirFechaDDMMYYYY($fecha)
    {
        $fechaObjeto = DateTime::createFromFormat('Y-m-d', $fecha);
        return $fechaObjeto->format('d/m/Y');
    }

    public static function convertirFechaYYYYMMDD($fecha)
    {
        $fechaObjeto = DateTime::createFromFormat('d/m/Y', $fecha);
        return $fechaObjeto->format('Y-m-d');
    }

    public static function calcularEdad($fecha)
    {
        $fechaNacimiento = DateTime::createFromFormat('d/m/Y', $fecha);
        $fechaActual = new DateTime();

        return $fechaNacimiento->diff($fechaActual)->y;
    }

    public static function convertirMoneda($numero)
    {
        $numeroFormatoMoneda = number_format($numero, 2, '.', ',');
        return "$" . $numeroFormatoMoneda;
    }
}