
<?php
include('./Authentication/rsuHeader.php');
?>


<html>

<head>
    <title>Options</title>
    <link rel="stylesheet" href="Authentication/style/rsuHeader.style.css">
    <link rel="stylesheet" href="Authentication/style/index.style.css">
    <style>
    
    </style>
</head>

<body>
   
<br><br>
    <form method="POST" action="./Authentication/redirect.php">
        <h2>Select an option</h2>
        <div class="radioCont">
        <input type="radio" id="adminRadio" name="option" value="option1" required><label for="adminRadio">Admin</label><br>
        <input type="radio" id="facRadio" name="option" value="option2" required><label for="facRadio">Faculty</label><br>
        <input type="radio" id="studRadio" name="option" value="option3" required><label for="studRadio">Student</label><br><br>
        </div>
        <input type="submit" value="Submit">
    </form>
</body>

</html>