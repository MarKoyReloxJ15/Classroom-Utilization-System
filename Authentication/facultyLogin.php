

<?php
include('rsuHeader.php');
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/facultyLogin.style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   
    
</head>

<body>
    <!-- <div class="scholNameCont">
        <div class="scholName">
            <img class="scholNLogo" src="rsuLogo.png">
            <h1>Romblon State University-Cajidiocan Campus</h1>
        </div>
    </div> -->
        <div class="container">
            <form action="backend/facultyLogin.backend.php" method="POST">
                <h2>Faculty Login</h2>
                <div class="form-group">
                    <label for="advisor">Advisor</label>
                    <select name="advisor" id="advisor" class="form-control">
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
                </div>

                <div class="form-group">
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" class="form-control password-input">
                    <input type="checkbox" onclick="myFunction()">Show Password <br><br>
                </div>
                </div>

                <input type="submit" value="Submit">
                <a href="facultyRegister.php">Register</a>
            </form>
        </div>


        <script src="script/facultyLogin.script.js"></script>
</body>

</html>


