<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection settings
        // $servername = "localhost";  // Replace with your MySQL server name
        // $username_db = "root";      // Replace with your MySQL username
        // $password_db = "";  // Replace with your MySQL password
        // $dbname = "room_util_sys_db";  // Replace with your MySQL database name

        require_once "config.php";



        date_default_timezone_set('Asia/Manila');
$currentTimestamp = time();
$dateInPhilippines = date('Y-m-d H:i:s', $currentTimestamp);

$userType = 'Admin';


    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

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


                $stmt = $conn->prepare("INSERT INTO logs (UserType, Name, TimeStamp) VALUES (?, ?, ?)");
                $stmt->bind_param('sss',$userType, $username, $dateInPhilippines);
            
                // Execute the insert statement
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Registration successful. Data inserted into the database.";
                   
                } else {
                    $_SESSION['message'] = "Error: " . $stmt->error;
                  
                }
            
                // Close the prepared statement and database connection
                $stmt->close();
                $conn->close();


                // Redirect to the dashboard or any other page
                header('Location: ../../Admin/admin.php');
                exit();
            } else {
                // echo "Invalid username or password!";
                echo "<script>alert('Invalid username or password!')
                window.location.href = '../adminLogin.php';</script>"; 
            }
        } else {
            // echo "Invalid username or password!";
            echo "<script>alert('Invalid username or password!')
            window.location.href = '../adminLogin.php';</script>"; 
        }
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>
