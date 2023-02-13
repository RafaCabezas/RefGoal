<?php

require_once "connectionJS.php";

$pregunta = htmlspecialchars($_REQUEST['enunciado']);
$id_regla = htmlspecialchars($_REQUEST['id_regla']);
$id_usr = htmlspecialchars($_REQUEST['idUsuario']);

$jsondata["data"] = array();

try {
    $stmt = $pdo->prepare("INSERT INTO preguntas VALUES(null,?,?,?)");
    $stmt->execute([$id_regla, $id_usr, $pregunta]);
    $jsondata["data"] = $stmt->fetchAll();

    // $stmt = $pdo->prepare("SELECT MAX(id_preg) AS idPregunta FROM preguntas");
    // $stmt->execute();
    // $id_preg = $stmt->fetch();

    // $stmt2 = $pdo->prepare("INSERT INTO preguntas VALUES(?,?,?,?)");
    // $stmt2->execute([$id_preg, $id_regla, $id_usr, $pregunta]);
    // $jsondata["data"] = $stmt2->fetchAll();
} catch (PDOException $e) {
    $jsondata["mensaje"][] = "Error";
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
// $pdo = null;

exit();
