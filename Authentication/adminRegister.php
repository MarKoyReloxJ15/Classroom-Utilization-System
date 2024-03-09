<?php
include('rsuHeader.php');
?>

<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="rsuLogo.png" type="image/x-icon"/> 
<link rel="stylesheet" href="style/adminRegister.style.css">  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  

<title>Classroom Utilization Management System</title>
    <style>
       
    </style>
</head>

<body>

<form method="POST" action="adminRegister.php">
        <h2>Admin Registration Form</h2>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="password">Password: </label>



        <input type="password" name="password" id="password" required>

        <input type="checkbox" onclick="myFunction()">Show Password <br><br>

        
        <input type="submit" value="Register">
        <a href="adminLogin.php">
            <button type="button">Back</button>
        </a>
    </form>
</body>


<script src="script/adminRegister.script.js"></script>
</html>

