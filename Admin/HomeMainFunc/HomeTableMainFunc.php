<?php
include_once("header.php");
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


    </style>
</head>

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

        var amBtn = document.getElementById("amBtn");
        var pmBtn = document.getElementById("pmBtn");

        amBtn.addEventListener("click", function() {
            filterRowsByTime("AM");
        });

        pmBtn.addEventListener("click", function() {
            filterRowsByTime("PM");
        });

        function filterRowsByTime(time) {
            var rows = document.querySelectorAll("tbody tr");
            rows.forEach(function(row) {
                var startTime = row.querySelector("td:nth-child(5)").textContent.trim();
                var isAM = startTime.endsWith("AM");
                var isPM = startTime.endsWith("PM");

                if ((time === "AM" && isAM) || (time === "PM" && isPM)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        sortRowsByStartTime();
    });
</script>

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


//
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
    
        echo "<div class='container'><table width='' class='table table-bordered' border='1'>
                <tr><th colspan=\"8\" style=\"background-color: #008000; color: white;text-align:center\">$day</th></tr>
                <tr>
                <th>Room</th>
                <th>Faculty</th>
                <th>Block</th>
                <th>Subject</th>
                <th>Start time</th>
                <th>End time</th>
                <th>Action</th>
                <th>Status</th>
                </tr>";


    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style=\"text-align: center;\">" . ($row['room'] !== null ? $row['room'] : '-----') . "</td>";
            echo "<td style=\"text-align: center;\">" . ($row['faculty'] !== null ? $row['faculty'] : '-----') . "</td>";
            echo "<td style=\"text-align: center;\">" . ($row['blocks'] !== null ? $row['blocks'] : '-----') . "</td>";
            echo "<td style=\"text-align: center;\">" . ($row['subject'] !== null ? $row['subject'] : '-----') . "</td>";
            
            echo "<td style=\"background-color: #F1F1F1; text-align: center;\">";
            if ($row['Start_Time'] !== null) {
                echo date("h:i A", strtotime($row['Start_Time']));
            } else {
                echo '-----';
            }
            echo "</td>";
            
            echo "<td style=\"background-color: #F1F1F1; text-align: center;\">";
            if ($row['End_Time'] !== null) {
                echo date("h:i A", strtotime($row['End_Time']));
            } else {
                echo '-----';
            }
           
            
            echo "<td>";
            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a> ";
            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
            echo "</td>";
            

            echo "<td>";
            echo "</td>";

            //id=". $row['id'] ."
        }
        echo "</table></div>";
    }

    createScheduleTable("Tuesday", $conn);

?>













<?php
// include_once("navbar.php");
?>

<!-- Add Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
<?php 
// include_once("footer.php");
?>