<?php
include_once 'Conexion.php';

class ConsultasUsuarioPermiso
{
    public static function agregarPermisoUsuario($idEmpleado, $idPermiso)
    {
        $mysqli = Conexion::conexion();

        $consulta = "INSERT INTO usuario_permiso (id_empleado, id_permiso) VALUES (?, ?)";

        if ($stmt = $mysqli->prepare($consulta)) {
            $stmt->bind_param('ii', $idEmpleado, $idPermiso);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function existePermisoUsuario($idEmpleado, $idPermiso)
    {
        $mysqli = Conexion::conexion();

        $consulta = "SELECT up.id_permiso FROM usuario_permiso up WHERE up.id_empleado = ? and up.id_permiso = ?";

        if ($stmt = $mysqli->prepare($consulta)) {
            $stmt->bind_param('ii', $idEmpleado, $idPermiso);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();

                if ($resultado->num_rows > 0) {
                    $stmt->close();
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function removerPermisoUsuario($idEmpleado, $lstPermisos)
    {
        $mysqli = Conexion::conexion();
        $stmt = null;

        foreach ($lstPermisos as $idPermiso) {
            try {
                $consulta = "UPDATE usuario_permiso AS up SET activo = 0 WHERE up.id_empleado = ? AND up.id_permiso = ?";
                if ($stmt = $mysqli->prepare($consulta)) {
                    $stmt->bind_param('ii', $idEmpleado, $idPermiso);
                    $stmt->execute();

                }
            } catch (Exception $e) {
                echo $e;
                return false;
            }
        }

        $stmt->close();
        return true;
    }

    public static function activarPermisoUsuario($idEmpleado, $idPermiso)
    {
        $mysqli = Conexion::conexion();

        $consulta = "UPDATE usuario_permiso AS up SET activo = 1 WHERE up.id_empleado = ? AND up.id_permiso = ?";
        if ($stmt = $mysqli->prepare($consulta)) {
            $stmt->bind_param('ii', $idEmpleado, $idPermiso);
            $stmt->execute();
            $stmt->close();
        }
    }
}