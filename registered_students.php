<!-- registered_students.php -->

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

// Fetch registered students
$sql = "SELECT idNum, campus, studFName, studLName, amountPaid, attended FROM Registration";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Students</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Registered Students</h2>
        <?php if ($result->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>ID Number</th>
                    <th>Campus</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Amount Paid</th>
                    <th>Attended</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['idNum']; ?></td>
                        <td><?php echo $row['campus']; ?></td>
                        <td><?php echo $row['studFName']; ?></td>
                        <td><?php echo $row['studLName']; ?></td>
                        <td><?php echo $row['amountPaid']; ?></td>
                        <td><?php echo $row['attended'] ? 'Yes' : 'No'; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>No registered students found.</p>
        <?php endif; ?>
        <a href="index.php">Back to Menu</a>
    </div>
</body>
</html>
