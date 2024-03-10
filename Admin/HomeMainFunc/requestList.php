<?php
include_once("header.php");
include_once("navbar.php");
?>

<html>
<head>
    <link rel="stylesheet" href="style/requestList.style.css">
<style>

</style>
</head>

<body><br>
<div class="container">
<div class="container-fluid table" style="position: sticky; top: 2px; z-index: 10;">
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
    <?php
    echo "<tr>
            <td>";
    // your database connection
            // $host = "localhost";
            // $username = "root";
            // $password = "";
            // $database = "room_util_sys_db";
        require_once "config.php";

        date_default_timezone_set('Asia/Manila');
    // select database
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Couldn't connect to the database: " . $conn->connect_error);
    }
    date_default_timezone_set('Asia/Manila');
    $currenttimestamp = date("Y-m-d 00:00:00");
    echo $currenttimestamp;
    $query = "SELECT * FROM request_table WHERE day_req = '$currenttimestamp' ORDER BY request_room, req_starttime;";
      
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='container'><table width=''  class='table table-bordered' border='1' >
    <caption><b>Request List</b></caption><thead>
            <tr>
                <th>Name</th>
                <th>Room Requested</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr></thead><tbody>";
           
    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['request_room'] . "</td>";
                        echo "<td>" . date("h:i A", strtotime($row['req_starttime'])) . "</td>";
                        echo "<td>" . date("h:i A", strtotime($row['req_endtime'])) . "</td>";

                        echo "<td>
                                <form class='form-horizontal' method='post' action='" . $_SERVER['PHP_SELF'] . "'>
                                    <input name='id' type='hidden' value='" . $row['id'] . "'>";

                                if ($row['Status'] == 'Approved') {
                                    echo "<div type='submit' class='btn btn-success' name='update' title='Update Record' style='background-color: green;'>" . $row['Status'] . "</div>";
                                } elseif ($row['Status'] == 'Pending') {
                                    echo "<button type='submit' class='btn btn-danger' name='update' title='Update Record' style='background-color: red;'>" . $row['Status'] . "</button>";
                                }
                                echo "</form>
                            </td>";

                            echo "<td>
                            <form class='form-horizontal' method='post' action='" . $_SERVER['PHP_SELF'] . "'>
                                <input name='idofdelete' type='hidden' value='" . $row['id'] . "'>
                                <button type='submit' class='btn btn-danger' name='delete' title=\"Delete Record\"> <span class='glyphicon glyphicon-trash'></span></button>
                            </form>
                        </td>";
                        echo "</tr>";
            }
     echo "</tbody></table></div>";

    // status changer=================================
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = $_POST['id'];
        $deleteQuery = "UPDATE request_table
        SET Status = 'Approved', day_req =  ' $currenttimestamp'
        WHERE id = ?;
        ";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                    alert("Approved");
                    location="requestList.php";
                </script>';
            exit;
        } else {
            echo 'Could not delete row: ' . $conn->error;
        }
    }
//delete record =========================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idofdelete'])) {
    $id = $_POST['idofdelete']; // Corrected to use 'idofdelete'
    $deleteQuery = "DELETE FROM request_table WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo '<script type="text/javascript">
                alert("Schedule Successfully Deleted");
                location="requestList.php";
            </script>';
        exit;
    } else {
        echo 'Could not delete row: ' . $conn->error;
    }
}
    ?>
    </fieldset>
    </form>
</div>
</div>
</div>
</div>



<script>

// for search button

document.addEventListener('DOMContentLoaded', function() {
            function searchInTables(keyword) {
                const tables = document.querySelectorAll('table');
            
                tables.forEach(table => {
                    const rows = table.querySelectorAll('tbody tr');
            
                    rows.forEach(row => {
                        const cells = row.querySelectorAll('td');
            
                        let rowVisible = false;
                        cells.forEach(cell => {
                            if (cell.textContent.includes(keyword)) {
                                rowVisible = true;
                            }
                        });
            
                        if (rowVisible) {
                            row.style.display = ''; // Show the row
                        } else {
                            row.style.display = 'none'; // Hide the row
                        }
                    });
                });
            }
            
            document.getElementById('searchBtn').addEventListener('click', function() {
                const searchInput = document.getElementById('search');
                const keyword = searchInput.value.trim();
            
                if (keyword !== '') {
                    searchInTables(keyword);
                }
            });
            
            document.getElementById('refreshBtn').addEventListener('click', function() {
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    row.style.display = ''; // Show all rows
                });
            });
        });

</script>

</body>
</html>

<?php
//include_once("footer.php");
?>
