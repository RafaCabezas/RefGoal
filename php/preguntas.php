<?php
require_once "connectionJS.php";

$aPreguntas = htmlspecialchars($_REQUEST['aPreguntas']);

$jsondata["data"] = array();

try {
    $stmt = $pdo->prepare("SELECT * FROM preguntas WHERE id_preg = ?");
    $stmt->execute([$aPreguntas]);
    $jsondata["data"] = $stmt->fetchAll();
} catch (PDOException $e) {
    $jsondata["mensaje"][] = "Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
$pdo = null;

exit();
