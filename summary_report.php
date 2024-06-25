<!-- summary_report.php -->

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

// Example summary report generation logic
$sql_summary = "SELECT campus,
                      COUNT(*) AS registered_count,
                      SUM(CASE WHEN attended = 'Yes' THEN 1 ELSE 0 END) AS attended_count,
                      SUM(amountPaid) AS total_collection
               FROM Registration
               GROUP BY campus
               WITH ROLLUP";

$result_summary = $conn->query($sql_summary);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Summary Report</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Summary Report</h2>
        <?php if ($result_summary->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>Campus</th>
                    <th>Registered</th>
                    <th>Attended</th>
                    <th>Total Collection</th>
                </tr>
                <?php while ($row = $result_summary->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo isset($row['campus']) ? $row['campus'] : 'TOTALS'; ?></td>
                        <td><?php echo isset($row['registered_count']) ? $row['registered_count'] : ''; ?></td>
                        <td><?php echo isset($row['attended_count']) ? $row['attended_count'] : ''; ?></td>
                        <td><?php echo isset($row['total_collection']) ? $row['total_collection'] : ''; ?></td>
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
