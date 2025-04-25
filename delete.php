<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete_sql = "DELETE FROM jobs WHERE id=$id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Job deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
