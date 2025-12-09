<?php
require 'config.php';

try {
    $pdo = config::getConnexion();
    $stmt = $pdo->query("SELECT countryName, locationX AS lat, locationY AS lon FROM country");
    $rows = $stmt->fetchAll();
    echo json_encode($rows);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
