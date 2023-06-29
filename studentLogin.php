<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    
    <form method="POST" action="studentLogin.php">
    <h2>Login</h2> 
    <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

     
        <label for="password">Password:<sword:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
        <a href="student_register.php">Register</a>
    </form>
</body>
</html>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection parameters
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "room_util_sys_db";

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);

    // Prepare and execute the SELECT statement
    $stmt = $pdo->prepare("SELECT * FROM student WHERE student_name = ?");
    $stmt->execute([$username]);

    // Check if a matching user is found
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            echo "Login successful!";
            // Redirect to the desired page after successful login
             header("Location: Students/HomeTableMainFunc.php");
            // exit();
        } else {
            echo "<script>alert('Failed Login')</script>";
        }
    } else {
        echo "User not found.";
    }

    // Close the database connection
    $pdo = null;
}
?>
