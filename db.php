<?php
$host = "localhost";   // alebo tvoj server
$dbname = "simple_crud";
$username = "root";    // prihlasovacie údaje
$password = "";        // heslo

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Pripojenie k databáze zlyhalo: " . $e->getMessage();
}
?>
