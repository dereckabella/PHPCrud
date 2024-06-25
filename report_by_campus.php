<!-- report_by_campus.php -->

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

// Example report generation by campus logic
$sql_report = "SELECT campus, COUNT(*) AS registered_count, SUM(amountPaid) AS total_collection
               FROM Registration
               GROUP BY campus";

$result_report = $conn->query($sql_report);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report by Campus</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Report by Campus</h2>
        <?php if ($result_report->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>Campus</th>
                    <th>Registered</th>
                    <th>Total Collection</th>
                </tr>
                <?php while ($row = $result_report->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['campus']; ?></td>
                        <td><?php echo $row['registered_count']; ?></td>
                        <td><?php echo $row['total_collection']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>No data available.</p>
        <?php endif; ?>
        <a href="index.php">Back to Menu</a>
    </div>
</body>
</html>
