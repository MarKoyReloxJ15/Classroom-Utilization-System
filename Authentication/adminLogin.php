<?php
include('rsuHeader.php');
?>
<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="rsuLogo.png" type="image/x-icon"/>   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="style/adminLogin.style.css">

<title>Classroom Utilization Management System</title>
  <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
  <style>
   
  </style>
</head>

<body>
  <!-- <div class="scholNameCont">
    <div class="scholName">
      <img class="scholNLogo" src="rsuLogo.png">
      <h1>Romblon State University-Cajidiocan Campus</h1>
    </div> -->

  </div>
  <div class="login-container">
    <h2>ADMIN Login</h2>
    <form action="backend/adminLogin.backend.php" method="POST">
      <input type="text" name="username" placeholder="Username" required>

      <div class="password-container">
  <input type="password" name="password" placeholder="Password" required id="passwordField"><br>
  <input type="checkbox" onclick="myFunction()">Show Password <br><br>
    </div>
    
      
      <button type="submit">Login</button>
      <br>
      <button type="button" onclick="location.href='adminRegister.php'" class="c-button">Create Account</button>
    </form>
  </div>

  <script src="script/adminLogin.script.js"></script>

</body>

</html>


