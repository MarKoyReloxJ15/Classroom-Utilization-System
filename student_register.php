<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Form</title>
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
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        select option {
            padding: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
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
   
    <form method="POST" action="student_register.php">
    <h2>Registration</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>


        <label for="blocks">Block:</label>
                <select name="blocks" id="blocks" class="form-control">
                <option value="Irregular">Irregular</option>
                    <?php
                    $connection = mysqli_connect('localhost', 'root', '', 'room_util_sys_db');
                    if (!$connection) {
                        die('Connection failed: ' . mysqli_connect_error());
                    }
                    
                    $query = "SELECT name FROM blocks_detail ORDER BY name";
                    $result = mysqli_query($connection, $query);
                    if (!$result) {
                        die('Query failed: ' . mysqli_error($connection));
                    }
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                    }
                    
                    mysqli_close($connection);
                    ?>
                   
                </select>

        <!-- <label for="block">Block:</label>
            <select id="block" name="block" required>       

            <option value="BSIT 1-A">BSIT 1-A</option>
            <option value="BSIT 1-B">BSIT 1-B</option>
            <option value="BSIT 1-C">BSIT 1-C</option>
            <option value="BSIT 1-D">BSIT 1-D</option>
            
            <option value="BSIT 2-A">BSIT 2-A</option>
            <option value="BSIT 2-B">BSIT 2-B</option>
            <option value="BSIT 2-C">BSIT 2-C</option>
            <option value="BSIT 2-D">BSIT 2-D</option>
            
            <option value="BSIT 3-A">BSIT 3-A</option>
            <option value="BSIT 3-B">BSIT 3-B</option>
            <option value="BSIT 3-C">BSIT 3-C</option>
            <option value="BSIT 3-D">BSIT 3-D</option>

            <option value="BSIT 4-A">BSIT 4-A</option>
            <option value="BSIT 4-B">BSIT 4-B</option>
            <option value="BSIT 4-C">BSIT 4-C</option>
            <option value="BSIT 4-D">BSIT 4-D</option>
            
            <option value="IRREGULAR">IRREGULAR</option>
        </select><br><br> -->


        <!-- <label for="yearLevel">Year Level:</label>
        <select id="yearLevel" name="yearLevel" required>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
            <option value="IRREGULAR">IRREGULAR</option>
        </select> --><br><br>


        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Register">
        <a href="studentLogin.php">
          <button type="button">Back</button>
        </a>
    </form>
</body>
</html>



<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $block = $_POST["blocks"];
    $password = $_POST["password"];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "room_util_sys_db";

        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);

        // Check if the name exists in the other table
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM exprimental_studentlist WHERE name = ?");
        $stmt->execute([$name]);
        $existingNameCount = $stmt->fetchColumn();
    
        // Check if the name already has a password in the student table
        $stmt = $pdo->prepare("SELECT password FROM student WHERE student_name = ?");
        $stmt->execute([$name]);
        $existingPassword = $stmt->fetchColumn();
    
        if ($existingNameCount > 0 && !empty($existingPassword)) {
            // Name exists in the other table and already has a password, disallow data insertion
            echo "<script>alert('You are not allowed to insert data!');</script>";
        } elseif ($existingNameCount > 0) {
            // Name exists in the other table, but doesn't have a password yet
    
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Prepare and execute the INSERT statement
            $stmt = $pdo->prepare("INSERT INTO student (student_name, blocks, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $block, $hashedPassword]);
    
            // Check if the insertion was successful
            if ($stmt->rowCount() > 0) {
                echo "<script>window.location.href = 'studentLogin.php?success=1';</script>";
            } else {
                echo "<script>alert('Registration Failed!');</script>";
            }
        } else {
            // Name doesn't exist in the other table
            echo "<script>alert('Name not found in the other table!');</script>";
        }
    }
    
?>



<!-- if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $block = $_POST["blocks"];
    // $yearLevel = $_POST["yearLevel"];
    $password = $_POST["password"];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "room_util_sys_db";

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Prepare and execute the INSERT statement
    $stmt = $pdo->prepare("INSERT INTO student (student_name, blocks, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $block,  $hashedPassword]);

    // Check if the insertion was successful
    if ($stmt->rowCount() > 0) {
       
echo "<script>window.location.href = 'studentLogin.php?success=1';</script>";

    } else {
        echo "<script>alert('Registration Failed!')</script>";
    }
} -->