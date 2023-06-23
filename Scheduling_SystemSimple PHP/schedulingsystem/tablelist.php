<?php
include_once("header.php");

?>

<html>
<head>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

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
        });
    </script>
</head>

<body><br>

<div class="container-fluid">
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

<div align="center">
    <fieldset>
        <legend>Schedule</legend>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Faculty</th>
                    <th>Course</th>
                    <th>Subject</th>
                    <th>Day</th>
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
                $database = "insertion";

                // select database
                $conn = new mysqli($host, $username, $password, $database);
                if ($conn->connect_error) {
                    die("Couldn't connect to the database: " . $conn->connect_error);
                }

                $query = "SELECT * FROM addtable";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['room'] . "</td>";
                    echo "<td>" . $row['faculty'] . "</td>";
                    echo "<td>" . $row['course'] . "</td>";
                    echo "<td>" . $row['subject'] . "</td>";
                    echo "<td>" . $row['weekDays'] . "</td>";
                    echo "<td>" . $row['Start_Time'] . "</td>";
                    echo "<td>" . $row['End_Time'] . "</td>";
                    echo "<td>
                            <form class='form-horizontal' method='post' action='" . $_SERVER['PHP_SELF'] . "'>
                                <input name='id' type='hidden' value='" . $row['id'] . "'>
                                <button type='submit' class='btn btn-danger' name='delete'>Delete</button>
                            </form>
                        </td>";
                    echo "</tr>";
                }

                // delete record
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $deleteQuery = "DELETE FROM addtable WHERE id = ?";
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

<div align="center">
    <br>
    <a href="home.php"><input type='submit' class='btn btn-success' name='delete' value='New'></a>
    <a href="Index.php"><input type='submit' class='btn btn-primary' name='delete' value='Logout'></a>
</div>

<?php
include_once("navbar.php");
?>

<!-- Add Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
