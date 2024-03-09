
<?php
// require_once "config.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $studentID = $_POST["studentID"];

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

    // Check if the student exists in the student table
    $stmt = $pdo->prepare("SELECT student_name, studentID FROM student WHERE student_name = ?");
    $stmt->execute([$name]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($studentID, $user['studentID'])) {
        // Student exists in the student table and matches the hashed studentID
        // Delete the account
        $deleteStmt = $pdo->prepare("DELETE FROM student WHERE student_name = ?");
        $deleteStmt->execute([$name]);

        echo "<script>alert('Account deleted successfully!');</script>";
        header("Location: ../student_register.php");
        exit();
    } else {
        // Student not found in the database or studentID doesn't match
        echo "<script>alert('Student not found in the database or studentID does not match!');</script>";
    }
}


    
?>
