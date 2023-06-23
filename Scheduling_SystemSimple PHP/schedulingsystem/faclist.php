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
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "insertion";

    // select database
    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("Couldn't connect to the database: " . $conn->connect_error);
    }

    $query = "SELECT * FROM faculty";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='container'><table width='' class='table table-bordered' border='1' >
            <tr>
                <th>Faculty</th>
                <th>Designation</th>
                <th>Action</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['faculty_name'] . "</td>";
        echo "<td>" . $row['designation'] . "</td>";
        echo "<td>
                <form class='form-horizontal' method='post' action='faclist.php'>
                    <input name='faculty_id' type='hidden' value='" . $row['faculty_id'] . "'>
                    <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                </form>
            </td>";
        echo "</tr>";
    }
    echo "</table></div>";

    // delete record
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['faculty_id'])) {
        $faculty_id = $_POST['faculty_id'];
        $deleteQuery = "DELETE FROM faculty WHERE faculty_id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $faculty_id);
        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                    alert("Row Successfully Deleted");
                    location="list.php";
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
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "footer.php";
include_once("footer.php");
?>
