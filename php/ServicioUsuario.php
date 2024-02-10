<?php

include 'ConsultasUsuario.php';
class ServicioUsuario
{
    public function autenticarUsuario($usuario, $contrasenia)
    {
        if (!empty($usuario) && !empty($contrasenia)){
            $resultado = ConsultasUsuario::autenticarUsuario($usuario, $contrasenia);

            if (isset($resultado) && $resultado > 0) {
                session_start();
                $_SESSION['autenticado'] = true;
                $permisos = $this->obtenerPermisos($resultado);
                $_SESSION['permisos'] = $permisos;

                header("Location: /abravog/index.php");
            } else {
                header("Location: /abravog/login.php");
            }
        } else {
            header("Location: /abravog/login.php");
        }
    }

    private function obtenerPermisos($idUsuario)
    {
        $resultado = ConsultasUsuario::obtenerPermisos($idUsuario);

        foreach ($resultado as $permiso) {
            $listaPermisos[] = $permiso['permiso'];
        }

        return $listaPermisos;
    }
}