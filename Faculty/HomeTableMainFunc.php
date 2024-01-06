<?php
//include_once("header.php");
?>



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


<html>
<head>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="icon" href="rsuLogo.png" type="image/x-icon"/>   

    <title>Classroom Utilization Management System</title>

    <style>
        /* body *{
            font-size: 25px;
        } */
        
body::before {
    content: "";
    background-image: url(rsuLogo.png);
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-size: contain;
    background-position: center;
    opacity: 0.08;
    position: fixed;
    top: 0;
    left: 0;
    z-index: -1;
}
td a {
        margin  : 0%; /* Adjust the value as needed */
        }
        th{
            text-align: center;
            background-color: rgb(192,192,192,.2);
        }
       
        table th td{
                /* font-size: 100px; */
                font-size: 4vw;
               
            }

        .officialTable{
            display: none;
           
            
        }

        .switchBut{
            cursor:pointer;
            border-radius: 1vw;
            
        }
       
        .switchBut:hover{
            background-color: beige;
            transition-duration: 1s;
        }

        .statusAvaiBut{
            border-radius: 1vw;
        }
         .cont {
            width: 90%;
            margin:0 auto;
            padding: 0;

        }

        .redbut{
            cursor: pointer;
        }

        @media (max-width: 640px) {
            .hide-column {
                display: none;
            }
           


        }

        
        @media only screen and (max-width: 400px){
            body *{
            font-size: 16px;
        }
        }
       
    </style>
</head>

<?php
include 'logo.php';
?>




<body><br>

<button onclick="myFunction()"class='switchBut swt1'>Switch View</button>


<?php


echo "<tr>
<td>";



// your database connection
        // $host = "localhost";
        // $username = "root";
        // $password = "";
        // $database = "room_util_sys_db";
   
// select database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Couldn't connect to the database: " . $conn->connect_error);
}

