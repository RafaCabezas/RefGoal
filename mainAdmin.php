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

$session_id = $_SESSION['id_usr']; // guarda el id_usr de la session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefGoal Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="librerias/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="librerias/jquery-ui/jquery-ui.theme.min.css" />
    <link rel="stylesheet" href="librerias/fontawesome/css/all.min.css" />

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

    <div class="container">
        <h1>Add a new question:</h1>

        <div id="divEnunciado">
            <form method="POST" class="form_reg">
                <div class="enunciado">
                    <input type="text" placeholder="Question statement" id="enunciado" class="form-control w-75">
                    <!-- <select id="asistentes" name="reglas" class="form-control w-25">
                        <option value="0" disabled selected>Select rule</option>
                        <option value="1">El terreno de juego</option>
                        <option value="2">El balón</option>
                        <option value="3">Los jugadores</option>
                    </select> -->
                    <input type="number" placeholder="Rule number" id="id_regla" class="form-control w-25">

                    <input type="hidden" id="sessionId" value="<?php echo $session_id; ?>">
                </div>
                <br>
                <button class="btn btn-dark" type="button" id="addPreg">INSERT QUESTION</button>
                <br>
            </form>
        </div>

        <div id="divRespuestas">
            <h4>Don't forget to check a question as correct!</h4>
            <br>

            <form method="POST" id="formResp">
                <input type="radio" name="correcta" id="ck1">
                <input type="text" id="resp1" placeholder="Answer 1" name="resp1" class="form-control w-75"><br>

                <input type="radio" name="correcta" id="ck2">
                <input type="text" id="resp2" placeholder="Answer 2" name="resp2" class="form-control w-75"><br>

                <input type="radio" name="correcta" id="ck3">
                <input type="text" id="resp3" placeholder="Answer 3" name="resp3" class="form-control w-75"><br>

                <input type="radio" name="correcta" id="ck4">
                <input type="text" id="resp4" placeholder="Answer 4" name="resp4" class="form-control w-75"><br>

                <button class="btn btn-dark w-75" type="button" id="addResp">INSERT ANSWERS</button>
            </form>
        </div>
    </div>

    <script src="librerias/jquery-3.6.0.min.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="librerias/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="librerias/fontawesome/js/all.min.js"></script>
    <script src="librerias/jquery-ui/jquery-ui.min.js"></script>
    <script src="librerias/crearXMLHTTP.js"></script>

    <script src="js/addPregunta.js"></script>
</body>

</html>