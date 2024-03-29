<?php include './componentes/bodyI.php' ?>
<?php
if (!isset($_SESSION['autenticado'])) {
    header('Location: index.php');
}
if (!isset($_SESSION['permisos']) || !in_array("ADMIN_EMPLEADOS", $_SESSION['permisos'])) {
    header('Location: index.php');
}

include("./php/ServicioEmpleado.php");
$servicioEmpleado = new ServicioEmpleado();
include_once './php/FuncionesAyuda.php';
include_once './php/ServicioExterno.php';
?>
    <div class="card margen-card teal lighten-5 z-depth-3">
        <div class="card-content">
            <div class="card-title">
                <div class="row">
                    <div class="col s10"><b>Administracion de empleados</b></div>
                    <div class="col s2">
                        <?php if (in_array("ADMIN_EMPLEADOS_CREAR", $_SESSION['permisos'])) { ?>
                            <button data-target="formularioEmpleados"
                                    class="btn waves-effect waves-light modal-trigger">
                                Crear empleado
                                <i class="material-icons left">add</i>
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div id="formularioEmpleados" class="modal" style="width: 100%; max-height: 100%">
                <form method="post" action="./php/EscucharEmpleado.php">
                    <div class="modal-content teal lighten-5">
                        <?php include './componentes/formularioEmpleados.php' ?>
                    </div>
                    <div class="modal-footer teal lighten-5" style="text-align: center !important; height: 100%;">
                        <button type="submit" name="altaEmpleado" class="waves-effect waves-light btn-large"
                                style="margin-right: 1em !important;">
                            Guardar
                        </button>
                        <a class="modal-close waves-effect waves-light btn-flat btn-large border-red btn-large-red"
                           style="margin-left: 1em !important;">Cancelar</a>
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
                            <th>Sueldo Base (MXN)</th>
                            <th>Sueldo Base (USD)</th>
                            <th>Puesto</th>
                            <th>Experiencia Profesional</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $resultadoDolar = ServicioExterno::obtenerTipoCambioPesosporDolar();
                        foreach ($servicioEmpleado->obtenerEmpleados() as $empleado) { ?>
                            <tr>
                                <td><?php echo $empleado['clave_empleado'] ?></td>
                                <td><?php echo $empleado['nombre'] ?></td>
                                <td><?php echo $empleado['edad'] ?></td>
                                <td><?php echo $empleado['fecha_nacimiento'] ?></td>
                                <td><?php echo $empleado['genero'] ?></td>
                                <td><?php echo FuncionesAyuda::convertirMoneda($empleado['sueldo_base']) ?></td>
                                <td><?php echo FuncionesAyuda::convertirPesoADolar($empleado['sueldo_base'], $resultadoDolar) ?></td>
                                <td><?php echo $empleado['puesto'] ?></td>
                                <td><?php echo $empleado['experiencia_profesional'] ?></td>
                                <td>
                                    <?php if (in_array("ADMIN_EMPLEADOS_EDITAR", $_SESSION['permisos'])) { ?>
                                        <button data-target="modalEditar<?php echo $empleado['id_empleado'] ?>"
                                                class="btn-floating btn-small waves-effect waves-light yellow darken-2 modal-trigger"
                                                title="Editar empleado">
                                            <i class="material-icons left">create</i>
                                        </button>
                                    <?php } ?>
                                    <div id="modalEditar<?php echo $empleado['id_empleado'] ?>" class="modal"
                                         style="width: 100%; max-height: 100%; text-align: left !important;">
                                        <form method="post" action="./php/EscucharEmpleado.php">
                                            <div class="modal-content teal lighten-5">
                                                <?php include './componentes/formularioEmpleados.php' ?>
                                            </div>
                                            <div class="modal-footer teal lighten-5"
                                                 style="text-align: center !important; height: 100%;">
                                                <button type="submit" name="actualizar"
                                                        class="waves-effect waves-light btn-large"
                                                        style="margin-right: 1em !important;">
                                                    Guardar
                                                </button>
                                                <a class="modal-close waves-effect waves-light btn-flat btn-large border-red btn-large-red"
                                                   style="margin-left: 1em !important;">Cancelar</a>
                                            </div>
                                        </form>
                                    </div>
                                    <!--ELIMINAR EMPLEADO-->
                                    <?php if (in_array("ADMIN_EMPLEADOS_ELIMINAR", $_SESSION['permisos'])) { ?>
                                        <button data-target="modal<?php echo $empleado['id_empleado'] ?>"
                                                class="btn-floating btn-small waves-effect waves-light red modal-trigger"
                                                title="Eliminar empleado">
                                            <i class="material-icons left">delete</i>
                                        </button>
                                    <?php } ?>
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
    </div>

<?php include './componentes/bodyO.php' ?>