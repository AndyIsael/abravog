<?php

include 'ConsultasEmpleado.php';

class ServicioEmpleado
{
    public function obtenerEmpleados()
    {
        $resultado = ConsultasEmpleado::obtenerEmpleados();
        return $resultado;
    }

    public function eliminarEmpleado($id)
    {
        $resultado = ConsultasEmpleado::eliminarEmpleado($id);

        if ($resultado > 0) {
            return true;
        } else {
            return false;
        }
    }
}