
<?php
 require_once "config.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection parameters
            // $servername = "localhost";
            // $username_db = "root";
            // $password_db = "";
            // $dbname = "room_util_sys_db";
    
     //       DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME
    // Create a new PDO instance
    // $pdo = new PDO("mysql:host=DB_SERVER;dbname=DB_NAME", DB_USERNAME, DB_PASSWORD);

    date_default_timezone_set('Asia/Manila');
$currentTimestamp = time();
$dateInPhilippines = date('Y-m-d H:i:s', $currentTimestamp);

$userType = 'Student';
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    
    // Prepare and execute the SELECT statement
    $stmt = $pdo->prepare("SELECT * FROM student WHERE student_name = ?");
    $stmt->execute([$username]);

    // Check if a matching user is found
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (password_verify($password, $user['password'])) {
            // Password is correct
            $dateInPhilippines = date('Y-m-d H:i:s'); // Get the current timestamp in 'Y-m-d H:i:s' format
    
            // Corrected the SQL query with placeholders
            $insertStmt = $pdo->prepare("INSERT INTO logs (UserType, Name, TimeStamp) VALUES (?, ?, ?)");
            $insertStmt->execute([$userType, $username, $dateInPhilippines]);
    
            if ($insertStmt->rowCount() > 0) {
                $_SESSION['message'] = "Registration successful. Data inserted into the database.";
            } else {
                $_SESSION['message'] = "Error: Unable to insert data into the logs table.";
            }
    
            // Close the prepared statement
            $insertStmt = null;
    
            // Redirect to the desired location after successful login
            header("Location: Students/HomeTableMainFunc.php");
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Failed Login')</script>";
        }
    } else {
        // User not found
        echo "<script>alert('User not found.')</script>";
    }

    // Close the database connection
    $pdo = null;
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
        /* .scholNLogo {
            position: relative;
            width: 8%;
            height: 70%;
            margin-right: 10px;
        }

        .scholName {
            position: relative;
            height: 100%;
            background-color: #00AF50;
            border-radius: 1px;
            border: 1px solid #41719C;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        body {
            position: relative;
        } */

            /* body::before {
                content: "";
                background-image: url(rsuLogo.png);
                width: 90%;
                background-repeat: no-repeat;
                background-size: contain;
                background-position: center;
                opacity: 0.1;
                position: absolute;
                top: 5%;
                left: 4.5%;
                right: 0;
                bottom: 0;
            } */

            .login-container {
    position: relative;
    background-color: rgba(255, 255, 255, 0.6);
    border-radius: 4px;
    margin: 100px auto;
    max-width: 300px;
    padding: 10px;
    top: -80px;
}

h2 {
    text-align: center;
}

form {
    position: relative;
    display: flex;
    flex-direction: column;
}

input[type="text"],
input[type="password"] {
    width: 90%;
    margin-bottom: 10px;
    padding: 10px;
    border: 2px solid black;
    border-radius: 10px;
}

button {
    background-color: green;
    border: none;
    color: white;
    cursor: pointer;
    padding: 10px;
}

button:hover {
    background-color: black;
}

.error {
    color: red;
    margin-top: 10px;
    text-align: center;
}

.c-button {
    background-color: blue;
}

.password-container {
    position: relative;
    width: 100%;
}

.password-toggle {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #777;
    font-size: 16px; /* Adjust the font size as needed */
}

.password-toggle:hover {
    color: #333;
}
input[type="password"] {
    width: calc(100% - 30px); /* Subtract the space for the toggle icon */
    padding-right: 10px; /* Adjust padding for better appearance */
}

/* ================================================ */


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
</head>

<body>
    <!-- <div class="scholNameCont">
        <div class="scholName">
            <img class="scholNLogo" src="rsuLogo.png" alt="RSU Logo">
            <h1>Romblon State University-Cajidiocan Campus</h1>
        </div>
    </div> -->
    <div class="login-container">
        <h2>Student Login</h2>
        <form action="studentLogin.php" method="POST">

        <div class="autocomplete" style="width:300px;">
        <input type="text" name="username"  id='username' autocomplete="off" placeholder="Username" required>
        </div>


        <div class="password-container">
            <input type="password" name="password" placeholder="Password" required id="passwordField"><br>
            <input type="checkbox" onclick="myFunction()">Show Password <br><br>
        </div>

        <button type="submit">Login</button>
        <br>
        <button type="button" onclick="location.href='student_register.php'" class="c-button">Create Account</button><br>
        <a href="studentForgetPassword.php" style="text-align:center;">Forgot Password?</a>
        </form>
    </div>


    <script>
 function myFunction() {
  var x = document.getElementById("passwordField");
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
autocomplete(document.getElementById("username"), countries);
</script>
</body>

</html>

</html> 

