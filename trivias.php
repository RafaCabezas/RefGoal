<!--
    Autor: Rafael Cabezas Aranda
    Proyecto: RefGoal
    Fecha: 14/06/2022
-->

<?php
session_start();

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

    $pregunta = "Introduce el nº de preguntas del test: ";
    $placeholder = "Máximo 20 preguntas";
    $btn1 = "Crear test";
    $h1 = "Test reglamento Temporada 21/22";
    $btn2 = "Enviar test";

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

    $pregunta = "Enter the number of questions:";
    $placeholder = "Max 20 questions";
    $btn1 = "Create test";
    $h1 = "Regulation test Season 21/22";
    $btn2 = "Send test";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefGoal Trivia</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="librerias/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="librerias/jquery-ui/jquery-ui.theme.min.css" />
    <link rel="stylesheet" href="librerias/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="librerias/DataTables/DataTables-1.11.4/css/jquery.dataTables.css" />
    

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

    <div class="contenedor" id="formNumPreg">
        <form method="POST">
            <label><?php echo $pregunta; ?></label><br>
            <input type="number" id="numPreg" name="numPreg" class="form-control" placeholder="<?php echo $placeholder; ?>"><br>
            <span id="errNumPreg" class="error"></span>
            <button id="enviarNumPreg" class="btn btn-dark"><?php echo $btn1; ?></button>
        </form>
    </div>

    <br><br>

    <div id="enunciados" class="container">
        <h1><?php echo $h1; ?></h1>
        <br>

        <form action="" id="envioResp">

        </form>
        <br>
        <button id="enviarTest" class="btn btn-dark"><?php echo $btn2; ?></button>
    </div>

    <br><br>

    <!-- <div id="respuestas">

    </div> -->

    <script src="librerias/jquery-3.6.0.min.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="librerias/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="librerias/fontawesome/js/all.min.js"></script>
    <script src="librerias/jquery-ui/jquery-ui.min.js"></script>
    <script src="librerias/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="librerias/DataTables/DataTables-1.11.4/js/jquery.dataTables.js"></script>
    <script src="librerias/crearXMLHTTP.js"></script>

    <script src="js/trivias.js"></script>
</body>

</html>