

<?php
include('rsuHeader.php');
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="style/facultyRegister.style.css">
  <style>
  
  </style>
</head>
<body>


<form action="backend/facultyRegister.backend.php" method="POST">
<h2>Faculty Registration Form</h2>

  <label for="name">Name:</label>
                <select name="name" id="name" class="form-control">
                    <?php
                    require_once "backend/config.php";
                    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
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
  <input type="checkbox" onclick="myFunction()">Show Password <br><br>

  <input type="submit" value="Submit">
  <a href="facultyLogin.php">
          <button type="button">Back</button>
        </a>
</form>

<script>
 
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


</script>
</body>
</html>

