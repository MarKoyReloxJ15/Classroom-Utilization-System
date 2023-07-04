<!DOCTYPE html>
<html>
<head>
  <title>Faculty Registration Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      padding: 20px;
    }

    h2 {
      text-align: center;
    }

    form {
      max-width: 300px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    label {
      display: block;
      margin-bottom: 10px;
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

    select,
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>


<form action="facultyRegister.php" method="POST">
<h2>Registration Form</h2>

  <label for="name">Name:</label>
                <select name="name" id="name" class="form-control">
                    <?php
                    $connection = mysqli_connect('localhost', 'root', '', 'room_util_sys_db');
                    if (!$connection) {
                        die('Connection failed: ' . mysqli_connect_error());
                    }
                    
                    $query = "SELECT Name FROM it_faculty ORDER BY Name";
                    $result = mysqli_query($connection, $query);
                    if (!$result) {
                        die('Query failed: ' . mysqli_error($connection));
                    }
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
                    }
                    
                    mysqli_close($connection);
                    ?>
                </select>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required>

  <input type="submit" value="Submit">
  <a href="facultyLogin.php">
          <button type="button">Back</button>
        </a>
</form>

</body>
</html>


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
  $servername = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbName = "room_util_sys_db";

  $pdo = new PDO("mysql:host=$servername;dbname=$dbName", $dbUsername, $dbPassword);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Check if the password already exists or is empty in the table
  $checkQuery = "SELECT password FROM it_faculty WHERE Name = ?";
  $stmt = $pdo->prepare($checkQuery);
  $stmt->execute([$name]);
  $existingPassword = $stmt->fetchColumn();

  if ($existingPassword !== null && $existingPassword !== "") {
      echo "Password already exists in the table. Please choose a different password.";
      exit; // Stop further execution
  }

  // Update the password in the database
  $updateQuery = "UPDATE it_faculty SET password = ? WHERE Name = ? AND (password IS NULL OR password = '')";
  $updateStmt = $pdo->prepare($updateQuery);
  $updateStmt->execute([$hashedPassword, $name]);

  if ($updateStmt->rowCount() > 0) {
      echo "Password updated successfully!";
      header("Location: facultyLogin.php");
      exit;
  } else {
      echo "Error updating password.";
  }
}


?>
