<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "practice_crud";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: newindex.php"); // Redirect to read.php after successful deletion
    exit(); // Ensure no further code is executed
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
