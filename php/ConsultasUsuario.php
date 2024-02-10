<?php

//include '../Conexion.php';
//include 'php/Conexion.php';
include 'Conexion.php';

class ConsultasUsuario
{
    public static function autenticarUsuario($usuario, $pass)
    {
        $mysqli = Conexion::conexion();

        $consulta = "SELECT u.id_empleado AS id FROM usuario AS u WHERE usuario = '$usuario' AND password = '$pass' AND activo = 1";
        $query = $mysqli->query($consulta);

        $resultado = $query->fetch_assoc();

        return $resultado['id'];
    }

    public static function obtenerPermisos($idEmpleado)
    {
        $mysqli = Conexion::conexion();

        $consulta = "SELECT u.id_usuario, p.permiso FROM usuario AS u
                        JOIN empleado e ON
                        e.id_empleado = u.id_empleado
                        LEFT JOIN empleado_permiso ep ON
                        ep.id_empleado = e.id_empleado
                        LEFT JOIN permiso p ON
                        p.id_permiso = ep.id_permiso
                        WHERE u.id_empleado = '$idEmpleado';";
        $query = $mysqli->query($consulta);
        $datos = array();
        while ($registro = $query->fetch_assoc()) {
            $datos[] = $registro;
        }

        return $datos;
    }
}