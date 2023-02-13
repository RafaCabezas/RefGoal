<?php
require_once "connectionJS.php";

$nombre = htmlspecialchars($_REQUEST['nombreAdmin']);
$mail = htmlspecialchars($_REQUEST['mailAdmin']);
$idAd = htmlspecialchars($_REQUEST['idAdmin']);

$jsondata["data"] = array();

header('Content-type: application/json; charset=utf-8');

try {
    $stmt = $pdo->prepare("UPDATE usuario SET nombre_usr = ? , correo = ? WHERE id_usr = ? ");
    $stmt->execute([$nombre, $mail, $idAd]);
    $jsondata["data"] = $stmt->fetch();

    // echo "$nombre, $mail, $idAd";
    echo json_encode(true);

    exit();
} catch (PDOException $e) {
    $jsondata["mensaje"][] = $e->getMessage();

    echo json_encode($jsondata);
}

// $pdo = null;
?>