function statusFunc($faculty,$startTime,$endTime,$room){
        //     $host = "localhost";
        // $username = "root";
        // $password = "";
        // $database = "room_util_sys_db";
        global $deviceusername;
                // select database
                $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                if ($conn->connect_error) {
                    die("Couldn't connect to the database: " . $conn->connect_error);
                }
                    $query = "SELECT * FROM it_faculty WHERE Name = '$faculty'";
                    
                    // Assuming you have a database connection, execute the query
                    $result = mysqli_query($conn, $query); // Replace $connection with your database connection variable
                    
                    // Check if the query was successful
                    if ($result) {
                        // Process the results
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $timestamp = $row['timestamp'];

                                    // Set the timezone to Asia/Manila
                                    $timezone = new DateTimeZone('Asia/Manila');
                                    date_default_timezone_set($timezone->getName());
                                    
                                    $currentDateTime = new DateTime('now', $timezone);//   $currentDateTime = new DateTime(null, $timezone); //this is the alternative if there is a bug in the afternoon time
                                    
                                   // echo $currentDateTime->format('Y-m-d H:i:s');
                                    

                                    // Create a DateTime object for the timestamp with the desired timezone
                                    $dateTime = new DateTime($timestamp, $timezone);

                                    // Calculate the time difference in minutes
                                    $timeDiffMinutes = round(($currentDateTime->getTimestamp() - $dateTime->getTimestamp()) / 60);

                                    // Calculate the date difference in days
                                    $dateDiffDays = $currentDateTime->diff($dateTime)->days;

                                    // Set the background color based on the time and date difference
                                    if ($dateDiffDays > 0 || $timeDiffMinutes > 900) {
                                        
                                        date_default_timezone_set('Asia/Manila');
                                        $currentDay = date('l');
                                        $hallow = false;
                                        $nameNiCurrent = '';
                                        $titleContent = '';
                                        $color = '';
                                        $functionButton = '';

                                            $current_time = $currentDateTime->format('H:i:s');
                                                    
                                            $date1 = DateTime::createFromFormat('H:i:s', $current_time);
                                            $date2 = DateTime::createFromFormat('H:i:s', $startTime);
                                            $date3 = DateTime::createFromFormat('H:i:s', $endTime);

                                        
                                            date_default_timezone_set('Asia/Manila');
                                            $currenttimestamp = date("Y-m-d 00:00:00");

                                            //$query = "SELECT * FROM request_table WHERE Status = 'Approved' AND day_req = '$currenttimestamp '";
                                         $query = "SELECT * FROM request_table WHERE Status = 'Approved' AND DATE(day_req) = CURDATE()";
                                          // echo $query;
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            
                                           while ($row = $result->fetch_assoc()) {
                                                // Check your conditions here for each row and display accordingly
                                                if ($dateDiffDays > 0 && $date1 > $date2 && $date1 < $date3 && $row['request_room'] == $room && $row['req_starttime'] == $startTime && $row['req_endtime'] == $endTime) {
                                                  $hallow = true;
                                                  $nameNiCurrent = 'Occupied' ;
                                                  $titleContent =  'Occupied by '.  $row['name'];
                                                  $color = 'green';
                                                  $functionButton = "onclick='occupiedRoom(\"" . $row['name'] . "\", \"$room\")'";
                                                 
                                                }

                                                elseif ($dateDiffDays > 0 &&  $row['request_room'] == $room && $row['req_starttime'] == $startTime && $row['req_endtime'] == $endTime) {
                                                    $hallow = true;
                                                    $nameNiCurrent = 'Reserve';
                                                    $titleContent = 'Reserve to '.  $row['name'];
                                                    $color = 'yellow';
                                                    $functionButton = "onclick='reserveRoom(\"" . $row['name'] . "\", \"$room\")'";


                                                  }
                                           }
                                            
                                                 if($dateDiffDays > 0 && $hallow) {
                                                        $backgroundColor = $color;
                                                        $displayText = " $nameNiCurrent";
                                                        echo "<button class='statusAvaiBut redbut' $functionButton title=' $titleContent' style='background-color: $backgroundColor;margin:0;display:inline;'>$displayText</button>";
                                                
                                                }elseif($dateDiffDays > 0 ) {
                                                    $backgroundColor = 'red';
                                                    $displayText = "Vacant $dateDiffDays day(s)";
                                                    echo "<button class='statusAvaiBut redbut' style='background-color: $backgroundColor;margin:0;display:inline;' data-button-id='$room-$currentDay-$startTime-$endTime' data-name='$deviceusername' data-room='$room' data-starttime='$startTime' data-endtime='$endTime'>$displayText</button>";
                                            
                                                 } else {
                                                           if ($timeDiffMinutes <= 60) {
                                                                $backgroundColor = 'red';
                                                                $displayText = "Unavailable $timeDiffMinutes min";
                                                            echo "<button class='statusAvaiBut redbut' style='background-color: $backgroundColor;margin:0;display:inline;'>$displayText</button>";
                                                        } else {
                                                                $hourdiff = floor($timeDiffMinutes / 60);
                                                                $backgroundColor = 'red';
                                                                $displayText = " Unavailable $hourdiff hr(s)";
                                                                echo "<button class='statusAvaiBut redbut' style='background-color: $backgroundColor;margin:0;display:inline;'>$displayText</button>";
                                                        
                                                        }
                                                }
                                            
                                            

                                     //   echo "<button class='statusAvaiBut' style='background-color: $backgroundColor;margin:0;display:inline;'>$displayText</button>";
                                    } else {

                                       
                                                    $current_time = $currentDateTime->format('H:i:s');
                                                
                                                $date1 = DateTime::createFromFormat('H:i:s', $current_time);
                                                $date2 = DateTime::createFromFormat('H:i:s', $startTime);
                                                $date3 = DateTime::createFromFormat('H:i:s', $endTime);
                                                
                                                if ($date1 > $date2 && $date1 < $date3) {
                                                    // echo 'hooray';
                                                    $backgroundColor = 'green';                              
                                                    echo "<div class='statusAvaiBut' style='background-color: $backgroundColor;margin:0;width:50%;display:inline;padding:2%;color:white'>Active</div>";
                                                } else {
                                                    // echo 'The current time is not within the specified range.';
                                                    echo "<div class='statusAvaiBut' style='background-color:blue;margin:0;width:50%;display:inline;padding:2%;color:white'>Inactive</div>";
                                                }

                                    }


                                
                            }
                        } else {
                           
                            echo "No Faculty";
                        }
                        
                        // Free the result set
                        mysqli_free_result($result);
                    } else {
                        echo "Query failed: " . mysqli_error($conn); // Replace $connection with your database connection variable
                    }
                    
                    // Close the database connection
                    mysqli_close($conn); // Replace $connection with your database connection variable
     }



