<?php
include_once('connection.php');

// conexion con bd
$conn = openConection();

// recoger valores del form
$nombre = htmlspecialchars($_REQUEST['nombre']);
$correo = htmlspecialchars($_REQUEST['correo']);
$clave = htmlspecialchars($_REQUEST['clave']);
$clave = hash('sha512', $clave);
$tipo = 0;

// comprobar que no existe el correo en la bbdd antes de crear el usuario
$stmt = $conn->prepare("SELECT * FROM usuario WHERE correo = :correo");
$stmt->bindParam(':correo', $correo);
$stmt->execute();
$result = $stmt->fetchAll();

if ($stmt->rowCount() > 0) { // si devuelve una tupla es porque ya existe ese correo
    echo '
    <script>
    alert("Este correo ya está registrado, inténtalo con otro diferente.");
        window.location = "../index.php";
    </script>
    ';
    exit();
}

// si no existe el correo, crea el usuario
$stmt2 = $conn->prepare("INSERT INTO usuario(nombre_usr, clave, correo, tipo_usr) VALUES (:nombre, :clave, :correo, :tipo)");
$stmt2->bindParam(':nombre', $nombre);
$stmt2->bindParam(':clave', $clave);
$stmt2->bindParam(':correo', $correo);
$stmt2->bindParam(':tipo', $tipo);
$stmt2->execute();

header('Location: ../index.php');
