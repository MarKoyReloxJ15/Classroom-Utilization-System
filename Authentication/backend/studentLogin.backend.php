
<?php
 require_once "config.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection parameters
            // $servername = "localhost";
            // $username_db = "root";
            // $password_db = "";
            // $dbname = "room_util_sys_db";
    
     //       DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME
    // Create a new PDO instance
    // $pdo = new PDO("mysql:host=DB_SERVER;dbname=DB_NAME", DB_USERNAME, DB_PASSWORD);

    date_default_timezone_set('Asia/Manila');
$currentTimestamp = time();
$dateInPhilippines = date('Y-m-d H:i:s', $currentTimestamp);

$userType = 'Student';
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    
    // Prepare and execute the SELECT statement
    $stmt = $pdo->prepare("SELECT * FROM student WHERE student_name = ?");
    $stmt->execute([$username]);

    // Check if a matching user is found
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (password_verify($password, $user['password'])) {
            // Password is correct
            $dateInPhilippines = date('Y-m-d H:i:s'); // Get the current timestamp in 'Y-m-d H:i:s' format
    
            // Corrected the SQL query with placeholders
            $insertStmt = $pdo->prepare("INSERT INTO logs (UserType, Name, TimeStamp) VALUES (?, ?, ?)");
            $insertStmt->execute([$userType, $username, $dateInPhilippines]);
    
            if ($insertStmt->rowCount() > 0) {
                $_SESSION['message'] = "Registration successful. Data inserted into the database.";
            } else {
                $_SESSION['message'] = "Error: Unable to insert data into the logs table.";
            }
    
            // Close the prepared statement
            $insertStmt = null;
    
            // Redirect to the desired location after successful login
            header("Location: ../../Students/HomeTableMainFunc.php");
            echo"  console.log('Success Login');";
            exit();
        } else {
            // Password is incorrect
            // echo "<script>alert('Failed Login')</script>";
            echo "<script>alert(''Failed Login'');</script>";
        //   echo"  console.log('Failed Login');";
           echo"<script> window.location.href = '../studentLogin.php';</script>"; 
        }
    } else {
        // User not found
        // echo "<script>alert('User not found.')</script>";
        echo "<script>alert(''Failed Login'');</script>";
    //    echo" console.log('Failed Login}}');";
        echo"<script> window.location.href = '../studentLogin.php';</script>"; 
    }

    // Close the database connection
    $pdo = null;
}

?>