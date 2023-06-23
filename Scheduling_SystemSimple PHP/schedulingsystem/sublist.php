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

    $query = "SELECT * FROM subject";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='container'><table width='' class='table table-bordered' border='1' >
            <tr>
                <th>Code</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['subject_code'] . "</td>";
        echo "<td>" . $row['subject_description'] . "</td>";
        echo "<td>
                <form class='form-horizontal' method='post' action='sublist.php'>
                    <input name='subject_id' type='hidden' value='" . $row['subject_id'] . "'>
                    <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                </form>
            </td>";
        echo "</tr>";
    }
    echo "</table></div>";

    // delete record
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject_id'])) {
        $subject_id = $_POST['subject_id'];
        $deleteQuery = "DELETE FROM subject WHERE subject_id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $subject_id);
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
include_once("footer.php");
?>
