<?php

include_once 'Conexion.php';

class ConsultasPermisos
{
    public static function obtenerPermisos()
    {
        $mysqli = Conexion::conexion();

        $consulta = "SELECT * FROM permiso;";
        $query = $mysqli->query($consulta);
        $datos = array();
        while ($registro = $query->fetch_assoc()) {
            $datos[] = $registro;
        }

        return $datos;
    }
}