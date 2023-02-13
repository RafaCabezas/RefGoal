<?php
require_once "connectionJS.php";

$idAns = htmlspecialchars($_REQUEST['idAnswer']);
$textoResp = htmlspecialchars($_REQUEST['textoRespuesta']);

$jsondata["data"] = array();

header('Content-type: application/json; charset=utf-8');

try {
    $stmt = $pdo->prepare("UPDATE respuestas SET texto_resp = ? WHERE id_resp = ? ");
    $stmt->execute([$textoResp, $idAns]);
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