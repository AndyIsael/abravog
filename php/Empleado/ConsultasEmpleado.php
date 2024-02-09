<?php

//include '../Conexion.php';
include 'php/Conexion.php';
//include 'Conexion.php';

class ConsultasEmpleado
{
    public static function obtenerEmpleados()
    {
        $mysqli = Conexion::conexion();

        $consulta = 'SELECT * FROM empleado';
        $query = $mysqli->query($consulta);
        $datos = array();
        while ($registro = $query->fetch_assoc()) {
            $datos[] = $registro;
        }

        return $datos;
    }
}