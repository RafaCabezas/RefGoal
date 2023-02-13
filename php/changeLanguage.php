<?php
session_start();

$idioma = $_REQUEST['idioma'];

if ($_REQUEST['idioma'] == "es") {
    $_SESSION['idioma'] = "es";
    header('Location: ../main.php');
    // header("Location: $_SERVER[PHP_SELF]");
} else if ($_REQUEST['idioma'] == "en") {
    $_SESSION['idioma'] = "en";
    header('Location: ../main.php');
}
