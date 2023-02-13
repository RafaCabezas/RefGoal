<?php
require_once "connectionJS.php";

$jsondata["data"] = array();

try {
    $stmt = $pdo->prepare("SELECT MAX(id_preg) AS idPregunta FROM preguntas");
    $stmt->execute();
    $jsondata["data"] = $stmt->fetch();
} catch (PDOException $e) {
    $jsondata["mensaje"][] = "Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
$pdo = null;

exit();