<?php

include 'ServicioEmpleado.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $servicioEmpleado = new ServicioEmpleado();
    $respuesta = $servicioEmpleado->eliminarEmpleado($id);

    header('Location: ../adminEmpleados.php');
}