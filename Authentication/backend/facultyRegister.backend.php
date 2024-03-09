
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $name = $_POST["name"];
  $password = $_POST["password"];

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Perform any necessary processing with the form data
  // ...

  // Save the hashed password in the database
  // Assuming you have a database connection established
      // $servername = "localhost";
      // $dbUsername = "root";
      // $dbPassword = "";
      // $dbName = "room_util_sys_db";
      require_once "config.php";
    //  DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME
  // $pdo = new PDO("mysql:host=DB_SERVER;dbname=DB_NAME", DB_USERNAME, DB_PASSWORD);
  $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Check if the password already exists or is empty in the table
  $checkQuery = "SELECT password FROM it_faculty WHERE Name = ?";
  $stmt = $pdo->prepare($checkQuery);
  $stmt->execute([$name]);
  $existingPassword = $stmt->fetchColumn();

  if ($existingPassword !== null && $existingPassword !== "") {
      echo "Password already exists in the table. Please choose a different password.";
      header("Location: ../facultyRegister.php");
      exit; // Stop further execution
  }

  // Update the password in the database
  $updateQuery = "UPDATE it_faculty SET password = ? WHERE Name = ? AND (password IS NULL OR password = '')";
  $updateStmt = $pdo->prepare($updateQuery);
  $updateStmt->execute([$hashedPassword, $name]);

  if ($updateStmt->rowCount() > 0) {
      echo "Password updated successfully!";
      header("Location: ../facultyLogin.php");
      exit;
  } else {
      echo "Error updating password.";
  }
}


?>
