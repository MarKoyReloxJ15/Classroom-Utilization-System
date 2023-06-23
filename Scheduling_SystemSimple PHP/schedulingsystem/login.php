<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password) {
        $conn = new mysqli("localhost", "root", "", "insertion");
        if ($conn->connect_error) {
            die("Couldn't connect to the database!");
        }

        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $dbusername = $row['username'];
            $dbpassword = $row['password'];

            if ($password === $dbpassword) {
                echo '<script type="text/javascript">
                          alert("Welcome User!");
                          location="home.php";
                      </script>';
                $_SESSION['username'] = $username;
                exit;
            } else {
                echo '<script type="text/javascript">
                          alert("Wrong Password!");
                          location="index.php";
                      </script>';
                exit;
            }
        } else {
            echo '<script type="text/javascript">
                      alert("That user doesn\'t exist!");
                      location="index.php";
                  </script>';
            exit;
        }
    } else {
        echo '<script type="text/javascript">
                  alert("Please enter a username and password!");
                  location="tb.php";
              </script>';
        exit;
    }
}
?>
