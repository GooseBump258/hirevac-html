<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO items (name, description) VALUES (?, ?)");
    $stmt->execute([$name, $description]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pridať položku</title>
</head>
<body>
    <h1>Pridať novú položku</h1>
    <form action="create.php" method="POST">
        <label for="name">Názov:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="description">Popis:</label>
        <textarea name="description" id="description" required></textarea><br>
        <button type="submit">Pridať</button>
    </form>
    <a href="index.php">Späť</a>
</body>
</html>
