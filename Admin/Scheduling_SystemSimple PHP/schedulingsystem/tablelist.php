<?php
//include_once("header.php");
?>

<!--  -->
<html>
<head>
<style>
.navbar {
    background-color: beige;
    border-radius: 10px; /* Add rounded corners to the navigation bar */
    margin-bottom: 0; /* Remove the bottom margin */
}

.navbar ul {
    display: inline; /* Set the list items to display inline */
    list-style: none;
    padding: 0;
    margin: 0;
}

.navbar li {
    display: inline; /* Set the list items to display inline */
    margin-right: 15px; /* Add some spacing between the list items */
    
}

.navbar a {
    text-decoration: none;
    color: #333;
    padding: 8px 15px; /* Add horizontal and vertical padding to the links */
    border: 1px solid #ccc; /* Use a lighter border color */
    border-radius: 5px;
    background-color: white; /* Set the background color to match the navbar */
    transition: background-color 0.2s, color 0.2s, border-color 0.2s; /* Add smooth transitions */
}

.navbar a:hover {
    background-color: #333; /* Change the background color on hover */
    color: #fff; /* Change the text color on hover */
    border-color: #333; /* Change the border color on hover */
}

</style>
<script>
    window.onload = function() {
      if (window.self !== window.top) {
        // Page is loaded within an iframe
        var myList = document.getElementById('hideHome');
        myList.style.display = 'none';
      }
    };
  </script>
</head>

<body>
    <div class="contNav">
        <nav class="navbar">
            <ul>
                <li><a href="../../admin.php" id="hideHome"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="tablelist.php"><span class="glyphicon glyphicon-calendar"></span> Schedule</a></li>
                <li><a href="home.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Schedule</a></li>
                <li><a href="addsubject.php"><span class="glyphicon glyphicon-plus-sign"></span> Subjects</a></li>
                <!-- <li><a href="addfaculty.php"><span class="glyphicon glyphicon-plus-sign"></span> Faculty</a></li> -->
                <!-- <li><a href="addcourse.php"><span class="glyphicon glyphicon-plus-sign"></span> Course</a></li> -->
                <li><a href="addroom.php"><span class="glyphicon glyphicon-asterisk"></span> Room</a></li>
                <!-- <li><a href="addtime.php"><span class="glyphicon glyphicon-time"></span> Time</a></li> -->
                <li><a href="list.php"><span class="glyphicon glyphicon-list"></span> List</a></li>
               
                <!-- <li><a href="Index.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> -->
            </ul>
        </nav>
    </div>
</body>
</html>






<!--  -->
<html>
<head>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        table td {
            text-align: center;
        }
         td{
            position: relative;
            margin: 0;
            padding: 0;
            font-size: 80%;
            
         }
        
         td:nth-child(4){
            font-size:1vw;
            font-weight: 600;
         }

        .editFacName{
            position:absolute;
            top: 0;
            right: 0;
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

        // function sortRowsByStartTime() {
        //     var tableBody = document.querySelector("tbody");
        //     var rows = Array.from(tableBody.getElementsByTagName("tr"));

        //     rows.sort(function(rowA, rowB) {
        //         var startTimeA = rowA.querySelector("td:nth-child(12)").textContent.trim();
        //         var startTimeB = rowB.querySelector("td:nth-child(12)").textContent.trim();

        //         var timeA = new Date("1970/01/01 " + startTimeA);
        //         var timeB = new Date("1970/01/01 " + startTimeB);

        //         return timeA - timeB;
        //     });

        //     rows.forEach(function(row) {
        //         tableBody.appendChild(row);
        //     });
        // }

        var First = document.getElementById("First");
        var Second = document.getElementById("Second");
        var Third = document.getElementById("Third");
        var Fourt = document.getElementById("Fourt");



        First.addEventListener("click", function() {
            filterRowsByYear("First");
        });

        Second.addEventListener("click", function() {
            filterRowsByYear("Second");
        });
        Third.addEventListener("click", function() {
            filterRowsByYear("Third");
        });
        Fourt.addEventListener("click", function() {
            filterRowsByYear("Fourt");
        });



        function filterRowsByYear(yr) {
            var rows = document.querySelectorAll("tbody tr");
            rows.forEach(function(row) {
                var startName = row.querySelector("td:nth-child(3)").textContent.trim();
                var firstyear = startName.startsWith("BSIT 1");
                var secondyear = startName.startsWith("BSIT 2");
                var Thirdyear = startName.startsWith("BSIT 3");
                var Fourtyear = startName.startsWith("BSIT 4");

                if ((yr === "First" && firstyear) || (yr === "Second" && secondyear)|| (yr === "Third" && Thirdyear)|| (yr === "Fourt" && Fourtyear)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        // sortRowsByStartTime();
    });
</script>

</head>

<body>

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

<button type="button" class="btn btn-primary" id="First">1st yr</button>
<button type="button" class="btn btn-primary" id="Second">2nd yr</button>
<button type="button" class="btn btn-primary" id="Third">3rd yr</button>
<button type="button" class="btn btn-primary" id="Fourt">4rt yr</button>

<div  style="position: absolute;top:15%;right:40px;display:none;" >
    <br>
    <a href="home.php"><input type='submit' class='btn btn-success' name='delete' value='Add New Schedule' style="width: 100%;margin:2%;"></a>
</div>

<div align="center">
    <fieldset>
        <legend>Schedule</legend>
        <table class="table table-bordered" style="padding:0;">
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

                // $query = "SELECT * FROM table_sched ";
                $query = "SELECT * FROM table_sched ORDER BY blocks ASC, Start_Time";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['room'] . "</td>";
                    echo "<td>" . $row['faculty'] ."<a href='updateFacName.php?id=". $row['id'] ."' title='Update Faculty Name Record' data-toggle='tooltip' class='editFacName'><span class='glyphicon glyphicon-pencil'></span></a>"."</td>";
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




<!-- Add Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
<?php 
include_once("footer.php");
?>