//function for the table
function createScheduleTable($day, $conn,$quarter) {
    $query = "SELECT
    ROW_NUMBER() OVER (ORDER BY table_sched.Start_Time ASC) AS id,
    rooms.room,
    table_sched.faculty,
    table_sched.blocks,
    table_sched.subject,
    table_sched.Start_Time,
    table_sched.End_Time
  FROM
    rooms
  LEFT JOIN
    table_sched ON rooms.room = table_sched.room AND table_sched.$day = 'green' AND Semester = '$quarter'
  ORDER BY
    table_sched.Start_Time ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<div class='container-fluid' style='margin-bottom:1%;position: sticky;top:2px;z-index:10;'>
    <div class='row'>
        <div class='col-md-6'></div>
        <div class='col-md-6 text-right'>
            <div class='d-flex align-items-center justify-content-end'>
                <div class='form-group mr-2 d-flex' style='margin:auto 0;'>
                    <input type='text' class='form-control' id='search'>
                </div>
                <button type='button' class='btn btn-primary mr-2' id='searchBtn'>Search</button>
                <button type='button' class='btn btn-secondary' onclick='location.reload()'>Refresh</button>
            </div>
        </div>
    </div>
</div>";
    

 
        echo "<div class='cont' id='tablecont' ><table width='' class='table table-bordered theTable' border='1' style='background-color: rgba(242, 242, 242, 0.6);'>
        <thead>
                <tr><th colspan=\"7\" style=\"background-color: #008000; color: white;text-align:center\">$day</th></tr>
                <tr>
                <th>Room</th>
                <th>Faculty</th>
                <th class='hide-column'>Block</th>
                <th class='hide-column'>Subject</th>
                <th>Time</th>
                
               
                <th>Status</th>
                </tr></thead><tbody>";


    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style=\"text-align: center;\">" . ($row['room'] !== null ? $row['room'] : '-----') . "</td>";
            echo "<td style=\"text-align: center;\">" . ($row['faculty'] !== null ? $row['faculty'] : '-----') . "</td>";
            echo "<td style=\"text-align: center;\" class='hide-column'>" . ($row['blocks'] !== null ? $row['blocks'] : '-----') . "</td>";
            echo "<td style=\"text-align: center;\" class='hide-column'>" . ($row['subject'] !== null ? $row['subject'] : '-----') . "</td>";
            
            echo "<td style='   text-align: center;'>";

            if ($row['Start_Time'] !== null) {
               // echo date("h:i A", strtotime($row['Start_Time']));

               $start_time = $row['Start_Time'];
               list($hour, $minute, $second) = explode(':', $start_time);
               
               $timestamp = strtotime("$hour:$minute:$second -1 minute");
               $formattedTime = date("h:i A", $timestamp);
               
               echo $formattedTime; 
            } else {
                echo '-----';
            }
            
            echo " - ";
            
            if ($row['End_Time'] !== null) {
                echo date("h:i A", strtotime($row['End_Time']));
            } else {
                echo '-----';
            }
            
            echo "</td>";
            
            
            // echo "<td>";
            
            // echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
            // echo "</td>";
            
            echo "<td class=\"statusRow\" style=\"text-align: center;\">";

            statusFunc($row['faculty'],$row['Start_Time'],$row['End_Time'],$row['room']);
            echo "</td>";

            

            //id=". $row['id'] ."
        }
        echo "</tbody></table></div>";
    }

  // for modification area ====================================

  function roomScheduleTable($currentDay,$quarter){
        
    function createSchedulTable($room, $conn,$currentDay,$quarter) {
       
        $query = "SELECT * FROM table_sched WHERE room = ? AND $currentDay = 'green' AND Semester = ? ORDER BY Start_Time;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $room, $quarter); // Assuming $room and $quarter are strings, use "i" for integers, "d" for doubles, etc.
        $stmt->execute();
        $result = $stmt->get_result();
    
        echo "<div class='container officialTable'><table width='' class='table table-bordered ' border='1'>
        <thead>
                <tr><th colspan=\"5\" style=\"background-color: #008000; color: white;\">$room</th></tr>
                <tr>
                    
                    <th style=\"background-color: lightblue;\">Blocks</th>
                    <th style=\"background-color: lightblue;\">Faculty</th>
                    <th style=\"background-color: #FFB4B4;\">Start time</th>
                    <th style=\"background-color: #FFB4B4;\">End time</th> 
                    <th style=\"background-color: #7BCCB5;\">Status</th>                 
                </tr></thead><tbody>";


    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            // echo "<td>" . $row[$day] . "</td>";
            // echo "<td style=\"background-color: #F1F1F1;\">" . $row['room'] . "</td>";
            echo "<td style=\"background-color: #F1F1F1;\">" . $row['blocks'] . "</td>";
            echo "<td style=\"background-color: #F1F1F1;\">" . $row['faculty'] . "</td>";

                    $start_time = $row['Start_Time'];
                    list($hour, $minute, $second) = explode(':', $start_time);
                    
                    $timestamp = strtotime("$hour:$minute:$second -1 minute");
                    $formattedTime = date("h:i A", $timestamp);
                    
                    echo "<td style=\"background-color: #F1F1F1;\">" . $formattedTime . "</td>";           


          //echo "<td  style=\"background-color: #F1F1F1;\">" . date("h:i A", strtotime($row['Start_Time'])) . "</td>";
         

            echo "<td  style=\"background-color: #F1F1F1;\">" . date("h:i A", strtotime($row['End_Time'])) . "</td>";

            // echo "<td class=\"statusRow\" style=\"text-align: center;\">";
            echo "<td class=\"statusRow\" style=\"text-align: center;background-color: #F1F1F1;\">";

            statusFunc($row['faculty'],$row['Start_Time'],$row['End_Time'],$row['room']);
        echo "</td>";
           
            echo "</tr>";
        }

        

        echo "</tbody></table></div>";
    }
    
    // for the creation of table from Monday to sunday
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Couldn't connect to the database: " . $conn->connect_error);
}

