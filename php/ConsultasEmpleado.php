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
                        e.fecha_nacimiento,
                        g.genero,
                        e.sueldo_base,
                        ed.puesto,
                        ed.experiencia_profesional,
                        e.id_genero
                    FROM
                        empleado AS e
                    LEFT JOIN empleados_detalle ed ON
                        ed.id_empleado = e.id_empleado
                    JOIN genero g ON
                        g.id_genero = e.id_genero
                    WHERE e.activo = 1';
        $query = $mysqli->query($consulta);
        $datos = array();
        while ($registro = $query->fetch_assoc()) {
            $registro['fecha_nacimiento'] = FuncionesAyuda::convertirFechaDDMMYYYY($registro['fecha_nacimiento']);
            $registro['edad'] = FuncionesAyuda::calcularEdad($registro['fecha_nacimiento']);
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

    public static function crearEmpleado($clave, $nombre, $fcnacimiento, $genero, $sueldo)
    {
        $mysqli = Conexion::conexion();

        $consulta = "INSERT INTO empleado (clave_empleado, nombre, fecha_nacimiento, id_genero, sueldo_base) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($consulta)) {

            $stmt->bind_param('sssii', $clave, $nombre, $fcnacimiento, $genero, $sueldo);

            if ($stmt->execute()) {
                $idEmpleado = $mysqli->insert_id;
                $stmt->close();
                return $idEmpleado;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public static function actualizarEmpleado($id, $clave, $nombre, $fcnacimiento, $genero, $sueldo)
    {
        $mysqli = Conexion::conexion();

        $consulta = "UPDATE empleado AS e SET clave_empleado = ?, nombre = ?, fecha_nacimiento = ?, id_genero = ?, sueldo_base = ? WHERE e.id_empleado = ?";
        if ($stmt = $mysqli->prepare($consulta)) {
            $stmt->bind_param('sssiii', $clave, $nombre, $fcnacimiento, $genero, $sueldo, $id);

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