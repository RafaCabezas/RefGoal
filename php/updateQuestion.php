<?php
require_once "connectionJS.php";

$idQst = htmlspecialchars($_REQUEST['idQstn']);
$textoPreg = htmlspecialchars($_REQUEST['textoPregunta']);

$jsondata["data"] = array();

header('Content-type: application/json; charset=utf-8');

try {
    $stmt = $pdo->prepare("UPDATE preguntas SET texto_preg = ? WHERE id_preg = ? ");
    $stmt->execute([$textoPreg, $idQst]);
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