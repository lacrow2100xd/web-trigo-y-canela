<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$categoria_id = intval($_GET['categoria_id']);

$sql = "SELECT id, nombre FROM productos WHERE id_categoria = :categoria_id";
$stmt = $con->prepare($sql);
$stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);

if ($stmt->execute()) {
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($productos);
} else {
    echo json_encode(['error' => 'Error al ejecutar la consulta']);
}


?>