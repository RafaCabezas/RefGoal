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
    $li3 = "Acta";
    $li4 = "Estadísticas test";
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
    $li3 = "Report";
    $li4 = "Test stats";
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
    <title>RefGoal Perfil</title>

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
                <li><a href="main.php"><?php echo $li1; ?></a></li>
                <li><a href="trivias.php"><?php echo $li2; ?></a></li>
                <li><a href="estadisticasTest.php"><?php echo $li4; ?></a></li>
                <li><a href="manualRedaccion.php"><?php echo $li3; ?></a></li>
                <li><a href="miPerfil.php"><?php echo $li5; ?></a></li>
                <li>
                    <form action="php/changeLanguage.php" method="POST">
                        <select name="idioma" class="">
                            <!-- form-select form-select-sm -->
                            <option value="es"><?php echo $li6; ?></option>
                            <option value="en"><?php echo $li7; ?></option>
                        </select>
                        <input type="submit" value="<?php echo $li8; ?>" class="">
                        <!-- btn btn-outline-light btn-sm -->
                    </form>
                </li>
            </ul>
        </nav>
        <a class="btn" href="php/logout.php"><button><?php echo $li9; ?></button></a>
    </header>

    <h1 align="center"><?php echo $h1; ?></h1>
    <br>

    <div class="container miPerfil">
        <form action="php/updatePass.php" method="POST" class="formulario__register">
            <label><?php echo $pass1; ?></label>
            <input type="password" name="passActual" class="form-control" required>
            <label><?php echo $pass2; ?></label>
            <input type="password" name="passNueva1" class="form-control" required>
            <label><?php echo $pass3; ?></label>
            <input type="password" name="passNueva2" class="form-control" required>
            <button class="btn btn-dark"><?php echo $btn1; ?></button>
        </form>
    </div>

    <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="librerias/fontawesome/js/all.min.js"></script>
    <script src="librerias/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="librerias/crearXMLHTTP.js"></script>
</body>

</html>