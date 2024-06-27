<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "practice_crud";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        header("Location: newindex.php"); // Redirect to read.php after successful creation
        exit(); // Ensure no further code is executed
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
    <h2>Create User</h2>
    <form method="post" action="newcreate.php">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Phone: <input type="phone" name="phone" required><br>
        <input type="submit" value="Create">
    </form>
</body>
</html>
