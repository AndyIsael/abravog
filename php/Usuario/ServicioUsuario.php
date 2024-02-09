<?php

include 'ConsultasUsuario.php';
class ServicioUsuario
{
    public function autenticarUsuario($usuario, $contrasenia)
    {
        if (!empty($usuario) && !empty($contrasenia)){
            $resultado = ConsultasUsuario::autenticarUsuario($usuario, $contrasenia);

            if ($resultado > 0) {
                session_start();
                $_SESSION['autenticado'] = true;

                header("Location: /abravog/index.php");
            } else {
                header("Location: /abravog/login.php");
            }
        } else {
            header("Location: /abravog/login.php");
        }
    }
}