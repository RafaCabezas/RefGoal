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
    $li3 = "Redacción acta";
    $li4 = "Estadísticas";
    $li5 = "Editar perfil";

    $li6 = "Español";
    $li7 = "Inglés";
    $li8 = "Cambiar idioma";

    $li9 = "Cerrar sesión";
    $txt1 = "Web oficial RFAF";
    $btn1 = "Modo oscuro";
    $txt2 = "Reglamento temporada 21/22";
    $txt3 = "Bienvenido " . $_SESSION['nom_usuario'];
    $btn2 = "Leer Más";
    $tit1 = "Regla 1";
    $p1 = "El terreno de juego deberá ser una superficie completamente natural o, si lo permite el reglamento de la ...";
    $tit2 = "Regla 2";
    $p2 = "Todos los balones utilizados en partidos organizados bajo los auspicios de la FIFA o de las ...";
    $tit3 = "Regla 3";
    $p3 = "Disputarán los partidos dos equipos, cada uno de ellos con un máximo de once jugadores ...";
} else if ($activeLanguage == "en") {
    $li1 = "Home";
    $li2 = "Test";
    $li3 = "Report writing";
    $li4 = "Statistics";
    $li5 = "Edit profile";

    $li6 = "Spanish";
    $li7 = "English";
    $li8 = "Change language";

    $li9 = "Logout";
    $txt1 = "Official website RFAF";
    $btn1 = "Dark mode";
    $txt2 = "Regulation Season 21/22";
    $txt3 = "Welcome " . $_SESSION['nom_usuario'];
    $btn2 = "Read More";
    $tit1 = "Rule 1";
    $p1 = "The field of play must be a completely natural surface or, if permitted by the regulations of the ...";
    $tit2 = "Rule 2";
    $p2 = "All balls used in matches organized under the auspices of FIFA or the confederations ...";
    $tit3 = "Rule 3";
    $p3 = "The matches will be played by two teams, each with a maximum of eleven ...";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefGoal</title>

    <link rel="stylesheet" href="css/estiloMenu.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="librerias/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="librerias/jquery-ui/jquery-ui.theme.min.css" />
    <link rel="stylesheet" href="librerias/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="librerias/DataTables/DataTables-1.11.4/css/jquery.dataTables.css" />

    <link rel="stylesheet" href="css/estiloPrincipal.css">
    <!-- <link rel="stylesheet" href="css/estiloPrincipal.css"> -->
</head>

<body>
    <!-- sidebar y su script
    <nav-menu></nav-menu>-->


    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="images/logoRFAF2.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">RefGoal</span>
                    <span class="descripcion"><?php echo $txt1; ?></span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Buscar...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="main.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text"><?php echo $li1; ?></span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="trivias.php">
                            <i class='bx bx-timer icon'></i>
                            <span class="text nav-text"><?php echo $li2; ?></span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="manualRedaccion.php">
                            <i class='bx bxs-file-pdf icon'></i>
                            <span class="text nav-text"><?php echo $li3; ?></span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="estadisticasTest.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text"><?php echo $li4; ?></span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="miPerfil.php">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text"><?php echo $li5; ?></span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="php/logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text"><?php echo $li9; ?></span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text"><?php echo $btn1; ?></span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>

    <section class="home">
        <script>
            sessionStorage.setItem("idUsuarioLogged", "<?php echo $_SESSION['id_usr']; ?>");
        </script>

        <div class="table-responsive">
            <h1>Edit / Delete questions:</h1>

            <table class="table" id="tableUsr">
                <thead>
                    <th>Id</th>
                    <th>Text</th>
                    <th>Edit answers</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal" method="POST">
                        <fieldset>
                            <legend class="text-center header">Edit Question</legend>

                            <div class="form-group mt-2">
                                <div class="col-md-4 text-center">
                                    <input id="idQst" name="idQst" type="text" placeholder="Question ID" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <input id="textoPreg" name="textoPreg" type="text" placeholder="Question statement" class="form-control" autocomplete="off">

                            </div>

                            <div class="form-group mt-4">
                                <div class="col-md-12 text-center">
                                    <button type="submit" id="btnModificar" class="boton btn btn-dark btn-lg">Modify</button>
                                    <button type="button" id="btnCancelar" class="btn btn-danger btn-lg">Cancel</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="js/navMenu.js"></script>

    <script src="librerias/jquery-3.6.0.min.js"></script>
    <script src="librerias/DataTables/DataTables-1.11.4/js/jquery.dataTables.js"></script>
    <script src="librerias/jquery-ui/jquery-ui.min.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="librerias/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="librerias/fontawesome/js/all.min.js"></script>
    <script src="librerias/crearXMLHTTP.js"></script>

    <script src="js/editDeleteQuestion.js"></script>
</body>

</html>