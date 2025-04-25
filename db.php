<?php
$servername = "localhost";
$username = "root"; // vaše MySQL meno
$password = ""; // vaše MySQL heslo
$dbname = "hirevac";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
