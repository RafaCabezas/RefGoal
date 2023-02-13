<?php
require_once "connectionJS.php";

$idUsr = htmlspecialchars($_REQUEST['id_user']);

$jsondata["data"] = array();

try {
    $stmt = $pdo->prepare("SELECT * FROM preguntas WHERE id_usr = ?");
    $stmt->execute([$idUsr]);
    $jsondata["data"] = $stmt->fetchAll();
} catch (PDOException $e) {
    $jsondata["mensaje"][] = "Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
$pdo = null;

exit();
