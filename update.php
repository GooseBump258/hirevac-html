<?php
// Pripojenie k databáze
include 'db.php';

// Skontroluj, či je ID prácu, ktoré sa má aktualizovať, prítomné v URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Načítanie aktuálnych údajov pre dané ID pomocou prepared statement
    $sql = "SELECT * FROM jobs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ak je nájdený záznam, vyplníme formulár
        $row = $result->fetch_assoc();
        $jobTitle = $row['job_title'];
        $jobDescription = $row['job_description'];
        $jobLocation = $row['job_location'];
    } else {
        echo "Záznam neexistuje.";
        exit();
    }
} else {
    echo "Neplatné ID.";
    exit();
}

// Ak je odoslaný formulár, aktualizujeme údaje
if (isset($_POST['submit'])) {
    $jobTitle = $_POST['job_title'];
    $jobDescription = $_POST['job_description'];
    $jobLocation = $_POST['job_location'];

    // SQL príkaz na aktualizáciu pomocou prepared statement
    $sqlUpdate = "UPDATE jobs SET job_title = ?, job_description = ?, job_location = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("sssi", $jobTitle, $jobDescription, $jobLocation, $id);

    if ($stmtUpdate->execute()) {
        // Po úspešnej aktualizácii presmeruj späť na index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Chyba pri aktualizácii: " . $stmtUpdate->error;
    }
}

$stmt->close();
$stmtUpdate->close();
$conn->close();
?>

<!-- HTML formulár na aktualizáciu -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktualizovať prácu</title>
</head>
<body>
    <h2>Aktualizovať prácu</h2>

    <form method="POST">
        <label for="job_title">Názov práce:</label>
        <input type="text" name="job_title" value="<?php echo htmlspecialchars($jobTitle); ?>" required><br><br>

        <label for="job_description">Popis práce:</label>
        <textarea name="job_description" required><?php echo htmlspecialchars($jobDescription); ?></textarea><br><br>

        <label for="job_location">Lokalita:</label>
        <input type="text" name="job_location" value="<?php echo htmlspecialchars($jobLocation); ?>" required><br><br>

        <button type="submit" name="submit">Aktualizovať</button>
    </form>
</body>
</html>
