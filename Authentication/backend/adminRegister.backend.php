
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
            header("Location: ../adminRegister.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        header("Location: ../adminRegister.php");
        exit;
    }
} else {
    $_SESSION['message'] = "Name not found in the 'it_faculty' table.";
    header("Location: ../adminRegister.php");
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
        header("Location: ../adminLogin.php");
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
        header("Location: ../adminRegister.php");
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>