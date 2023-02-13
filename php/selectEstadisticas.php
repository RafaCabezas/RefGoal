<?php

require_once "connectionJS.php";
session_start();

$id_usr = $_SESSION['id_usr'];

$jsondata["data"] = array();

try {
    $stmt = $pdo->prepare("SELECT * FROM registros WHERE id_usr = ? ORDER BY 5 DESC");
    $stmt->execute([$id_usr]);
    $jsondata["data"] = $stmt->fetchAll();
} catch (PDOException $e) {
    $jsondata["mensaje"][] = "Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
$pdo = null;

exit();
