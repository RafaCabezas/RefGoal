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
    $li4 = "Estadísticas test";
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
    $li4 = "Test statistics";
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
                        <a href="estadisticasTest.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text"><?php echo $li4; ?></span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="manualRedaccion.php">
                            <i class='bx bxs-file-pdf icon'></i>
                            <span class="text nav-text"><?php echo $li3; ?></span>
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
        <div class="text"><?php echo $txt2; ?></div>
        <p id="nomUsr" class="text"><?php echo $txt3; ?></p>

        <div class="container__cards">
            <div class="card">
                <div class="description">
                    <h2><?php echo $tit1; ?></h2>
                    <p><?php echo $p1; ?></p>
                    <a class="btn" href="reglamento/regla1.html"><button><?php echo $btn2; ?></button></a>
                </div>
            </div>

            <div class="card">
                <div class="description">
                    <h2><?php echo $tit2; ?></h2>
                    <p><?php echo $p2; ?></p>
                    <a class="btn" href="reglamento/regla2.html"><button><?php echo $btn2; ?></button></a>
                </div>
            </div>

            <div class="card">
                <div class="description">
                    <h2><?php echo $tit3; ?></h2>
                    <p><?php echo $p3; ?></p>
                    <a class="btn" href="reglamento/regla3.html"><button><?php echo $btn2; ?></button></a>
                </div>
            </div>

            <!-- <div class="card">
                <div class="description">
                    <h2>Regla 4</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, laboriosam.</p>
                    <a class="btn" href="reglamento/regla4.html"><button>Leer Más</button></a>
                </div>
            </div>

            <div class="card">
                <div class="description">
                    <h2>Regla 5</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, laboriosam.</p>
                    <a class="btn" href="reglamento/regla5.html"><button>Leer Más</button></a>
                </div>
            </div>

            <div class="card">
                <div class="description">
                    <h2>Regla 6</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, laboriosam.</p>
                    <a class="btn" href="reglamento/regla6.html"><button>Leer Más</button></a>
                </div>
            </div>

            <div class="card">
                <div class="description">
                    <h2>Regla 7</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, laboriosam.</p>
                    <a class="btn" href="reglamento/regla7.html"><button>Leer Más</button></a>
                </div>
            </div>
        </div> -->
    </section>

    <script src="js/navMenu.js"></script>
</body>

</html>