$query = "SELECT * FROM rooms ORDER BY room";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$rooms = array();  // Create an empty array to store room values

while ($row = $result->fetch_assoc()) {
    $rooms[] = $row['room'];  // Add each room value to the array
}

// foreach ($rooms as $room) {
//     echo $room . "<br>";
// }

    foreach ($rooms as $room) {
        createSchedulTable($room, $conn,$currentDay,$quarter);
    }


};


// ============== for month sem function


$currentMonthText = date("F"); // "F" format gives you the full month name
    // echo "Current Month: " . $currentMonth;



function getQuarter($month) {
if ($month >= 8 && $month <= 12) {
    return '1st Sem';
} elseif ($month >= 1 && $month <= 5) {
    return '2nd Sem';
} else {
    return 'Vacation';
}
}

$currentMonth = date("n"); // "n" format gives you the numeric month (1 to 12)
$quarter = getQuarter($currentMonth);
//$quarter = '2nd Sem';

echo "Current Semester: " . $quarter;


// ===========end for mont and sem function

date_default_timezone_set('Asia/Manila');

// end of modification area ==================================
$currentDay = date('l');
// createScheduleTable(  "Monday", $conn);
createScheduleTable(  $currentDay, $conn,$quarter);
roomScheduleTable($currentDay,$quarter,$quarter);

