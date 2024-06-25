<!-- registration.php -->

<?php
// Database connection (adjust as per your database setup)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_student'])) {
    $idNum = $_POST['idNum'];
    $campus = $_POST['campus'];
    $studFName = $_POST['studFName'];
    $studLName = $_POST['studLName'];
    $amountPaid = $_POST['amountPaid'];

    $sql = "INSERT INTO Registration (idNum, campus, studFName, studLName, amountPaid, attended)
            VALUES ('$idNum', '$campus', '$studFName', '$studLName', '$amountPaid', 0)";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Student registered successfully.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Register a Student</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="idNum">Student ID Number:</label>
            <input type="text" id="idNum" name="idNum" required><br><br>

            <label for="campus">Campus:</label>
            <select id="campus" name="campus" required>
                <option value="MAIN">MAIN</option>
                <option value="BANILAD">BANILAD</option>
                <option value="LM">LM</option>
                <option value="PT">PT</option>
            </select><br><br>

            <label for="studFName">First Name:</label>
            <input type="text" id="studFName" name="studFName" required><br><br>

            <label for="studLName">Last Name:</label>
            <input type="text" id="studLName" name="studLName" required><br><br>

            <label for="amountPaid">Amount Paid:</label>
            <input type="number" id="amountPaid" name="amountPaid" required><br><br>

            <input type="submit" name="register_student" value="Register Student">
        </form>
        <a href="index.php">Back to Menu</a>
        <a href="registered_students.php">Registered Students</a>
    </div>
</body>
</html>
