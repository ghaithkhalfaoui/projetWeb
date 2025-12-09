<?php

require_once "../config.php"; // include your config class

try {
    $db = config::getConnexion();
} catch (Exception $e) {
    die("Database error: " . $e->getMessage());
}

// Load the offline JSON file with all coordinates
$jsonFile = __DIR__ . "/countries.json";

if (!file_exists($jsonFile)) {
    die("countries.json not found!");
}

$countries = json_decode(file_get_contents($jsonFile), true);

if (!$countries) {
    die("Failed to decode countries.json.");
}

foreach ($countries as $c) {

    // prepare the update query
    $update = $db->prepare("
        UPDATE country 
        SET locationX = :lng, locationY = :lat
        WHERE countryName = :name
    ");

    $update->execute([
        ":lng"  => $c["lng"],
        ":lat"  => $c["lat"],
        ":name" => $c["country"]
    ]);

    echo "Updated: " . $c["country"] . "<br>";
}

echo "<br><strong>ALL DONE — All country coordinates updated successfully!</strong>";
