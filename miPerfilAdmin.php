<!--
    Autor: Rafael Cabezas Aranda
    Proyecto: RefGoal
    Fecha: 14/06/2022
-->

<?php
session_start();

// controlar que no se pueda acceder sin estar logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: error.html');

    session_destroy();
    die(); // si entra aqui no va a ejecutar el codigo de debajo
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefGoal Profile</title>

    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="librerias/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="librerias/sweetalert2/sweetalert2.min.css" />

    <link rel="stylesheet" href="css/estiloPrincipal.css">
</head>

<body>

<header class="header">
        <div class="logo">
            <img src="images/logoRFAF2.png">
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="mainAdmin.php">Add question</a></li>
                <li><a href="questionList.php">List questions</a></li>
                <li><a href="miPerfilAdmin.php">Change password</a></li>
            </ul>
        </nav>
        <a class="btn" href="php/logout.php"><button>Log out</button></a>
    </header>

    <h1 align="center">Change password:</h1>
    <br>

    <div class="container miPerfil">
        <form action="php/updatePass2.php" method="POST" class="formulario__register">
            <label>Current password:</label>
            <input type="password" name="passActual" class="form-control" required>
            <label>New password:</label>
            <input type="password" name="passNueva1" class="form-control" required>
            <label>Enter again the new password:</label>
            <input type="password" name="passNueva2" class="form-control" required>
            <button class="btn btn-dark">Modify</button>
        </form>
    </div>

    <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="librerias/fontawesome/js/all.min.js"></script>
    <script src="librerias/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="librerias/crearXMLHTTP.js"></script>
</body>

</html>