<?php

include_once 'Conexion.php';
class ConsultasEmpleadoDetalle
{

    public static function crearEmpleadoDetalle($idEmpleado, $puesto, $xprofecional)
    {
        $mysqli = Conexion::conexion();

        $consulta = "INSERT INTO empleados_detalle (id_empleado, puesto, experiencia_profesional) VALUES (?, ?, ?)";

        if ($stmt = $mysqli->prepare($consulta)) {

            $stmt->bind_param('iss', $idEmpleado, $puesto, $xprofecional);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function actualizarEmpleadoDetalle($id, $puesto, $xprofecional)
    {
        $mysqli = Conexion::conexion();

        $consulta = "UPDATE empleados_detalle AS ed SET ed.puesto = ?, ed.experiencia_profesional = ? WHERE ed.id_empleado = ?";
        if ($stmt = $mysqli->prepare($consulta)) {
            $stmt->bind_param('ssi', $puesto, $xprofecional, $id);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}