<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h2 {
            color: #333333;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            width: 300px;
            margin: 0 auto;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        button {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    
    <form method="POST" action="adminRegister.php">
    <h2>Registration Form</h2>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Register">
        <a href="adminLogin.php">
          <button type="button">Back</button>
        </a>
    </form>

</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Database connection settings
    $servername = "localhost";  // Replace with your MySQL server name
    $username = "root";        // Replace with your MySQL username
    $password_db = ""; // Replace with your MySQL password
    $dbname = "room_util_sys_db"; // Replace with your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the insert statement
    $stmt = $conn->prepare("INSERT INTO admin_register (name, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $name,  $hashedPassword);

    // Execute the insert statement
    if ($stmt->execute() === TRUE) {
        echo "Registration successful. Data inserted into the database.";
        header("Location: adminLogin.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>

