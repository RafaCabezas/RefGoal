<?php
session_start();
require_once "connectionJS.php";

$id_usr = $_SESSION['id_usr'];

$numAc = htmlspecialchars($_REQUEST['num_aciertos']);
$numTotal = htmlspecialchars($_REQUEST['num_total']);
$nota = htmlspecialchars($_REQUEST['nota_usr']);
$tiempo = htmlspecialchars($_REQUEST['tiempo']);

$jsondata["data"] = array();

try {
    $stmt = $pdo->prepare("INSERT INTO registros VALUES(null,?,?,?,?,?)");
    $stmt->execute([$id_usr, $numAc, $numTotal, $nota, $tiempo]);
    $jsondata["data"] = $stmt->fetchAll();
} catch (PDOException $e) {
    $jsondata["mensaje"][] = "Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
$pdo = null;

exit();
