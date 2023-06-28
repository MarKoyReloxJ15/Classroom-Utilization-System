<?php
include_once("header.php");
?>

<?php
//include 'heartbeat.php';
?>




<html>
<head>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>

        td a {
        margin  : 10%; /* Adjust the value as needed */
        }
        th{
            text-align: center;
            background-color: rgb(192,192,192,.2);
        }

    </style>
</head>

   

</head>

<body><br>



<?php


echo "<tr>
<td>";



// your database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "room_util_sys_db";

// select database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Couldn't connect to the database: " . $conn->connect_error);
}

function statusFunc($faculty){
            $host = "localhost";
        $username = "root";
        $password = "";
        $database = "room_util_sys_db";

                // select database
                $conn = new mysqli($host, $username, $password, $database);
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
                                    if ($dateDiffDays > 0 || $timeDiffMinutes > 30) {
                                        $backgroundColor = 'red';

                                        if ($dateDiffDays > 0) {
                                            $displayText = "Vacant $dateDiffDays day(s)";
                                        } else {
                                            if ($timeDiffMinutes <= 60) {
                                                $displayText = "Faculty unavailable $timeDiffMinutes min";
                                            } else {
                                                $hourdiff = floor($timeDiffMinutes / 60);
                                                $displayText = "Faculty unavailable $hourdiff hour(s)";
                                            }
                                        }

                                        echo "<button style='background-color: $backgroundColor;margin:0;display:inline;'>$displayText</button>";
                                    } else {
                                        $backgroundColor = 'green';
                                        echo "<div style='background-color: $backgroundColor;margin:0;width:50%;display:inline;padding:2%;color:white'>Active</div>";
                                    }


                                // Echo the background color

                                // Output the <td> element with the background color
                                // echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a> ";
                                // echo "<div style='background-color: $backgroundColor;margin:0;width:50%;display:inline;padding:1%;'>Active $timeDiffMinutes min ago</div>";
                            }
                        } else {
                           // echo "<a href='home.php? title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";

                            echo "No Schedule found.";
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
function createScheduleTable($day, $conn) {
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
        table_sched ON rooms.room = table_sched.room AND table_sched.$day = 'green'
      ORDER BY
        table_sched.Start_Time ASC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<div class='container' style='margin-bottom:1%;'>
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
    


        echo "<div class='container'><table width='' class='table table-bordered' border='1'>
                <tr><th colspan=\"7\" style=\"background-color: #008000; color: white;text-align:center\">$day</th></tr>
                <tr>
                <th>Room</th>
                <th>Faculty</th>
                <th>Block</th>
                <th>Subject</th>
                <th>Time</th>
                
               
                <th>Status</th>
                </tr>";


    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style=\"text-align: center;\">" . ($row['room'] !== null ? $row['room'] : '-----') . "</td>";
            echo "<td style=\"text-align: center;\">" . ($row['faculty'] !== null ? $row['faculty'] : '-----') . "</td>";
            echo "<td style=\"text-align: center;\">" . ($row['blocks'] !== null ? $row['blocks'] : '-----') . "</td>";
            echo "<td style=\"text-align: center;\">" . ($row['subject'] !== null ? $row['subject'] : '-----') . "</td>";
            
            echo "<td style='   text-align: center;'>";

            if ($row['Start_Time'] !== null) {
                echo date("h:i A", strtotime($row['Start_Time']));
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

           statusFunc($row['faculty'],$row['room']);
            echo "</td>";

            

            //id=". $row['id'] ."
        }
        echo "</table></div>";
    }

    $currentDay = date('l');// insert this to get the current day 

    createScheduleTable( $currentDay, $conn);

?>







<?php
// include_once("navbar.php");
?>

<!-- Add Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- <script src="heartbeat.js"></script> -->



<script type="text/javascript">
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

        // var amBtn = document.getElementById("amBtn");
        // var pmBtn = document.getElementById("pmBtn");

        // amBtn.addEventListener("click", function() {
        //     filterRowsByTime("AM");
        // });

        // pmBtn.addEventListener("click", function() {
        //     filterRowsByTime("PM");
        // });

        // function filterRowsByTime(time) {
        //     var rows = document.querySelectorAll("tbody tr");
        //     rows.forEach(function(row) {
        //         var startTime = row.querySelector("td:nth-child(5)").textContent.trim();
        //         var isAM = startTime.endsWith("AM");
        //         var isPM = startTime.endsWith("PM");

        //         if ((time === "AM" && isAM) || (time === "PM" && isPM)) {
        //             row.style.display = "";
        //         } else {
        //             row.style.display = "none";
        //         }
        //     });
        // }

        sortRowsByStartTime();
    });
</script>
</body>
</html>
<?php 
// include_once("footer.php");
?>

