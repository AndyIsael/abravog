<?php

include_once 'ConsultasEmpleado.php';
include_once 'ConsultasEmpleadoDetalle.php';

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

    public function actualizarEmpleado($id, $clave, $nombre, $fcnacimiento, $genero, $sueldo, $puesto, $xprofecional)
    {
        $datosCompletos = $this->validarDatosActualizarEmpleado($id, $clave, $nombre, $fcnacimiento, $genero, $sueldo, $puesto, $xprofecional);

        if ($datosCompletos) {
            $resultado = ConsultasEmpleado::actualizarEmpleado($id, $clave, $nombre, $fcnacimiento, $genero, $sueldo);
            if ($resultado) {
                $resultado2 = ConsultasEmpleadoDetalle::actualizarEmpleadoDetalle($id, $puesto, $xprofecional);
                if ($resultado2) {
                    header('Location: ../adminEmpleados.php');
                }
            }
        }
    }

    private function validarDatosActualizarEmpleado($id, $clave, $nombre, $fcnacimiento, $genero, $sueldo, $puesto, $xprofecional)
    {
        if (isset($id) &&
            isset($clave) &&
            isset($nombre) &&
            isset($fcnacimiento) &&
            isset($genero) &&
            isset($sueldo) &&
            isset($puesto) &&
            isset($xprofecional)) {
            return true;
        } else {
            return false;
        }

    }
}