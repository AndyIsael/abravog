<?php include './componentes/bodyI.php' ?>
<?php
if (!isset($_SESSION['autenticado'])) {
    header('Location: index.php');
}
if (!isset($_SESSION['permisos']) || !in_array("ADMIN_PERMISOS_USUARIO", $_SESSION['permisos'])) {
    header('Location: index.php');
}

include_once './php/ServicioPermisos.php';
$servicioPermisos = new ServicioPermisos();

include_once './php/ServicioUsuario.php';
$servicioUsuario = new ServicioUsuario();
?>

<div class="card margen-card teal lighten-5 z-depth-3">
    <div class="card-content">
        <div class="card-title">
            <div class="row">
                <div class="col s12"><b>Administracion de permisos de usuario</b></div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="centered responsive-table">
                    <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($servicioUsuario->obtenerPermisosUsuarioDetalle() as $usuario) { ?>
                        <tr>
                            <td><?php echo $usuario['usuario'] ?></td>
                            <td><?php echo $usuario['nombre'] ?></td>
                            <td>
                                <button data-target="editarPermiso<?php echo $usuario['id_empleado'] ?>"
                                        class="btn waves-effect waves-light yellow darken-2 modal-trigger">
                                    Administrar permisos
                                    <i class="material-icons left">create</i>
                                </button>
                                <div id="editarPermiso<?php echo $usuario['id_empleado'] ?>" class="modal"
                                     style="width: 100%; max-height: 100%; text-align: left !important;">
                                    <form method="post" action="./php/EscucharUsuario.php">
                                        <input type="hidden" name="id" value="<?php echo $usuario['id_empleado']; ?>">
                                        <div class="modal-content teal lighten-5">
                                            <div class="card-title">
                                                <div class="row">
                                                    <div class="col s12">
                                                        <b>Administracion de permisos de usuario - <span style="font-weight: 600"><?php echo $usuario['usuario'] ?></span></b>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <?php
                                                foreach ($servicioPermisos->obtenerPermisos() as $permiso) { ?>
                                                    <div class="col s6 m4 l3 x2" style="margin-top: 1em">
                                                        <label>
                                                            <input type="checkbox" class="filled-in" name="permisos[]"
                                                                   value="<?php echo $permiso['id_permiso']; ?>"
                                                                <?php if (in_array($permiso['id_permiso'], $usuario['permisos'])) echo 'checked' ?>
                                                            />
                                                            <span><?php echo $permiso['permiso']; ?></span>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer teal lighten-5"
                                             style="text-align: center !important; height: 100%;">
                                            <button type="submit" name="actualizarPermisos"
                                                    class="waves-effect waves-light btn-large"
                                                    style="margin-right: 1em !important;">
                                                Guardar
                                            </button>
                                            <a class="modal-close waves-effect waves-light btn-flat btn-large border-red btn-large-red"
                                               style="margin-left: 1em !important;">Cancelar</a>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php include './componentes/bodyO.php' ?>
