<?php
include_once('connection.php');
session_start();

// conexion con bd
$conn = openConection();

// recoger valores del form
$correo = htmlspecialchars($_REQUEST['correo']);
$clave = htmlspecialchars($_REQUEST['clave']);
$clave = hash('sha512', $clave);

// ejecutar sentencia sql
$stmt = $conn->prepare("SELECT * FROM usuario WHERE correo = :correo AND clave = :clave");
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':clave', $clave);
$stmt->execute();
$result = $stmt->fetchAll();


// si encuentra un usuario y su contraseña con los valores del form, entra aqui
if ($stmt->rowCount() == 1) {
    foreach ($result as $fila) {
        $tipo_usr = $fila['tipo_usr']; // 0 si es user y 1 si es admin
        $nom_usr = $fila['nombre_usr'];
        $id_usr = $fila['id_usr'];
    }

    $_SESSION['nom_usuario'] = $nom_usr; // crea sesion con el nombre de usuario
    $_SESSION['usuario'] = $correo;
    $_SESSION['id_usr'] = $id_usr;

    header('Location: ../main.php');
    if ($tipo_usr == 0) {
        header('Location: ../main.php');
    } else if ($tipo_usr == 1) {
        header('Location: ../mainAdmin.php');
    } else if ($tipo_usr == 2) {
        header('Location: ../mainSuperAdmin.php');
    }
} else {
    // reenviar a error
    header('Location: ../error.html');

    // echo '
    // <script>
    //     Swal.fire({
    //         icon: "error",
    //         text: "Credenciales incorrectos"
    //     });
    // </script>';
}
