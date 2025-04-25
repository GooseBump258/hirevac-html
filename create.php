<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    $sql = "INSERT INTO jobs (title, description, location) VALUES ('$title', '$description', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo "New job created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form method="POST" action="">
    <input type="text" name="title" placeholder="Job Title" required>
    <textarea name="description" placeholder="Job Description" required></textarea>
    <input type="text" name="location" placeholder="Job Location" required>
    <button type="submit">Add Job</button>
</form>
