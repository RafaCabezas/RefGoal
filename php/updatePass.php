<?php
include_once('connection.php');

session_start();

// conexion con bd
$conn = openConection();

// recoger valores del form
$correo = $_SESSION['usuario'];
$claveAntigua = htmlspecialchars($_REQUEST['passActual']);
$claveAntigua = hash('sha512', $claveAntigua); // cifra la contraseña para poder compararla con la de la bbdd

// realizar consulta para validar que el usuario y la contraseña son correctos
$stmt = $conn->prepare("SELECT * FROM usuario WHERE correo = :correo AND clave = :clave");
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':clave', $claveAntigua);
$stmt->execute();
$result = $stmt->fetchAll();

if ($stmt->rowCount() == 1) { // si devuelve una tupla es porque la pass es correcta
    $claveNueva1 = htmlspecialchars($_REQUEST['passNueva1']);
    $claveNueva2 = htmlspecialchars($_REQUEST['passNueva2']);

    $claveNueva1 = hash('sha512', $claveNueva1); // cifrar clave1
    $claveNueva2 = hash('sha512', $claveNueva2); // cifrar clave2

    if ($claveAntigua != $claveNueva1) {
        if ($claveNueva1 == $claveNueva2) { // si coinciden las contraseñas introducidas
            $correo = $_SESSION['usuario']; // recupera el correo de la sesion para poder filtrar

            // actualiza la contraseña del usuario logueado
            $stmt2 = $conn->prepare("UPDATE usuario SET clave = :clave WHERE correo = :correo2");
            $stmt2->bindParam(':clave', $claveNueva1);
            $stmt2->bindParam(':correo2', $correo);
            $stmt2->execute();

            header("Location: logout.php");
            die();
        } else {
            // echo "
            // <script> swal({
            //             title: '¡ERROR!',
            //             text: 'Las contraseñas no coinciden. Por favor introduzca la misma contraseña en los dos campos.',
            //             type: 'error',
            //      });
            //      window.location = '../miPerfil.php';
            // </script>
            // ";

            echo '
                <script>
                    alert("Las contraseñas no coinciden. Por favor introduzca la misma contraseña en los dos campos.");
                    window.location = "../miPerfil.php";
                </script>
            ';
            exit();
        }
    } else {
        // echo "
        // <script> swal({
        //                 title: '¡ERROR!',
        //                 text: 'No se ha cambiado la contraseña porque es la misma. Por favor introduzca una diferente.',
        //                 type: 'error',
        //          });
        //          window.location = '../miPerfil.php';
        // </script>
        // ";

        echo '
                <script>
                    alert("No se ha cambiado la contraseña porque es la misma. Por favor introduzca una diferente.");
                    window.location = "../miPerfil.php";
                </script>
            ';
        exit();
    }
}
