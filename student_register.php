

<?php
require_once "config.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $block = $_POST["blocks"];
    $studentID = $_POST["studentID"];
    $email = $_POST["email"];
    $password = $_POST["password"];

   
        // Create a new PDO instance
        // $pdo = new PDO("mysql:host=DB_SERVER;dbname=DB_NAME", DB_USERNAME, DB_PASSWORD);
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

        // Check if the name exists in the other table
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM exprimental_studentlist WHERE name = ?");
        $stmt->execute([$name]);
        $existingNameCount = $stmt->fetchColumn();
    
        // Check if the name already has a password in the student table
        $stmt = $pdo->prepare("SELECT password FROM student WHERE student_name = ?");
        $stmt->execute([$name]);
        $existingPassword = $stmt->fetchColumn();
    
        if ($existingNameCount > 0 && !empty($existingPassword)) {
            // Name exists in the other table and already has a password, disallow data insertion
            echo "<script>alert('You are not allowed to insert data!');</script>";
        } elseif ($existingNameCount > 0) {
            // Name exists in the other table, but doesn't have a password yet
    
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $hashedStudentID = password_hash($studentID, PASSWORD_DEFAULT);
    
            // Prepare and execute the INSERT statement
            $stmt = $pdo->prepare("INSERT INTO student (student_name, blocks, password, studentID,email) VALUES (?, ?, ?,?,?)");
            $stmt->execute([$name, $block, $hashedPassword, $hashedStudentID,  $email]);
    
            // Check if the insertion was successful
            if ($stmt->rowCount() > 0) {
                echo "<script>window.location.href = 'studentLogin.php?success=1';</script>";
            } else {
                echo "<script>alert('Registration Failed!');</script>";
            }
        } else {
            // Name doesn't exist in the other table
            echo "<script>alert('Name not found in the other table!');</script>";
        }
    }
    
?>



<?php
include('rsuHeader.php');

?>


<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        

        h2 {
            text-align: center;
            color: #333;
        }

        .container{
           
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            /* background-color: rgba(255, 255, 255, 0.1); */
          
            width: 300px;
            position: relative;
            margin: 0 auto;
            margin-top: 2%;
            
            /* width: 80%; */
            background-color: rgb(250,248,245,0.4);
        }

        select {
            width: 90%;
            padding: 10px;
            box-sizing:content-box;
            border: 2px solid black;
      border-radius: 10px;
            /* border: 1px solid #ccc;
            border-radius: 4px; */
           
        }

        select option {
            padding: 5px;
           
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        button {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            border: 2px solid black;
      border-radius: 10px;
            /* border: 1px solid #ccc;
            border-radius: 4px; */
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .password-toggle {
  float: right;
   
}

.password-toggle:hover {
    color: #333;
}

/* =========================================== */

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  max-height: 150px;
  overflow-y: auto;
  z-index: 999; /* Set a high z-index value */
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/* When hovering an item: */
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/* When navigating through the items using the arrow keys: */
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}

    </style>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- <script type="text/javascript" src="frontend-script.js"></script> -->
</head>

<body>
    <!-- <div class="scholNameCont">
        <div class="scholName">
            <img class="scholNLogo" src="rsuLogo.png">
            <h1>Romblon State University-Cajidiocan Campus</h1>
        </div> -->

    </div>

    <form method="POST" action="student_register.php">
        <h2>Student Registration Form </h2>
        <label for="name">Name:</label>
        <div class="autocomplete" style="width:300px;">
        <input type="text" id="name" name="name" autocomplete="off" required>
        </div><br>

        <label for="studentID">Student ID:</label>        
        <input type="text" id="" name="studentID" required><br><br>

        <label for="email">Email :</label>        
        <input type="text" id="" name="email" required><br><br>
        

        <label for="blocks">Block:</label>
        <select name="blocks" id="name" class="form-control">

            <?php
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            if (!$connection) {
                die('Connection failed: ' . mysqli_connect_error());
            }

            $query = "SELECT Name FROM blocks_detail ORDER BY Name";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die('Query failed: ' . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
            }

            mysqli_close($connection);
            ?>
            <option value="Irregular">Irregular</option>
        </select>

      <br><br>


        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="checkbox" onclick="myFunction()">Show Password <br><br>

        <input type="submit" value="Register">
        <a href="studentLogin.php">
            <button type="button">Back</button>
        </a>
    </form>


   


    <script>


function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

    </script>




<script>

function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}


var countries = <?php
            $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT Name FROM exprimental_studentlist"; // Modify your SQL query as needed
            $result = $conn->query($sql);

            $nameArray = array(); // Initialize an array to store data

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nameArray[] = $row['Name'];
                }
                echo json_encode($nameArray); // Output as JSON
            } else {
                echo '[]'; // Output an empty JSON array if no results found
            }

            $conn->close();
        ?>;
        

// it is a last minute edit countries should be name should be name Name of student. 

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("name"), countries);
</script>
</body>

</html>



