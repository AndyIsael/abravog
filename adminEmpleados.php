<?php include 'componentes/bodyI.php' ?>
<?php
if (!isset($_SESSION['autenticado']) && !in_array("ADMIN", $_SESSION['permisos'])) {
    header('Location: index.php');
}

include("php/ServicioEmpleado.php");
$servicioEmpleado = new ServicioEmpleado();
?>
    <div class="card margen-card teal lighten-5 z-depth-3">
        <form method="" action="">
            <div class="card-content">
                <span class="card-title"><b>Administracion de empleados</b></span>

                <div class="row">
                    <div class="col s12">
                        <table class="centered">
                            <thead>
                            <tr>
                                <th>ID Empleado</th>
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
                                    <td><?php echo $empleado['id_empleado'] ?></td>
                                    <td><?php echo $empleado['clave_empleado'] ?></td>
                                    <td><?php echo $empleado['nombre'] ?></td>
                                    <td><?php echo $empleado['edad'] ?></td>
                                    <td><?php echo $empleado['fecha_nacimiento'] ?></td>
                                    <td><?php echo $empleado['genero'] ?></td>
                                    <td><?php echo $empleado['sueldo_base'] ?></td>
                                    <td><?php echo $empleado['puesto'] ?></td>
                                    <td><?php echo $empleado['experiencia_profesional'] ?></td>
                                    <td class="center">
                                        <button data-target="modal<?php echo $empleado['id_empleado']?>" class="btn-floating btn-small waves-effect waves-light red modal-trigger">
                                            <i class="material-icons left">delete</i>
                                        </button>

                                        <div id="modal<?php echo $empleado['id_empleado']?>" class="modal center">
                                            <div class="modal-content">
                                                <h4>¿Está seguro de eliminar?</h4>

                                                <div class="margen-3">
                                                    <a href="php/EscucharEmpleado.php?id=<?php echo $empleado['id_empleado']?>" class="btn btn-large waves-effect waves-light red modal-close">Si</a>
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

<?php include 'componentes/bodyO.php' ?>