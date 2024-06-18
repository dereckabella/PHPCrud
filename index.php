<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h2>Users</h2>
        <a class='btn btn-primary' href="create.php" role="button">New Client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "crud_practice";

            $connection = new mysqli($servername, $username, $password, $database);

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM users";
            $result = $connection->query($sql);
            
            if (!$result) {
                die("Invalid query: " . $connection->error);
            }
            
            while($row = $result->fetch_assoc()) {
                echo "
                 <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class='btn btn-primary btn-sm'  href='edit.php?id=row[id]'>Edit</a>
                        <a class='btn btn-primary btn-sm' href='delete.php?id=row[id]'>Delete</a>
                    </td>
                </tr>
                ";
            }

            ?>


               
            </tbody>
        </table>
    </div>
</body>
</html>