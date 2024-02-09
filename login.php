<?php include 'componentes/bodyI.php' ?>
<?php
if (isset($_SESSION['autenticado'])) {
    header('Location: index.php');
}
?>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col s3"></div>
        <div class="col s6 center">
            <div class="card grey darken-3 z-depth-5">
                <form method="post" action="php/Usuario/EscucharUsuario.php">
                    <div class="card-content white-text">
                        <span class="card-title">Iniciar sesion</span>
                        <div class="row">
                            <div class="col s12">
                                <div class="input-field">
                                    <input name="usuario" placeholder="Ingrese Usuario" id="text" type="text"
                                           class="validate text-primary">
                                    <label for="text">Usuario</label>
                                </div>
                            </div>
                            <div class="col s12">
                                <div class="input-field">
                                    <input name="contrasena" placeholder="Ingrese contraseña" id="password" type="password"
                                           class="validate text-primary">
                                    <label for="password">Contraseña</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <input type="submit" name="iniciar" class="waves-effect green btn" value="Iniciar Sesion">
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="col s3"></div>
    </div>

<?php include 'componentes/bodyO.php' ?>