<?php
header('Content-Type: application/json');
require_once 'config.php';  // Adjust path if needed

try {
    $pdo = config::getConnexion();

    $stmt = $pdo->prepare("SELECT idPost, countryName, locationX, locationY, locationZ FROM country");
    $stmt->execute();

    $markers = [];

    while ($row = $stmt->fetch()) {
        $markers[] = [
            "idPost" => (int)$row['idPost'],
            "name" => $row['countryName'],
            "x" => (float)$row['locationX'],
            "y" => (float)$row['locationY'],
            "z" => (float)$row['locationZ']
        ];
    }

    echo json_encode($markers, JSON_NUMERIC_CHECK); // ensures numbers are proper

} catch (Exception $e) {
    echo json_encode([]);  // return empty array on error
}
