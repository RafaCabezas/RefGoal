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

$activeLanguage = "es"; // por defecto será español

if (isset($_SESSION['idioma'])) {
    $activeLanguage = $_SESSION['idioma'];
}

if ($activeLanguage == "es") {
    $li1 = "Inicio";
    $li2 = "Trivias";
    $li3 = "Redacción acta";
    $li4 = "Estadísticas";
    $li5 = "Editar perfil";
    $li6 = "Español";
    $li7 = "Inglés";
    $li8 = "Cambiar";
    $li9 = "Cerrar sesión";

    $h1 = "Cambiar contraseña:";
    $pass1 = "Contraseña actual:";
    $pass2 = "Contraseña nueva:";
    $pass3 = "Repite la nueva contraseña:";
    $btn1 = "CONFIRMAR";
} else if ($activeLanguage == "en") {
    $li1 = "Home";
    $li2 = "Test";
    $li3 = "Report writing";
    $li4 = "Statistics";
    $li5 = "Edit profile";
    $li6 = "Spanish";
    $li7 = "English";
    $li8 = "Change";
    $li9 = "Logout";

    $h1 = "Change password:";
    $pass1 = "Current password:";
    $pass2 = "New password:";
    $pass3 = "Repeat new password:";
    $btn1 = "CONFIRM";
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
                <li><a href="mainSuperAdmin.php">Add admin</a></li>
                <li><a href="userList.php">List users</a></li>
                <li><a href="miPerfilSuperAdmin.php">Change password</a></li>
            </ul>
        </nav>
        <a class="btn" href="php/logout.php"><button>Log out</button></a>
    </header>

    <h1 align="center">Change password:</h1>
    <br>

    <div class="container miPerfil">
        <form action="php/updatePass3.php" method="POST" class="formulario__register">
            <label>Current password:</label>
            <input type="password" name="passActual" class="form-control" required>
            <label>New password:</label>
            <input type="password" name="passNueva1" class="form-control" required>
            <label>Repeat new password:</label>
            <input type="password" name="passNueva2" class="form-control" required>
            <button class="btn btn-dark">CONFIRM</button>
        </form>
    </div>

    <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="librerias/fontawesome/js/all.min.js"></script>
    <script src="librerias/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="librerias/crearXMLHTTP.js"></script>
</body>

</html>