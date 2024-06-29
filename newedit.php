<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "practice_crud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the user id from the URL parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("User ID is missing.");
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: newindex.php"); // Redirect to read.php after successful update
        exit(); // Ensure no further code is executed
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve the user data from the database
$sql = "SELECT name, email, phone, address FROM users WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("User not found.");
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post" action="newedit.php?id=<?php echo $id; ?>">
        Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        Phone: <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br>
        Address: <input type="text" name="address" value="<?php echo $row['address']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
