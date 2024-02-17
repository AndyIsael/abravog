<?php

include_once './ServicioEmpleado.php';

$servicioEmpleado = new ServicioEmpleado();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $respuesta = $servicioEmpleado->eliminarEmpleado($id);

    header('Location: ../adminEmpleados.php');
} else if (isset($_POST['actualizar'])) {
    $servicioEmpleado->actualizarEmpleado($_POST['id'],
        $_POST['clave'],
        $_POST['nombre'],
        $_POST['fcnacimiento'],
        $_POST['genero'],
        $_POST['sueldo'],
        $_POST['puesto'],
        $_POST['xprofecional']
    );
} else if (isset($_POST['altaEmpleado'])) {
    $servicioEmpleado->crearEmpleado($_POST['clave'],
        $_POST['nombre'],
        $_POST['fcnacimiento'],
        $_POST['genero'],
        $_POST['sueldo'],
        $_POST['puesto'],
        $_POST['xprofecional']
    );
}

