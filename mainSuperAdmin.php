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
    <title>RefGoal SuperAdmin</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="librerias/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="librerias/jquery-ui/jquery-ui.theme.min.css" />
    <link rel="stylesheet" href="librerias/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="css/estiloPrincipal.css">

    <!-- <script src="js/navMenu.js"></script> -->

    <style>
        .error {
            color: #FF0000;
        }

        .invalid-feedback {
            display: block !important
        }
    </style>
</head>

<body>

    <?php
    // Definir variables
    $nombreErr = $emailErr = $passErr = "";
    $nombre = $email = $pass = "";
    $nomCorrecto = 0;
    $mailCorrecto = 0;
    $passCorrecta = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nombre"])) {
            $nombreErr = "Required";
        } else {
            $nombre = validar_input($_POST["nombre"]);

            $nomCorrecto = 1;
        }

        if (empty($_POST["correo"])) {
            $emailErr = "Required";
        } else {
            $email = validar_input($_POST["correo"]);
            // Verifica el formato de email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid format";
            }

            $mailCorrecto = 1;
        }

        if (empty($_POST["clave"])) {
            $passErr = "Required";
        } else {
            $pass = validar_input($_POST["clave"]);

            // verifica que contiene >2 caracteres
            if (strlen($pass) < 8) {
                $passErr = "Minimun 8 characters";
            }

            $passCorrecta = 1;
        }
    }

    if ($nomCorrecto == 1 && $mailCorrecto == 1 && $passCorrecta == 1) {
        include_once('php/connection.php');

        // conexion con bd
        $conn = openConection();

        // recoger valores del form
        $tipoUsr = 1; // le asigno tipo 1 para que sea admin
        $nombre = htmlspecialchars($_REQUEST['nombre']);
        $correo = htmlspecialchars($_REQUEST['correo']);
        $clave = htmlspecialchars($_REQUEST['clave']);
        $clave = hash('sha512', $clave);

        // comprobar que no existe el correo en la bbdd antes de crear el usuario
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if ($stmt->rowCount() > 0) { // si devuelve una tupla es porque ya existe ese correo
            echo '
    <script>
    alert("That email is already registered, try with another one.");
        window.location = "mainSuperAdmin.php";
    </script>
    ';
            exit();
        }

        // si no existe el correo, crea el usuario
        $stmt2 = $conn->prepare("INSERT INTO usuario(nombre_usr, clave, correo, tipo_usr) VALUES (:nombre, :clave, :correo, :tipo)");
        $stmt2->bindParam(':nombre', $nombre);
        $stmt2->bindParam(':clave', $clave);
        $stmt2->bindParam(':correo', $correo);
        $stmt2->bindParam(':tipo', $tipoUsr);
        $stmt2->execute();

        header('Location: userList.php');
    }

    function validar_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

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

    <div class="container">
        <h1>Create admin account:</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form_reg">

            <label class="col-form-label"><span class="error">* </span>Full name</label>
            <input type="text" placeholder="Full name" name="nombre" class="form-control" value="<?php if (!empty($_POST["nombre"])) {
                                                                                                        echo $nombre;
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>">
            <span class="error invalid-feedback"> <?php echo $nombreErr; ?></span> <br>

            <label class="col-form-label"><span class="error">* </span>Email</label>
            <input type="text" placeholder="Email" name="correo" class="form-control" value="<?php if (!empty($_POST["correo"])) {
                                                                                                    echo $email;
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>">
            <span class="error invalid-feedback"> <?php echo $emailErr; ?></span> <br>

            <label class="col-form-label"><span class="error">* </span>Password</label>
            <input type="password" placeholder="Password" name="clave" class="form-control" value="<?php if (!empty($_POST["clave"])) {
                                                                                                        echo $pass;
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>">
            <span class="error invalid-feedback"> <?php echo $passErr; ?></span> <br>

            <button name="submit" class="btn btn-dark">Register</button>
        </form>
    </div>

    <script src="librerias/jquery-3.6.0.min.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="librerias/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="librerias/fontawesome/js/all.min.js"></script>
    <script src="librerias/jquery-ui/jquery-ui.min.js"></script>
    <script src="librerias/crearXMLHTTP.js"></script>
</body>

</html>