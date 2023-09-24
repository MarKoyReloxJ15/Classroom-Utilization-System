

<?php
session_start(); // Start the PHP session

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];

   
    require_once "config.php";
    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ==================================================

    $checkNameQuery = "SELECT Name FROM it_faculty WHERE Name = '$name';";
$checkNameResult = $conn->query($checkNameQuery);

if ($checkNameResult && $checkNameResult->num_rows > 0) {
    // The name exists in the 'it_faculty' table
    // Check the number of existing admin accounts
    $countQuery = "SELECT COUNT(*) AS num_rows FROM admin_register";
    $countResult = $conn->query($countQuery);

    if ($countResult) {
        $row = $countResult->fetch_assoc();
        $numRows = $row['num_rows'];

        if ($numRows >= 3) {
            $_SESSION['message'] = "Cannot register. Maximum admin accounts reached.";
            header("Location: adminRegister.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        header("Location: adminRegister.php");
        exit;
    }
} else {
    $_SESSION['message'] = "Name not found in the 'it_faculty' table.";
    header("Location: adminRegister.php");
    exit;
}


    // ================================================
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  

<title>Classroom Utilization Management System</title>
    <style>
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
            font-size: 120%;
            font-weight: bold;
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




        .contShowpass {
  float: right;
   
}

.password-toggle:hover {
    color: #333;
}
    </style>
</head>

<body>

<form method="POST" action="adminRegister.php">
        <h2>Admin Registration Form</h2>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="password">Password: </label>



        <input type="password" name="password" id="password" required>

        <input type="checkbox" onclick="myFunction()">Show Password <br><br>

        
        <input type="submit" value="Register">
        <a href="adminLogin.php">
            <button type="button">Back</button>
        </a>
    </form>
</body>


<script>


function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
   
   

</script>
</html>

