<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> ayaw pag hilabti masisira buhay mo -->
<style>
   body {
  margin: 0;
  padding: 0;
}

.lgout {
  position: absolute;
  top: 3%;
  right: 2%;
  font-size: 4vw;
}

.green-bg {
  background-color: green;
  /* padding: 1% 0; */
}

.scholName {
  display: flex;
  align-items: center;
  padding: 1% 2%;
}

.scholNLogo {
  height: 9.5vh;
  margin-right: 5px;
}


.titleSys {
  background-color: beige;
  text-align: center;
}

.titleSys h4 {
  margin: 0;
  /* font-size: 3.7vw; */
  
}


.scholName h1 {
  margin: 0;
  font-size: 3.5vw;
  color: white;
  height: 3vh;
  padding-bottom: 5%;
}






</style>
</head>
<body>

<div class="green-bg">
  <div class="scholName">
    <img class="scholNLogo" src="rsuLogo.png" alt="Hello to the world">
    <h1>Romblon State University-Cajidiocan Campus</h1> 
  </div>
</div>

<div class="titleSys">
  <h4>Classroom Utilization Management System</h4>
</div>

<a href="#" title="Logout" onclick="logoutConfirmation()"><i class="fas fa-sign-out-alt lgout" style="color: red;"></i></a>



<script>

function logoutConfirmation() {
  var result = confirm("Are you sure you want to log out?");
  if (result) {
    // The user clicked "OK" (Yes) - Add your logout logic here
    // alert("Logging out..."); // Optional alert for demonstration purposes
    // Perform the logout action, e.g., redirect to logout.php or clear session data
    window.location.href = "../index.php"; // Replace with the URL for logout action
  } else {
    // The user clicked "Cancel" (No) - No specific action is taken in this case
  }
}
</script>
</body>
</html>
