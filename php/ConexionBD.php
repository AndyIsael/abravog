<?php

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
        echo 'Conexion exitosa';
    }
} catch (Exception $e) {
    echo 'Ocurrió un error inesperado: ';
    echo $e;
    die();
}
