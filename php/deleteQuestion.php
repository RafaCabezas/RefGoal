<?php
require_once "connectionJS.php";

$idPreg = htmlspecialchars($_REQUEST['idPreguntaBorrar']);

$jsondata["data"] = array();

try {
    $stmt = $pdo->prepare("DELETE FROM preguntas WHERE id_preg = ?");
    $stmt->execute([$idPreg]);
    $jsondata["data"] = $stmt->fetch();
} catch (PDOException $e) {
    $jsondata["mensaje"][] = "Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
$pdo = null;

exit();
