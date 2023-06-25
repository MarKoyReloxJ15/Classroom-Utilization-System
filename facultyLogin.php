<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="facultyLogin.php" method="POST">
        <div class="form-group">
            <label>Advisor</label>
            <select name="advisor" class="form-control">
                <?php
                $connection = mysqli_connect('localhost', 'root', '', 'room_util_sys_db');
                if (!$connection) {
                    die('Connection failed: ' . mysqli_connect_error());
                }
                
                $query = "SELECT Name FROM it_faculty ORDER BY Name";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die('Query failed: ' . mysqli_error($connection));
                }
                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
                }
                
                mysqli_close($connection);
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['advisor'];
    $password = $_POST['password'];

    // Connect to MySQL database
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "room_util_sys_db";

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the query
    $sql = "SELECT * FROM it_faculty WHERE Name = '$username'";
    $result = mysqli_query($conn, $sql);

    

    if ($result) {
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

           

            // Verify the password
            if ($username === $row['Name'] & $password === $row['password']) {
                header('Location: /Faculty/HomeTableMainFunc.php');
            } else {
                echo "Invalid username or password!";
            }
        } else {
            echo "Invalid username or password!!!!!!!!!!!!!!!!!!!";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
