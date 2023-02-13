<?php

require_once "connectionJS.php";

// $aRespuestasUsr = $_REQUEST['aRespuestasUsuario'];
$respuesta1 = htmlspecialchars($_REQUEST['respuesta1']);
$respuesta2 = htmlspecialchars($_REQUEST['respuesta2']);
$respuesta3 = htmlspecialchars($_REQUEST['respuesta3']);
$respuesta4 = htmlspecialchars($_REQUEST['respuesta4']);

$correcta1 = htmlspecialchars($_REQUEST['correcta1']);
$correcta2 = htmlspecialchars($_REQUEST['correcta2']);
$correcta3 = htmlspecialchars($_REQUEST['correcta3']);
$correcta4 = htmlspecialchars($_REQUEST['correcta4']);

$id_pregunta = htmlspecialchars($_REQUEST['id_preguntaAdd']);


$jsondata["data"] = array();

try {
    $stmt5 = $pdo->prepare("SELECT MAX(id_preg) AS idPregunta FROM preguntas");
    $stmt5->execute();
    $id_preg = $stmt5->fetch();

    $stmt = $pdo->prepare("INSERT INTO respuestas VALUES(null,?,?,?,?)");
    $stmt->execute([$id_pregunta, 1, $respuesta1, $correcta1]);

    $stmt2 = $pdo->prepare("INSERT INTO respuestas VALUES(null,?,?,?,?)");
    $stmt2->execute([$id_pregunta, 2, $respuesta2, $correcta2]);

    $stmt3 = $pdo->prepare("INSERT INTO respuestas VALUES(null,?,?,?,?)");
    $stmt3->execute([$id_pregunta, 3, $respuesta3, $correcta3]);

    $stmt4 = $pdo->prepare("INSERT INTO respuestas VALUES(null,?,?,?,?)");
    $stmt4->execute([$id_pregunta, 4, $respuesta4, $correcta4]);

    $jsondata["data"] = true;
} catch (PDOException $e) {
    $jsondata["mensaje"][] = "Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
// $pdo = null;

exit();
