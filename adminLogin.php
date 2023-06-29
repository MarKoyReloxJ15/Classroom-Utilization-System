<!DOCTYPE html>
<html>
<head>
  <title>Login System</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>

body {
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.login-container {
  background-color: #ffffff;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin: 100px auto;
  max-width: 400px;
  padding: 20px;
}

h2 {
  text-align: center;
}

form {
  display: flex;
  flex-direction: column;
}

input[type="text"],
input[type="password"] {
  margin-bottom: 10px;
  padding: 10px;
}

button {
  background-color: #4CAF50;
  border: none;
  color: white;
  cursor: pointer;
  padding: 10px;
}

button:hover {
  background-color: #45a049;
}

.error {
  color: red;
  margin-top: 10px;
  text-align: center;
}


  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form action="adminLogin.php" method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
      <br><br>
      <a href="adminRegister.php">Register</a>
    </form>
  </div>
</body>
</html>


<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection settings
    $servername = "localhost";  // Replace with your MySQL server name
    $username_db = "root";      // Replace with your MySQL username
    $password_db = "";  // Replace with your MySQL password
    $dbname = "room_util_sys_db";  // Replace with your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the select statement with a parameterized query
    $stmt = $conn->prepare("SELECT * FROM admin_register WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Set session variables
                $_SESSION['username'] = $username;

                // Redirect to the dashboard or any other page
                header('Location: Admin/admin.php');
                exit();
            } else {
                echo "Invalid username or password!";
            }
        } else {
            echo "Invalid username or password!";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>

