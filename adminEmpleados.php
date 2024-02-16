<?php include './componentes/bodyI.php' ?>
<?php
if (!isset($_SESSION['autenticado']) && !in_array("ADMIN", $_SESSION['permisos'])) {
    header('Location: index.php');
}

include("./php/ServicioEmpleado.php");
$servicioEmpleado = new ServicioEmpleado();
?>
    <div class="card margen-card teal lighten-5 z-depth-3">
        <form method="" action="">
            <div class="card-content">
                <div class="card-title">
                    <div class="row">
                        <div class="col s10"><b>Administracion de empleados</b></div>
                        <div class="col s2">
                            <button data-target="formularioEmpleados" class="btn waves-effect waves-light modal-trigger">Crear empleado
                                <i class="material-icons left">add</i>
                            </button>
                        </div>
                    </div>
                </div>

                <div id="formularioEmpleados" class="modal" style="width: 100%; max-height: 100%">
                    <form>
                        <div class="modal-content teal lighten-5">
                            <?php include './componentes/formularioEmpleados.php' ?>
                        </div>
                        <div class="modal-footer teal lighten-5" style="text-align: center !important; height: 100%;">
                            <button type="submit" class="waves-effect waves-light btn-large" style="margin-right: 1em !important;">
                                Guardar
                            </button>
                            <a class="modal-close waves-effect waves-light btn-flat btn-large border-red btn-large-red" style="margin-left: 1em !important;">Cancelar</a>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col s12">
                        <table class="centered responsive-table">
                            <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Género</th>
                                <th>Sueldo Base</th>
                                <th>Puesto</th>
                                <th>Experiencia Profesional</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($servicioEmpleado->obtenerEmpleados() as $empleado) { ?>
                                <tr>
                                    <td><?php echo $empleado['clave_empleado'] ?></td>
                                    <td><?php echo $empleado['nombre'] ?></td>
                                    <td><?php echo $empleado['edad'] ?></td>
                                    <td><?php echo $empleado['fecha_nacimiento'] ?></td>
                                    <td><?php echo $empleado['genero'] ?></td>
                                    <td><?php echo $empleado['sueldo_base'] ?></td>
                                    <td><?php echo $empleado['puesto'] ?></td>
                                    <td><?php echo $empleado['experiencia_profesional'] ?></td>
                                    <td>
                                        <button data-target="modalEditar<?php echo $empleado['id_empleado'] ?>"
                                                class="btn-floating btn-small waves-effect waves-light yellow darken-2 modal-trigger"
                                                title="Editar empleado">
                                            <i class="material-icons left">create</i>
                                        </button>
                                        <div id="modalEditar<?php echo $empleado['id_empleado'] ?>" class="modal" style="width: 100%; max-height: 100%; text-align: left !important;">
                                            <form method="post" action="./php/EscucharEmpleado.php">
                                                <div class="modal-content teal lighten-5">
                                                    <?php include './componentes/formularioEmpleados.php' ?>
                                                </div>
                                                <div class="modal-footer teal lighten-5" style="text-align: center !important; height: 100%;">
                                                    <button type="submit" name="actualizar" class="waves-effect waves-light btn-large" style="margin-right: 1em !important;">
                                                        Guardar
                                                    </button>
                                                    <a class="modal-close waves-effect waves-light btn-flat btn-large border-red btn-large-red" style="margin-left: 1em !important;">Cancelar</a>
                                                </div>
                                            </form>
                                        </div>
                                        <!--ELIMINAR EMPLEADO-->
                                        <button data-target="modal<?php echo $empleado['id_empleado'] ?>"
                                                class="btn-floating btn-small waves-effect waves-light red modal-trigger"
                                                title="Eliminar empleado">
                                            <i class="material-icons left">delete</i>
                                        </button>

                                        <div id="modal<?php echo $empleado['id_empleado'] ?>" class="modal center">
                                            <div class="modal-content">
                                                <h4>¿Está seguro de eliminar a <b><?php echo $empleado['nombre'] ?></b>?
                                                </h4>

                                                <div class="margen-3">
                                                    <a href="php/EscucharEmpleado.php?id=<?php echo $empleado['id_empleado'] ?>"
                                                       class="btn btn-large waves-effect waves-light red modal-close">Si</a>
                                                    <a class="btn btn-large waves-effect waves-light green modal-close">No</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </form>
    </div>

<?php include './componentes/bodyO.php' ?>