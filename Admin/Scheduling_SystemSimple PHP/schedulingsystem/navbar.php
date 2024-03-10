<?php 
 include_once("header.php");
?>
<style>
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
<html>
<head>
    <link rel="stylesheet" href="style/navbar.style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container contNav">
    <nav class="navbar navbar-horizontal">
        <ul class="nav navbar-nav">
         <li><a href="../../admin.php" id="hideHome"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li ><a href="tablelist.php"><span class="glyphicon glyphicon-calendar"></span> Schedule</a></li>
            <li><a href="home.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Schedule</a></li>
            <li><a href="addsubject.php"><span class="glyphicon glyphicon-plus-sign"></span> Subjects</a></li>
            <!-- <li><a href="addfaculty.php"><span class="glyphicon glyphicon-plus-sign"></span> Faculty</a></li>  -->
            <!-- <li><a href="addcourse.php"><span class="glyphicon glyphicon-plus-sign"></span> Course</a></li> -->
            <li><a href="addroom.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Room</a></li>
            <!-- <li><a href="addtime.php"><span class="glyphicon glyphicon-time"></span> Time</a></li> -->
            <li><a href="list.php"><span class="glyphicon glyphicon-list"></span> List</a></li>
            <li><a href="roomListSchedule.php"><span class="glyphicon glyphicon-list"></span>Room Schedule List</a></li>
            <li><a href="studentList.php"><span class="glyphicon glyphicon-list"></span>Student List</a></li>
           
            <!-- <li><a href="Index.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> -->
        </ul>
    </nav>
   
</div>



</body>
</html>





