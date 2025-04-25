<?php
// Pripojenie k databáze
include 'db.php';

// Skontroluj, či je ID prácu, ktoré sa má aktualizovať, prítomné v URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Načítanie aktuálnych údajov pre dané ID
    $sql = "SELECT * FROM jobs WHERE id = $id";
    $result = $conn->query($sql);

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

    // SQL príkaz na aktualizáciu
    $sqlUpdate = "UPDATE jobs SET job_title = '$jobTitle', job_description = '$jobDescription', job_location = '$jobLocation' WHERE id = $id";

    if ($conn->query($sqlUpdate) === TRUE) {
        // Po úspešnej aktualizácii presmeruj späť na index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Chyba pri aktualizácii: " . $conn->error;
    }
}

$conn->close();
?>

<!-- HTML formulár na aktualizáciu -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Job</title>
</head>
<body>
    <h2>Aktualizovať prácu</h2>

    <form method="POST">
        <label for="job_title">Názov práce:</label>
        <input type="text" name="job_title" value="<?php echo $jobTitle; ?>" required><br><br>

        <label for="job_description">Popis práce:</label>
        <textarea name="job_description" required><?php echo $jobDescription; ?></textarea><br><br>

        <label for="job_location">Lokalita:</label>
        <input type="text" name="job_location" value="<?php echo $jobLocation; ?>" required><br><br>

        <button type="submit" name="submit">Aktualizovať</button>
    </form>
</body>
</html>
