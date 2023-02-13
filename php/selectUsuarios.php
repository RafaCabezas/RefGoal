<?php
require_once "connectionJS.php";

$jsondata["data"] = array();

try {
    $stmt = $pdo->prepare("SELECT * FROM usuario");
    $stmt->execute();
    $jsondata["data"] = $stmt->fetchAll();
} catch (PDOException $e) {
    $jsondata["mensaje"][] = "Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
$pdo = null;

exit();

// <?php
// require_once "connectionJS.php";

// $tipoUsr = 1;

// $jsondata["data"] = array();

// try {
//     $stmt = $pdo->prepare("SELECT * FROM usuario WHERE tipo_usr = ?");
//     $stmt->execute([$tipoUsr]);
//     $jsondata["data"] = $stmt->fetchAll();
// } catch (PDOException $e) {
//     $jsondata["mensaje"][] = "Error";
// }

// header('Content-type: application/json; charset=utf-8');
// echo json_encode($jsondata);
// $pdo = null;

// exit();
