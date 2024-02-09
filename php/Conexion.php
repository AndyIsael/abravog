<?php

class Conexion
{

    public static function conexion(): mysqli
    {
        try {
            $mysqli = new mysqli(
                'localhost',
                'root',
                '',
                'abravog',
                '3306',
            );

            if ($mysqli->connect_errno) {
                echo 'Error de conexion de BD';
            } else {
                return $mysqli;
            }
        } catch (Exception $e) {
            echo 'Ocurrió un error inesperado: ';
            echo $e;
            die();
        }

        return $mysqli;
    }

}