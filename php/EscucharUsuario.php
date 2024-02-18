<?php

include 'ServicioUsuario.php';
$servicioUsuario = new ServicioUsuario();

if(isset($_POST['iniciar'])){
    $servicioUsuario->autenticarUsuario($_POST['usuario'], $_POST['contrasena']);
} else if (isset($_POST['actualizarPermisos'])) {
    $servicioUsuario->guardarPermisosUsuarios($_POST['id'], $_POST['permisos']);
}