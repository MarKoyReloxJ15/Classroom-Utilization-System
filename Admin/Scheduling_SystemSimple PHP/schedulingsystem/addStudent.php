<?php
// Database configuration
    // $host = "localhost";
    // $username = "root";
    // $password = "";
    // $database = "room_util_sys_db";
require_once "config.php";
// Connect to MySQL database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $names = $_POST['names'];

    // Sanitize and validate the data (you can add more validation if needed)
    $sanitizedNames = array();
    foreach ($names as $name) {
        $sanitizedNames[] = $conn->real_escape_string(trim($name));
    }

    // Insert data into the database
    $insertQuery = "INSERT INTO exprimental_studentlist (Name) VALUES ";

    $values = array();
    foreach ($sanitizedNames as $name) {
        $values[] = "('$name')";
    }

    $insertQuery .= implode(',', $values);

    if ($conn->query($insertQuery) === TRUE) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../images/rsuLogo.png" type="image/x-icon"/>   
  <title>Classroom Utilization Management System</title>
  <link rel="stylesheet" href="style/addStudent.style.css">
  <style>
   
  </style>
</head>

<body>
  <br>  <br>
  <h1>Add Student Name</h1>
  <div class="back-button">
    <button><a href="studentList.php">Back</a></button>
  </div>

  <!-- Container for the form -->
  <div class="form-container">
    <!-- HTML form with dynamic input fields -->
    <form action="addStudent.php" method="post">
      <div id="nameInputs">
        <label for="name1">Name 1:</label>
        <input type="text" id="name1" name="names[]" required>
      </div>

      <button type="button" onclick="addNameField()">Add Another Name</button>

      <!-- Other form elements as needed -->

      <button type="submit">Submit</button>
    </form>
  </div>
  <h1>OR</h1>
  <script>
    let nameCount = 1;

    function addNameField() {
      nameCount++;
      const nameInputsDiv = document.getElementById('nameInputs');
      const newInput = document.createElement('div');
      newInput.innerHTML = `
        <label for="name${nameCount}">Name ${nameCount}:</label>
        <input type="text" id="name${nameCount}" name="names[]" required>
      `;
      nameInputsDiv.appendChild(newInput);
    }
  </script>
</body>
</html>



<?php
include_once("addCSV.php");
?>