<?php
session_start();
if (!isset($_SESSION['autenticado']))
    $_SESSION['permisos'] = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Parallax Template - Materialize</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/main.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="index.php" class="brand-logo">Logo</a>
        <?php if (!isset($_SESSION['autenticado'])) { ?>
            <ul class="right hide-on-med-and-down">
                <li><a href="login.php">Iniciar sesion</a></li>
            </ul>
        <?php } ?>

        <?php if (isset($_SESSION['autenticado'])) { ?>
            <ul class="right hide-on-med-and-down">
                <li><a href="php/cerrarSesion.php">Cerrar sesion</a></li>
            </ul>
        <?php } ?>


        <?php if (isset($_SESSION['permisos']) && in_array("ADMIN_EMPLEADOS", $_SESSION['permisos'])) { ?>
            <ul class="right hide-on-med-and-down">
                <li><a href="adminEmpleados.php">Administracion de empleados</a></li>
            </ul>
        <?php } ?>

        <?php if (isset($_SESSION['permisos']) && in_array("ADMIN_PERMISOS_USUARIO", $_SESSION['permisos'])) { ?>
            <ul class="right hide-on-med-and-down">
                <li><a href="adminPermisosUsuario.php">Administracion de permisos de usuario</a></li>
            </ul>
        <?php } ?>

        <ul id="nav-mobile" class="sidenav">
            <?php if (!isset($_SESSION['autenticado'])) { ?>
                <li><a href="login.php">Iniciar sesion</a></li>
            <?php } ?>
            <?php if (isset($_SESSION['autenticado'])) { ?>
                <li><a href="php/cerrarSesion.php">Cerrar sesion</a></li>
            <?php } ?>
            <?php if (isset($_SESSION['permisos']) && in_array("ADMIN_EMPLEADOS", $_SESSION['permisos'])) { ?>
                <li><a href="adminEmpleados.php">Admin. de empleados</a></li>
            <?php } ?>
            <?php if (isset($_SESSION['permisos']) && in_array("ADMIN_PERMISOS_USUARIO", $_SESSION['permisos'])) { ?>
                <li><a href="adminPermisosUsuario.php">Admin. permisos de usuario</a></li>
            <?php } ?>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>