<?php
require 'config.php';

try {
    $pdo = config::getConnexion();
    
    // 1. Fetch all countries to get the count and details
    $stmt = $pdo->query("SELECT countryName FROM country");
    $countries = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $totalCountries = count($countries);
    
    if ($totalCountries === 0) {
        die("No countries found in the database.");
    }
    
    // 2. Generate a range of IDs from 0 to totalCountries - 1
    $ids = range(0, $totalCountries - 1);
    
    // 3. Shuffle the IDs to randomize assignment
    shuffle($ids);
    
    // 4. Update each country with a unique ID from the shuffled set
    $pdo->beginTransaction();
    
    $updateStmt = $pdo->prepare("UPDATE country SET idPost = :idPost WHERE countryName = :countryName");
    
    foreach ($countries as $index => $countryName) {
        $updateStmt->execute([
            ':idPost' => $ids[$index],
            ':countryName' => $countryName
        ]);
        echo "Updated $countryName with idPost: " . $ids[$index] . "<br>";
    }
    
    $pdo->commit();
    
    echo "<br><b>Success! All $totalCountries countries have been assigned unique random IDs between 0 and " . ($totalCountries - 1) . ".</b>";

} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Error: " . $e->getMessage();
}
?>
