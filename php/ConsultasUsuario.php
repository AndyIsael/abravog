<?php

//include '../Conexion.php';
//include 'php/Conexion.php';
include_once 'Conexion.php';

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

    public static function obtenerPermisosUsuario($idEmpleado)
    {
        $mysqli = Conexion::conexion();

        $consulta = "SELECT u.id_usuario, e.id_empleado, p.id_permiso, p.permiso FROM usuario AS u
                        JOIN empleado e ON
                        e.id_empleado = u.id_empleado
                        LEFT JOIN usuario_permiso up ON
                        up.id_empleado = e.id_empleado
                        LEFT JOIN permiso p ON
                        p.id_permiso = up.id_permiso
                        WHERE u.id_empleado = '$idEmpleado' 
                        AND up.activo = 1;";
        $query = $mysqli->query($consulta);
        $datos = array();
        while ($registro = $query->fetch_assoc()) {
            $datos[] = $registro;
        }

        return $datos;
    }

    public static function obtenerPermisosUsuarioDetalle()
    {
        $mysqli = Conexion::conexion();

        $consulta = "SELECT
                        u.usuario,
                        e.id_empleado,
                        e.nombre
                    FROM
                        usuario u
                    JOIN empleado e ON
                        e.id_empleado = u.id_usuario";
        $query = $mysqli->query($consulta);
        $datos = array();
        while ($registro = $query->fetch_assoc()) {
            $datos[] = $registro;
        }

        return $datos;
    }
}