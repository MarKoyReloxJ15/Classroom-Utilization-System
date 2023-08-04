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
    <body>
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

    $query = "SELECT * FROM rooms";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='container'><table width='' class='table table-bordered' border='1' >
            <tr>
                <th>Rooms</th>
                <th>Action</th>
            </tr>";
         
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['room'] . "</td>";
        echo "<td>
                <form class='form-horizontal' method='post' action='roomlist.php'>
                    <input name='id' type='hidden' value='" . $row['id'] . "'>
                    <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                </form>
            </td>";
        echo "</tr>";
    }
    echo "</table></div>";

    // delete record
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = $_POST['id'];
        $deleteQuery = "DELETE FROM rooms WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                    alert("Row Successfully Deleted");
                    location="roomlist.php";
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
</body>
</html>

<?php
include_once("footer.php");
?>