?>








<?php
// include_once("navbar.php");
?>

<!-- Add Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="heartbeat.js"></script>

<script>

// if (window.innerWidth <= 600) {
//     var elements = document.querySelectorAll('.hide-column');
//     elements.forEach(function(element) {
//             element.style.display = 'none';
//         });
//   }



         document.addEventListener("DOMContentLoaded", function() {
        var searchBtn = document.getElementById("searchBtn");
        searchBtn.addEventListener("click", function() {
            var searchValue = document.getElementById("search").value.toLowerCase();
            var rows = document.querySelectorAll("tbody tr");
            rows.forEach(function(row) {
                var cells = row.getElementsByTagName("td");
                var found = false;
                Array.from(cells).forEach(function(cell) {
                    if (cell.textContent.toLowerCase().includes(searchValue)) {
                        found = true;
                    }
                });
                if (found) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });

        var refreshBtn = document.getElementById("refreshBtn");
        refreshBtn.addEventListener("click", function() {
            location.reload();
        });

        var startTimeHeader = document.querySelector("thead th:nth-child(5)");
        startTimeHeader.addEventListener("click", function() {
            sortRowsByStartTime();
        });

        function sortRowsByStartTime() {
            var tableBody = document.querySelector("tbody");
            var rows = Array.from(tableBody.getElementsByTagName("tr"));

            rows.sort(function(rowA, rowB) {
                var startTimeA = rowA.querySelector("td:nth-child(5)").textContent.trim();
                var startTimeB = rowB.querySelector("td:nth-child(5)").textContent.trim();

                var timeA = new Date("1970/01/01 " + startTimeA);
                var timeB = new Date("1970/01/01 " + startTimeB);

                return timeA - timeB;
            });

            rows.forEach(function(row) {
                tableBody.appendChild(row);
            });
        }

      

        sortRowsByStartTime();
    });


    function myFunction() {
    var x = document.getElementById("tablecont");
    var officialTables = document.getElementsByClassName("officialTable");

    if (x.style.display === "none") {
        x.style.display = "block";
        for (var i = 0; i < officialTables.length; i++) {
            officialTables[i].style.display = "none";
        }
    } else {
        x.style.display = "none";
        for (var i = 0; i < officialTables.length; i++) {
            officialTables[i].style.display = "block";
        }
    }
}

// ====================================


document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll("[data-button-id]");

    buttons.forEach(button => {
        button.addEventListener("click", function() {
            const buttonId = this.getAttribute("data-button-id");
            const name = this.getAttribute("data-name");
            const room = this.getAttribute("data-room");
            const startTime = this.getAttribute("data-starttime");
            const endTime = this.getAttribute("data-endtime");
            executePHPFunction(buttonId, name, room, startTime, endTime);
        });
    });
});

function executePHPFunction(buttonId, name, room, startTime, endTime) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // alert(xhr.responseText); // Display the response, you can update this as needed
            alert("Request Send.");
        }
    };

    xhr.send("action=insert_data&button_id=" + encodeURIComponent(buttonId) +
             "&name=" + encodeURIComponent(name) +
             "&room=" + encodeURIComponent(room) +
             "&start_time=" + encodeURIComponent(startTime) +
             "&end_time=" + encodeURIComponent(endTime));
}


// ===============================
    

function reserveRoom(name, room) {
    // Construct the message using template literals for readability
    const message = `${room} is currently reserved for ${name}`;

    // Display the message in an alert dialog
    alert(message);
}


function occupiedRoom(name, room){
       // Construct the message using template literals for readability
       const message = `${room} is currently occupied for ${name}`;

        // Display the message in an alert dialog
        alert(message);

}
          </script>
</body>
</html>



<?php 
// include_once("footer.php");
?>

