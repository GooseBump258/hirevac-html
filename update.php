<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM jobs WHERE id=$id";
    $result = $conn->query($sql);
    $job = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $location = $_POST['location'];

        $update_sql = "UPDATE jobs SET title='$title', description='$description', location='$location' WHERE id=$id";
        if ($conn->query($update_sql) === TRUE) {
            echo "Job updated successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<form method="POST" action="">
    <input type="text" name="title" value="<?php echo $job['title']; ?>" required>
    <textarea name="description" required><?php echo $job['description']; ?></textarea>
    <input type="text" name="location" value="<?php echo $job['location']; ?>" required>
    <button type="submit">Update Job</button>
</form>
