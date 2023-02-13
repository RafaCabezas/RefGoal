<?php
require_once "connectionJS.php";

$idUsr = htmlspecialchars($_REQUEST['idUsuario']);

$jsondata["data"] = array();

try {
    $stmt = $pdo->prepare("DELETE FROM usuario WHERE id_usr = ?");
    $stmt->execute([$idUsr]);
    $jsondata["data"] = $stmt->fetchAll();
} catch (PDOException $e) {
    $jsondata["mensaje"][] = "Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
$pdo = null;

exit();
