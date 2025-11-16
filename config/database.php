<?php
$host = 'localhost';
$dbname = 'crud3';  // Ton nom exact de base
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) die("Connexion échouée : " . mysqli_connect_error());
mysqli_set_charset($conn, "utf8mb4");
return $conn;