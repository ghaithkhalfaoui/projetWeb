<?php
require_once 'config.php'; // Make sure this file contains the config class

header("Content-Type: application/json");

try {
    // Get PDO connection
    $pdo = config::getConnexion();

    // Prepare and execute query
    $stmt = $pdo->prepare("SELECT ModleDesign, locationX, locationY FROM module LIMIT 1");
    $stmt->execute();

    // Fetch first row
    $row = $stmt->fetch();

    // Output JSON
    echo json_encode([
        "path" => $row['ModleDesign'] ?? null,
        "x" => $row['locationX'] ?? null,
        "y" => $row['locationY'] ?? null
    ]);

} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
