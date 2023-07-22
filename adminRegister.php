

<?php
session_start(); // Start the PHP session

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];

    // Database connection settings
    $servername = "localhost";  // Replace with your MySQL server name
    $username = "root";        // Replace with your MySQL username
    $password_db = "";         // Replace with your MySQL password
    $dbname = "room_util_sys_db"; // Replace with your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check the number of existing admin accounts
    $countQuery = "SELECT COUNT(*) as num_rows FROM admin_register";
    $countResult = $conn->query($countQuery);
    if ($countResult) {
        $row = $countResult->fetch_assoc();
        $numRows = $row['num_rows'];
        if ($numRows >= 5) {
            $_SESSION['message'] = "Cannot register. Maximum admin accounts reached.";
            header("Location: adminRegister.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        header("Location: adminRegister.php");
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind the insert statement
    $stmt = $conn->prepare("INSERT INTO admin_register (name, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $hashedPassword);

    // Execute the insert statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful. Data inserted into the database.";
        header("Location: adminLogin.php");
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
        header("Location: adminRegister.php");
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>






<?php
include('rsuHeader.php');
?>


<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="rsuLogo.png" type="image/x-icon"/>   

<title>Classroom Utilization Management System</title>
    <style>
        /* .scholNLogo {
            position: relative;
            width: 8%;
            height: 70%;
            margin-right: 10px;
        }

        .scholName {

            position: relative;
            height: 100%;
            background-color: #00AF50;
            border-radius: 1px;
            border: 1px solid #41719C;

            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        } */

      /* body {
            position: relative;
        } */
        /* body::before {
            co  ntent: "";
            background-image: url(rsuLogo.png);
            width: 90%;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            opacity: 0.1;
            position: absolute;
            top: 20%;
            left: 4.5%;
            right: 0;
            bottom: 0;

        } */

        h2 {
            color: #333333;
        }

        form {
            position: relative;
            background-color: #ffffff;
            padding: 20px;
            width: 300px;
            margin: 0 auto;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.1);
        }

        button {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 10px 10px;
            margin-top: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        button :hover{
            background-color: black;
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
            background-color: green;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: black;
        }
    </style>
</head>

<body>
    <!-- <div class="scholNameCont">
        <div class="scholName">
            <img class="scholNLogo" src="rsuLogo.png">
            <h1>Romblon State University-Cajidiocan Campus</h1>
        </div> -->


        <form method="POST" action="adminRegister.php">
            <h2>Admin Registration Form</h2>
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

