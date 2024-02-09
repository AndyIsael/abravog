<?php
session_start();

include("php/Empleado/ServicioEmpleado.php");
$servicioEmpleado = new ServicioEmpleado();
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

        <ul id="nav-mobile" class="sidenav">
            <li><a href="#">Navbar Link</a></li>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>