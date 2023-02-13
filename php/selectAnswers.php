<?php
require_once "connectionJS.php";

$idQuestion = htmlspecialchars($_REQUEST['idPreg']);

$jsondata["data"] = array();

try {
    $stmt = $pdo->prepare("SELECT * FROM respuestas WHERE id_preg = ?");
    $stmt->execute([$idQuestion]);
    $jsondata["data"] = $stmt->fetchAll();
} catch (PDOException $e) {
    $jsondata["mensaje"][] = "Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
$pdo = null;

exit();
