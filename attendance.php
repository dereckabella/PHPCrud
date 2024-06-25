<!-- attendance.php -->

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

$student = null;
$message = "";

// Handle form submission to search for student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_student'])) {
    $idNum = $_POST['idNum'];

    // Check if student exists in registration
    $sql_check = "SELECT * FROM Registration WHERE idNum = '$idNum'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        // Fetch the student record
        $student = $result_check->fetch_assoc();
    } else {
        $message = "<p>Student with ID Number $idNum is not registered.</p>";
    }
}

// Handle form submission to mark attendance
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mark_attendance'])) {
    $idNum = $_POST['idNum'];

    // Update the attendance record
    $sql_update_attendance = "UPDATE Registration SET attended = 1 WHERE idNum = '$idNum'";
    if ($conn->query($sql_update_attendance) === TRUE) {
        $message = "<p>Student's attendance successfully recorded.</p>";
    } else {
        $message = "Error: " . $sql_update_attendance . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Mark Attendance</h2>

        <?php if ($message) : ?>
            <?php echo $message; ?>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="idNum">Student ID Number:</label>
            <input type="text" id="idNum" name="idNum" required><br><br>
            <input type="submit" name="search_student" value="Search Student">
        </form>

        <?php if ($student) : ?>
            <h3>Student Details</h3>
            <table>
                <tr>
                    <th>ID Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Campus</th>
                    <th>Amount Paid</th>
                    <th>Attended</th>
                </tr>
                <tr>
                    <td><?php echo $student['idNum']; ?></td>
                    <td><?php echo $student['studFName']; ?></td>
                    <td><?php echo $student['studLName']; ?></td>
                    <td><?php echo $student['campus']; ?></td>
                    <td><?php echo $student['amountPaid']; ?></td>
                    <td><?php echo $student['attended'] ? 'Yes' : 'No'; ?></td>
                </tr>
            </table>

            <?php if (!$student['attended']) : ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="idNum" value="<?php echo $student['idNum']; ?>">
                    <input type="submit" name="mark_attendance" value="Mark Attendance">
                </form>
            <?php else : ?>
                <p>Student's attendance record already exists.</p>
            <?php endif; ?>
        <?php endif; ?>

        <a href="index.php">Back to Menu</a>
    </div>
</body>
</html>
