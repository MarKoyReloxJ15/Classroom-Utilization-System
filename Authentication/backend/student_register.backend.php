
<?php
require_once "config.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $block = $_POST["blocks"];
    $studentID = $_POST["studentID"];
    $email = $_POST["email"];
    $password = $_POST["password"];

   
        // Create a new PDO instance
        // $pdo = new PDO("mysql:host=DB_SERVER;dbname=DB_NAME", DB_USERNAME, DB_PASSWORD);
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

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
            $hashedStudentID = password_hash($studentID, PASSWORD_DEFAULT);
    
            // Prepare and execute the INSERT statement
            $stmt = $pdo->prepare("INSERT INTO student (student_name, blocks, password, studentID,email) VALUES (?, ?, ?,?,?)");
            $stmt->execute([$name, $block, $hashedPassword, $hashedStudentID,  $email]);
    
            // Check if the insertion was successful
            if ($stmt->rowCount() > 0) {
                echo "<script>window.location.href = '../studentLogin.php?success=1';</script>";
            } else {
                // echo "<script>alert('Registration Failed!');</script>";
                echo "<script>alert('Registration Failed!')
                window.location.href = '../student_register.php';</script>"; 
            }
        } else {
            // Name doesn't exist in the other table
            // echo "<script>alert('Name not found in the other table!');</script>";
            echo "<script>alert('Registration Failed!')
            window.location.href = '../student_register.php';</script>"; 
        }
    }
    
?>
