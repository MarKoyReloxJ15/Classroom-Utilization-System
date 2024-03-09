

<?php
 include_once('heartbeat.php');
?>


<?php


if(isset($_SESSION['username'])) {
    // User is logged in
    $username = $_SESSION['username'];
    $deviceusername = $username;
} else {
    $deviceusername = 'You are not logged in'; // Updated message
    // header('Location: ../index.php'); // Redirect to the login page or homepage
    // exit(); // Make sure to exit the script after redirecting
}
?>


<?php

require_once "config.php";

date_default_timezone_set('Asia/Manila');

if (isset($_POST['action']) && $_POST['action'] == 'insert_data') {
    $buttonId = isset($_POST['button_id']) ? $_POST['button_id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $room = isset($_POST['room']) ? $_POST['room'] : '';
    $startTime = isset($_POST['start_time']) ? $_POST['start_time'] : '';
    $endTime = isset($_POST['end_time']) ? $_POST['end_time'] : '';

    // Connect to your MySQL database
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 
    $currenttimestamp = date("Y-m-d");
   
    // Check if the data already exists in the database
    $sqlCheck = "SELECT COUNT(*) as count FROM request_table WHERE name = '$name' AND request_room = '$room' AND req_starttime = '$startTime' AND req_endtime = '$endTime' AND  day_req= '$currenttimestamp'";
    $result = $conn->query($sqlCheck);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            echo "Data already exists. Duplicate not inserted.";
        } else {
            // Insert data into your MySQL table (request_table)
            $timestamp = date("Y-m-d"); // Current timestamp
            $sqlInsert = "INSERT INTO request_table (name, request_room, req_starttime, req_endtime, day_req) 
                          VALUES ('$name', '$room', '$startTime', '$endTime', '$timestamp')";
            
            if ($conn->query($sqlInsert) === TRUE) {
                echo "Data inserted successfully.";
            } else {
                echo "Error: " . $sqlInsert . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Error checking duplicate data: " . $conn->error;
    }

    $conn->close();
}

?>
