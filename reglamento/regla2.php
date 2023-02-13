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

    $t1 = "Regla 2 - El balón";
    $t2 = "1. Características y medidas";
    $t3 = "2. Sustitución de un balón defectuoso";
    $t4 = "3. Balones adicionales";
    $btn1 = "Anterior";
    $btn2 = "Siguiente";
    $p2 = "Todos los balones utilizados en partidos de competición oficial organizados bajo los auspicios de la FIFA o de las confederaciones deberán cumplir con los criterios del Programa de calidad de la FIFA de balones de fútbol y portar uno de los sellos de
    calidad del mismo. Estos distintivos indican que el balón ha sido examinado oficialmente y cumple los requisitos técnicos para dicho distintivo, además de las especificaciones mínimas estipuladas en la Regla 2 y aprobadas por el IFAB. En las
    competiciones de las federaciones nacionales de fútbol, se podrá exigir el uso de balones que lleven uno de estos distintivos. En los partidos que se jueguen en una competición oficial bajo los auspicios de la FIFA, de las confederaciones
    o de las federaciones nacionales de fútbol, está prohibida toda clase de publicidad comercial en el balón, con excepción del logotipo o emblema de la competición o del organizador de la competición y la marca registrada autorizada del fabricante.
    El reglamento de la competición podrá restringir el tamaño y el número de dichas marcas.";
    $p3 = "Si el balón quedara defectuoso en un saque de inicio, de meta, de esquina o de banda, o en el lanzamiento de un tiro libre o penal, se volverá a ejecutar el saque o el lanzamiento. Si el balón, mientras se mueve hacia adelante, quedara defectuoso antes
    de llegar a tocar a un jugador, el travesaño o los postes durante la ejecución de un penal o de la tanda de penales, se volverá a ejecutar dicho lanzamiento. El balón no podrá ser reemplazado durante el transcurso del partido sin la autorización
    del árbitro.";
    $p4 = "Se podrán colocar balones adicionales alrededor del terreno de juego, siempre que cumplan las especificaciones estipuladas en la Regla 2 y su uso lo supervise el árbitro.";
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

    $t1 = "Rule 2 - The ball";
    $t2 = "1. Characteristics and measurements";
    $t3 = "2. Replacement of a defective ball";
    $t4 = "3. Additional balls";
    $btn1 = "Previous";
    $btn2 = "Next";
    $p2 = "All balls used in organized official competition matches
    under the auspices of FIFA or the confederations shall comply with the
    criteria of the FIFA Quality Program for Soccer Balls and carrying one
    of its quality seals.
    These marks indicate that the ball has been officially examined and complies with
    the technical requirements for said badge, in addition to the specifications
    minimum stipulated in Rule 2 and approved by the IFAB.
    In the competitions of the national football federations, it may be required
    the use of balls bearing one of these emblems.
    In matches played in an official competition under the auspices of
    FIFA, the confederations or the national football federations, is
    All kinds of commercial advertising on the ball are prohibited, with the exception of the
    logo or emblem of the competition or the organizer of the competition and the
    authorized trademark of the manufacturer. The rules of the competition
    may restrict the size and number of such marks.";
    $p3 = "If the ball becomes defective during a kick-off, goal kick, corner kick or
    band, or at the taking of a free or penalty kick, the kick will be retaken.
    serve or throw.
    If the ball, while moving forward, becomes defective before
    touch a player, the crossbar or the posts during the execution of a
    penalty kick or penalty shootout, that shot will be retaken.
    The ball may not be replaced during the course of the game without the
    referee authorization.";
    $p4 = "Additional balls may be placed around the field of play, provided
    that meet the specifications stipulated in Rule 2 and their use
    supervise the referee.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RefGoal Regla 2</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../librerias/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../librerias/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="../librerias/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="../css/estiloPrincipal.css" />
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
                <li><a href="manualRedaccion.php"><?php echo $li3; ?></a></li>
                <li><a href="estadisticasTest.php"><?php echo $li4; ?></a></li>
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

    <div class="container">
        <h1><?php echo $t1; ?></h1>

        <div class="botonesReglas">
            <a class="btn" href="regla1.php"><button><?php echo $btn1; ?></button></a>
            <a class="btn" href="regla3.php"><button><?php echo $btn2; ?></button></a>
        </div>

        <h5><?php echo $t2; ?></h5>
        <p>
            <?php echo $p2; ?>
        </p>
        <h5><?php echo $t3; ?></h5>
        <p>
            <?php echo $p3; ?>
        </p>
        <h5><?php echo $t4; ?></h5>
        <p>
            <?php echo $p4; ?>
        </p>
    </div>

    <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="../librerias/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../librerias/fontawesome/js/all.min.js"></script>
</body>

</html>

</html>