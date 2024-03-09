<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['advisor'];
    $password = $_POST['password'];

    // Connect to MySQL database
            // $servername = "localhost";
            // $dbUsername = "root";
            // $dbPassword = "";
            // $dbName = "room_util_sys_db";
        require_once "config.php";

        date_default_timezone_set('Asia/Manila');
$currentTimestamp = time();
$dateInPhilippines = date('Y-m-d H:i:s', $currentTimestamp);

$userType = 'Faculty';

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

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
            // echo "$hashedPassword";
            // echo "$password";

            // Verify the password
            if (password_verify($password, $hashedPassword))  {
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
                header('Location: ../../Faculty/HomeTableMainFunc.php');
                exit();

            } else {
                echo "<script>alert('Invalid username or password!')
                window.location.href = '../facultyLogin.php';</script>"; 
                
            }
        } else {
            echo "<script>alert('Invalid username or password!')
                window.location.href = '../facultyLogin.php';</script>"; 
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>