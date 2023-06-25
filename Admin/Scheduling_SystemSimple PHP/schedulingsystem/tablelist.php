<?php
include_once("header.php");
?>

<html>
<head>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        table td {
            text-align: center;
        }
    </style>

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

        var startTimeHeader = document.querySelector("thead th:nth-child(6)");
        startTimeHeader.addEventListener("click", function() {
            sortRowsByStartTime();
        });

        function sortRowsByStartTime() {
            var tableBody = document.querySelector("tbody");
            var rows = Array.from(tableBody.getElementsByTagName("tr"));

            rows.sort(function(rowA, rowB) {
                var startTimeA = rowA.querySelector("td:nth-child(12)").textContent.trim();
                var startTimeB = rowB.querySelector("td:nth-child(12)").textContent.trim();

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
                var startTime = row.querySelector("td:nth-child(12)").textContent.trim();
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

<div class="container-fluid" style="position: sticky;top:2px;z-index:10;">
    <div class="row">
        <div class="col-md-12">
            <div class="search-wrapper d-flex justify-content-end align-items-center">
                <div class="form-group mb-0 mr-2">
                    <input type="text" class="form-control" id="search" placeholder="Search">
                </div>
                <button type="button" class="btn btn-primary mr-2" id="searchBtn">Search</button>
                <button type="button" class="btn btn-secondary" id="refreshBtn">Refresh</button>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-primary" id="amBtn">AM</button>
<button type="button" class="btn btn-secondary" id="pmBtn">PM</button>

<div  style="position: absolute;top:20px;right:40px;" >
    <br>
    <a href="home.php"><input type='submit' class='btn btn-success' name='delete' value='Add New Schedule' style="width: 100%;margin:20px;"></a>
</div>

<div align="center">
    <fieldset>
        <legend>Schedule</legend>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Faculty</th>
                    <th>Block</th>
                    <th>Subject</th>
                    <!-- <th>Day</th> -->
                    <th>Mon</th>
                    <th>Tues</th>
                    <th>Wed</th>
                    <th>Th  </th>
                    <th>Fri</th>
                    <th>Sat</th>
                    <th>Sun</th>
                    <th>Start time</th>
                    <th>End time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
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

                $query = "SELECT * FROM table_sched ";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['room'] . "</td>";
                    echo "<td>" . $row['faculty'] . "</td>";
                    echo "<td>" . $row['blocks'] . "</td>";
                    echo "<td>" . $row['subject'] . "</td>";
                    // echo "<td>" . $row['weekdays'] . "</td>";

                    echo "<td style='background-color: " . $row['Monday'] . "'>";
                    if ($row['Monday'] == 'green') {
                        echo "<span class='glyphicon glyphicon-ok' style=\"color:#ccffff;\"></span>";
                    } elseif ($row['Monday'] == 'red') {
                        echo "<span class='glyphicon glyphicon-remove' style=\"color:black;\"></span>"; 
                    } else {
                        echo "Hello";
                    }
                    echo "</td>";
                    
                    echo "<td style='background-color: " . $row['Tuesday'] . "'>";
                    if ($row['Tuesday'] == 'green') {
                        echo "<span class='glyphicon glyphicon-ok'style=\"color:#ccffff;\"></span>";
                    } elseif ($row['Tuesday'] == 'red') {
                        echo "<span class='glyphicon glyphicon-remove'style=\"color:black;\"></span>"; 
                    } else {
                        echo "Hello";
                    }
                    echo "</td>";
                    
                    echo "<td style='background-color: " . $row['Wednesday'] . "'>";
                    if ($row['Wednesday'] == 'green') {
                        echo "<span class='glyphicon glyphicon-ok'style=\"color:#ccffff;\"></span>";
                    } elseif ($row['Wednesday'] == 'red') {
                        echo "<span class='glyphicon glyphicon-remove' style=\"color:black;\"></span>"; 
                    } else {
                        echo "Hello";
                    }
                    echo "</td>";
                    
                    // Repeat the above pattern for the remaining days of the week
                    
                    // Example for Thursday:
                    echo "<td style='background-color: " . $row['Thursday'] . "'>";
                    if ($row['Thursday'] == 'green') {
                        echo "<span class='glyphicon glyphicon-ok'style=\"color:#ccffff;\"></span>";
                    } elseif ($row['Thursday'] == 'red') {
                        echo "<span class='glyphicon glyphicon-remove'style=\"color:black;\"></span>"; 
                    } else {
                        echo "Hello";
                    }
                    echo "</td>";
                    
                    // Continue for Friday, Saturday, and Sunday
                    
                    // Example for Friday:
                    echo "<td style='background-color: " . $row['Friday'] . "'>";
                    if ($row['Friday'] == 'green') {
                        echo "<span class='glyphicon glyphicon-ok'style=\"color:#ccffff;\"></span>";
                    } elseif ($row['Friday'] == 'red') {
                        echo "<span class='glyphicon glyphicon-remove'style=\"color:black;\"></span>"; 
                    } else {
                        echo "Hello";
                    }
                    echo "</td>";
                    
                    // Repeat the same pattern for Saturday and Sunday
                    
                    // Example for Saturday:
                    echo "<td style='background-color: " . $row['Saturday'] . "'>";
                    if ($row['Saturday'] == 'green') {
                        echo "<span class='glyphicon glyphicon-ok'style=\"color:#ccffff;\"></span>";
                    } elseif ($row['Saturday'] == 'red') {
                        echo "<span class='glyphicon glyphicon-remove'style=\"color:black;\"></span>"; 
                    } else {
                        echo "Hello";
                    }
                    echo "</td>";
                    
                    // Example for Sunday:
                    echo "<td style='background-color: " . $row['Sunday'] . "'>";
                    if ($row['Sunday'] == 'green') {
                        echo "<span class='glyphicon glyphicon-ok'style=\"color:#ccffff;\"></span>";      
                    } elseif ($row['Sunday'] == 'red') {
                        echo "<span class='glyphicon glyphicon-remove'style=\"color:#black;\"></span>";  
                    } else {
                        echo "Hello";
                    }
                    echo "</td>";
                    



                    echo "<td>" . date("h:i A", strtotime($row['Start_Time'])) . "</td>";
                    echo "<td>" . date("h:i A", strtotime($row['End_Time'])) . "</td>";

                    echo "<td>
                            <form class='form-horizontal' method='post' action='" . $_SERVER['PHP_SELF'] . "'>
                                <input name='id' type='hidden' value='" . $row['id'] . "'>
                                <button type='submit' class='btn btn-danger' name='delete'  title=\"Delete Record\"> <span class='glyphicon glyphicon-trash'></span></button>
                            </form>
                        </td>";
                    echo "</tr>";
                }

                // delete record
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $deleteQuery = "DELETE FROM table_sched WHERE id = ?";
                    $stmt = $conn->prepare($deleteQuery);
                    $stmt->bind_param("i", $id);
                    if ($stmt->execute()) {
                        echo '<script type="text/javascript">
                                alert("Schedule Successfully Deleted");
                                location="tablelist.php";
                              </script>';
                        exit;
                    } else {
                        echo 'Could not delete row: ' . $conn->error;
                    }
                }
                ?>
            </tbody>
        </table>
    </fieldset>
</div>


<?php
include_once("navbar.php");
?>

<!-- Add Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
<?php 
include_once("footer.php");
?>
