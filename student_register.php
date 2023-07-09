
<?php
include('rsuHeader.php');
?>


<!DOCTYPE html>
<html>

<head>
    
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
            border-radius: 2vh;
        } */

        /* body {
            position: relative;
        } */

        /* body::before {
            content: "";
            background-image: url(rsuLogo.png);
            width: 90%;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            opacity: 0.1;
            position: absolute;
            top: 25%;
            left: 4.5%;
            right: 0;
            bottom: 0;

        } */

        h2 {
            text-align: center;
            color: #333;
        }

        .container{
           
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            /* background-color: rgba(255, 255, 255, 0.1); */
          
            width: 300px;
            position: relative;
            margin: 0 auto;
            margin-top: 2%;
            
            /* width: 80%; */
            background-color: rgb(250,248,245,0.4);
        }

        select {
            width: 90%;
            padding: 10px;
            box-sizing:content-box;
            border: 2px solid black;
      border-radius: 10px;
            /* border: 1px solid #ccc;
            border-radius: 4px; */
           
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
            width: 90%;
            padding: 10px;
            border: 2px solid black;
      border-radius: 10px;
            /* border: 1px solid #ccc;
            border-radius: 4px; */
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
    <!-- <div class="scholNameCont">
        <div class="scholName">
            <img class="scholNLogo" src="rsuLogo.png">
            <h1>Romblon State University-Cajidiocan Campus</h1>
        </div> -->

    </div>

    <form method="POST" action="student_register.php">
        <h2>Student Registration Form </h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>


        <label for="blocks">Block:</label>
        <select name="blocks" id="name" class="form-control">

            <?php
            $connection = mysqli_connect('localhost', 'root', '', 'room_util_sys_db');
            if (!$connection) {
                die('Connection failed: ' . mysqli_connect_error());
            }

            $query = "SELECT Name FROM blocks_detail ORDER BY Name";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die('Query failed: ' . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
            }

            mysqli_close($connection);
            ?>
            <option value="Irregular">Irregular</option>
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