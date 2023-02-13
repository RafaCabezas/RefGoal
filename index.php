<!--
    Autor: Rafael Cabezas Aranda
    Proyecto: RefGoal
    Fecha: 14/06/2022
-->

<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: main.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefGoal</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="css/estiloLogin.css">
</head>

<body>

    <main>

        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la web</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Registrarse</button>
                </div>
            </div>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <form action="php/login.php" method="POST" class="formulario__login">
                    <h2>Iniciar sesión</h2>
                    <input type="text" placeholder="Correo electrónico" name="correo">
                    <input type="password" placeholder="Contraseña" name="clave">
                    <button>Acceder</button>
                    <!-- <input type="submit" name="login" value="Login" class="btn btn-secondary"> -->
                </form>

                <!--Register-->
                <form action="php/registro.php" method="POST" class="formulario__register">
                    <h2>Registrar usuario</h2>
                    <!-- <input type="text" placeholder="Código administrador" name="admin"> -->
                    <input type="text" placeholder="Nombre completo" name="nombre">
                    <input type="text" placeholder="Correo electrónico" name="correo">
                    <!-- <input type="text" placeholder="Usuario" name="usuario"> -->
                    <input type="password" placeholder="Contraseña" name="clave">
                    <button>Registrarse</button>
                </form>
            </div>
        </div>

    </main>

    <script src="js/login.js"></script>
</body>

</html>