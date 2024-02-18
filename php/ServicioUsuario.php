<?php

include_once 'ConsultasUsuario.php';
include_once 'ConsultasUsuarioPermiso.php';

class ServicioUsuario
{
    public function autenticarUsuario($usuario, $contrasenia)
    {
        if (!empty($usuario) && !empty($contrasenia)) {
            $resultado = ConsultasUsuario::autenticarUsuario($usuario, $contrasenia);

            if (isset($resultado) && $resultado > 0) {
                session_start();
                $_SESSION['autenticado'] = true;
                $permisos = $this->obtenerPermisosUsuario($resultado);
                $_SESSION['permisos'] = $permisos;

                header("Location: /abravog/index.php");
            } else {
                header("Location: /abravog/login.php");
            }
        } else {
            header("Location: /abravog/login.php");
        }
    }

    private function obtenerPermisosUsuario($idEmpleado)
    {
        $resultado = ConsultasUsuario::obtenerPermisosUsuario($idEmpleado);

        foreach ($resultado as $permiso) {
            $listaPermisos[] = $permiso['permiso'];
        }

        return $listaPermisos;
    }

    public function obtenerPermisosUsuarioDetalle()
    {
        $resultado = ConsultasUsuario::obtenerPermisosUsuarioDetalle();

        foreach ($resultado as $lst) {
            $permisos = ConsultasUsuario::obtenerPermisosUsuario($lst["id_empleado"]);
            foreach ($permisos as $permiso) {
                $listaPermisos[] = $permiso['id_permiso'];
            }

            $datos[] = array(
                "id_empleado" => $lst["id_empleado"],
                "usuario" => $lst["usuario"],
                "nombre" => $lst["nombre"],
                "permisos" => $listaPermisos ?? []
            );
            $listaPermisos = null;
        }

        return $datos;
    }

    public function guardarPermisosUsuarios($idEmpleado, $lstPermisos)
    {
        if (isset($idEmpleado)) {
            $resultado = ConsultasUsuario::obtenerPermisosUsuario($idEmpleado);
            foreach ($resultado as $permiso) {
                $lstPermisosActual[] = $permiso['id_permiso'];
            }

            if (isset($lstPermisos)) {
                //#####EMPIEZA A BUSCAR PERMISOS NUEVOS Y ACTIVAR EXISTENTES
                if (!empty($lstPermisosActual)) {
                    foreach ($lstPermisos as $nuevoPermiso) {
                        if (!in_array($nuevoPermiso, $lstPermisosActual)){
                            $lstNuevosPermisos[] = $nuevoPermiso;
                        }
                    }
                }

                //#####VALIDA QUE EXISTAN NUEVOS PERMISOS
                if (!empty($lstNuevosPermisos)) {
                    foreach ($lstNuevosPermisos as $idPermiso) {
                        //#####COMPRUEBA SI YA EXISTE EL PERMISO.
                        $existePermiso = ConsultasUsuarioPermiso::existePermisoUsuario($idEmpleado, $idPermiso);
                        if ($existePermiso) {
                            ConsultasUsuarioPermiso::activarPermisoUsuario($idEmpleado, $idPermiso);
                        } else {
                            ConsultasUsuarioPermiso::agregarPermisoUsuario($idEmpleado, $idPermiso);
                        }
                    }
                } else if (!empty($lstPermisos)) { //CASO CONTRARIO, TOMA LOS QUE RECIBIÓ EL FORMULARIO.
                    foreach ($lstPermisos as $idPermiso) {
                        $existePermiso = ConsultasUsuarioPermiso::existePermisoUsuario($idEmpleado, $idPermiso);
                        if ($existePermiso) {
                            ConsultasUsuarioPermiso::activarPermisoUsuario($idEmpleado, $idPermiso);
                        } else {
                            ConsultasUsuarioPermiso::agregarPermisoUsuario($idEmpleado, $idPermiso);
                        }
                    }
                }
                //#####TERMINA PERMISOS NUEVOS Y ACTIVAR EXISTENTES

                //#####EMPIEZA PERMISOS REMOVIDOS
                if (!empty($lstPermisosActual)) {
                    $permisos_quitados = array_diff($lstPermisosActual, $lstPermisos);

                    if (!empty($permisos_quitados)) {
                        ConsultasUsuarioPermiso::removerPermisoUsuario($idEmpleado, $permisos_quitados);
                    }
                }
                //#####TERMINA PERMISOS REMOVIDOS

            } else {
                //ACA DESACTIVO TODOS LOS PERMISOS.
                if (!empty($lstPermisosActual)) {
                    ConsultasUsuarioPermiso::removerPermisoUsuario($idEmpleado, $lstPermisosActual);
                }
            }
            header('Location: ../adminPermisosUsuario.php');
        }
    }
}