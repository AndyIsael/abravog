<?php

//include '../Conexion.php';
//include 'php/Conexion.php';
include 'Conexion.php';

class ConsultasEmpleado
{
    public static function obtenerEmpleados()
    {
        $mysqli = Conexion::conexion();

        $consulta = 'SELECT
                        e.id_empleado,
                        e.clave_empleado,
                        e.nombre,
                        e.edad,
                        e.fecha_nacimiento,
                        g.genero,
                        e.sueldo_base,
                        ed.puesto,
                        ed.experiencia_profesional
                    FROM
                        empleado AS e
                    JOIN empleados_detalle ed ON
                        ed.id_empleado = e.id_empleado
                    JOIN genero g ON
                        g.id_genero = e.id_genero
                    WHERE e.activo = 1';
        $query = $mysqli->query($consulta);
        $datos = array();
        while ($registro = $query->fetch_assoc()) {
            $datos[] = $registro;
        }

        return $datos;
    }

    public static function eliminarEmpleado($id)
    {
//        $mysqli = Conexion::conexion();
        $mysqli = new mysqli(
            'localhost',
            'root',
            '',
            'abravog',
            '3306',
        );

        $consulta = "UPDATE empleado AS e SET activo = 0 WHERE e.id_empleado = '$id'";
        $resultado = $mysqli->query($consulta);

        if ($resultado) {
            return $mysqli->affected_rows;
        } else {
            return 0;
        }
    }
}