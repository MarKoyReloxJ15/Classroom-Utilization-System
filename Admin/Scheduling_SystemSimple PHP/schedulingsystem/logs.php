<?php
include_once("header.php");
include_once("navbar.php");
?>

<html>
<head>
<style>
body {
    background-image: url();
    background-color: white;
}
th {
    text-align: center;
}
tr {
     height: 30px;
}
td {
    padding-top: 5px;
    padding-left: 20px; 
    padding-bottom: 5px;    
    height: 20px;
}
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

    // select database
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Couldn't connect to the database: " . $conn->connect_error);
    }

    $query = "SELECT * FROM logs ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='container'><table width=''  class='table table-bordered' border='1' >
    <caption><b>Logs</b></caption><thead>
            <tr>
                <th>ID</th>
                <th>User Type</th>
                <th>Name</th>
                <th>Timestamp</th>
            </tr></thead><tbody>";
           
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ID_logs'] . "</td>";
        echo "<td>" . $row['UserType'] . "</td>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['Timestamp'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table></div>";

    // delete record
   
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
include_once("footer.php");
?>
