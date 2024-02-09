<?php

include 'ConsultasEmpleado.php';

class ServicioEmpleado
{
    public function obtenerEmpleados()
    {
        $resultado = ConsultasEmpleado::obtenerEmpleados();
        return $resultado;
    }
}