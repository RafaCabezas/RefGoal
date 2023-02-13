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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefGoal Administrator</title>

    <!-- <link rel="stylesheet" href="css/estiloMenu.css"> -->

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="librerias/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="librerias/jquery-ui-1.13.1/jquery-ui.css" />
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
                <li><a href="mainAdmin.php">Add a question</a></li>
                <li><a href="questionList.php">List of questions</a></li>
                <li><a href="miPerfilAdmin.php">Change password</a></li>
            </ul>
        </nav>
        <a class="btn" href="php/logout.php"><button>Log out</button></a>
    </header>

    <!-- <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="images/logoRFAF2.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">RefGoal</span>
                    <span class="descripcion">Oficial website RFAF</span>
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
                        <a href="mainAdmin.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Add a question</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="questionList.php">
                            <i class='bx bx-timer icon'></i>
                            <span class="text nav-text">List of questions</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="miPerfilAdmin.php">
                            <i class='bx bxs-file-pdf icon'></i>
                            <span class="text nav-text">Change password</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="php/logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Log out</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav> -->

    <section class="home">
        <div class="table-responsive">
            <h1>Edit answers:</h1>

            <table class="table" id="tableResp">
                <thead>
                    <th>Id</th>
                    <th>Text</th>
                    <th>Correct (0-NO  1-YES)</th>
                    <th>Edit</th>
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
                                    <input id="idAns" name="idAns" type="text" placeholder="Answer ID" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <input id="textoResp" name="textoResp" type="text" placeholder="Answer text" class="form-control" autocomplete="off">

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

    <script src="librerias/jquery-3.6.0.min.js"></script>
    <script src="librerias/DataTables/DataTables-1.11.4/js/jquery.dataTables.js"></script>
    <script src="librerias/jquery-ui/jquery-ui.min.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="librerias/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="librerias/fontawesome/js/all.min.js"></script>
    <script src="librerias/crearXMLHTTP.js"></script>

    <script src="js/editDeleteAnswers.js"></script>
    <!-- <script src="js/navMenu.js"></script> -->
</body>

</html>