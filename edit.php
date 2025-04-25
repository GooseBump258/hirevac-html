<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];

        $stmt = $pdo->prepare("UPDATE items SET name = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $description, $id]);

        header("Location: index.php");
        exit();
    }
} else {
    echo "Položka neexistuje.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upraviť položku</title>
</head>
<body>
    <h1>Upraviť položku</h1>
    <form action="edit.php?id=<?php echo $item['id']; ?>" method="POST">
        <label for="name">Názov:</label>
        <input type="text" name="name" id="name" value="<?php echo $item['name']; ?>" required><br>
        <label for="description">Popis:</label>
        <textarea name="description" id="description" required><?php echo $item['description']; ?></textarea><br>
        <button type="submit">Uložiť</button>
    </form>
    <a href="index.php">Späť</a>
</body>
</html>
