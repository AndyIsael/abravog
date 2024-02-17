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
}