<?php
session_start();

if(isset($_SESSION['username'])) {
    // User is logged in
    $username = $_SESSION['username'];

    // Connect to MySQL database
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "room_util_sys_db";

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Update the timestamp for the logged-in user in the database
    $query = "UPDATE it_faculty SET `timestamp` = NOW() WHERE `Name` = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Timestamp updated successfully
        echo "Timestamp updated.";
    } else {
        // Error updating the timestamp
        echo "Error updating timestamp: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // User is not logged in
    echo "User is not logged in.";
}
?>
