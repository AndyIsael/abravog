<?php

include 'ServicioUsuario.php';

if(isset($_POST['iniciar'])){
    $servicioUsuario = new ServicioUsuario();
    $servicioUsuario->autenticarUsuario($_POST['usuario'], $_POST['contrasena']);
}