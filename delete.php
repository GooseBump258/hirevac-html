<?php
// Pripojenie k databáze
include 'db.php';

// Skontroluj, či je ID prácu, ktoré sa má vymazať, prítomné v URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Príkaz na vymazanie práce
    $sql = "DELETE FROM jobs WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Po úspešnom vymazaní presmeruj na index.php
        header("Location: index.php");
        exit(); // Ukončí skript po presmerovaní
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid ID.";
}

$conn->close(); // Zavrie pripojenie na databázu
?>

