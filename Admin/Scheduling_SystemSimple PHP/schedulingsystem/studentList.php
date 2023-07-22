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

 $query = "SELECT * FROM exprimental_studentlist";
 $stmt = $conn->prepare($query);
 $stmt->execute();
 $result = $stmt->get_result();


// delete record
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $deleteQuery = "DELETE FROM exprimental_studentlist WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // echo '<script type="text/javascript">
        //         alert("Row Successfully Deleted");
        //         location="studentList.php";
        //       </script>';

       // exit;
       header("Location: studentList.php");
        exit;
    } else {
        echo 'Could not delete row: ' . $conn->error;
    }
}

?>

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
<button style="float: right; background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 4px;">
  <a href="addStudent.php" style="text-decoration: none; color: inherit;">Add Student</a>
</button>

    <body>
    <?php
    echo "<tr>
            <td>";
   
    echo "<div class='container'><table width='' class='table table-bordered' border='1' >
             <caption><h2>List of student</h2></caption>
            <tr>
                <th>Student</th>
                <th>Action</th>
            </tr>";
         
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>
                <form class='form-horizontal' method='post' action='studentList.php'>
                    <input name='id' type='hidden' value='" . $row['id'] . "'>
                    <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                </form>
            </td>";
        echo "</tr>";
    }
    echo "</table></div>";

    
    ?>
    </fieldset>
    </form>
</div>
</div>
</div>
</div>

<?php
include_once("registerStudent.php");
?>



<body>
   
</body>
</html> 
<?php
include_once("footer.php");
?>


