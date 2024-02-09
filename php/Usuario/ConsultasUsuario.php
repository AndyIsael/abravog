<?php

include '../Conexion.php';
//include 'php/Conexion.php';
//include 'Conexion.php';

class ConsultasUsuario
{
    public static function autenticarUsuario($usuario, $pass)
    {
        $mysqli = Conexion::conexion();

        $consulta = "SELECT COUNT(*) AS existe FROM usuario WHERE usuario = '$usuario' AND password = '$pass'";
        $query = $mysqli->query($consulta);

        $resultado = $query->fetch_assoc();

        return $resultado['existe'];
    }
}