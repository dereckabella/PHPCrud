<!-- raffle.php -->

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

// Get winner from registered students (example logic)
$sql_winner = "SELECT * FROM Registration WHERE attended = 'Yes' ORDER BY RAND() LIMIT 1";
$result_winner = $conn->query($sql_winner);

$winner_name = "";
if ($result_winner->num_rows > 0) {
    $row_winner = $result_winner->fetch_assoc();
    $winner_name = $row_winner['studFName'] . " " . $row_winner['studLName'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raffle</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Raffle Draw</h2>
        <?php if (!empty($winner_name)) : ?>
            <p>Winner: <?php echo $winner_name; ?></p>
            <p>Congratulations!!!</p>
        <?php else : ?>
            <p>No winner selected.</p>
        <?php endif; ?>
        <a href="index.php">Back to Menu</a>
    </div>
</body>
</html>
