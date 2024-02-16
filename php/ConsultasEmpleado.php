<?php

//include '../Conexion.php';
//include 'php/Conexion.php';
include_once 'Conexion.php';

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
                        ed.experiencia_profesional,
                        e.id_genero
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

    public static function actualizarEmpleado($id, $clave, $nombre, $fcnacimiento, $genero, $sueldo)
    {
        $mysqli = Conexion::conexion();

        $consulta = "UPDATE empleado AS e SET clave_empleado = ?, nombre = ?, fecha_nacimiento = ?, id_genero = ?, sueldo_base = ? WHERE e.id_empleado = ?";
        if ($stmt = $mysqli->prepare($consulta)) {
            // Vincular los parámetros
            $stmt->bind_param('sssiii', $clave, $nombre, $fcnacimiento, $genero, $sueldo, $id);

            // Ejecutar la declaración
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