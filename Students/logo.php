<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style/logo.style.css">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> ayaw pag hilabti masisira buhay mo -->
<style>




</style>
</head>
<body>
  
<div class="logoutDiv"><a href="#"   title="Logout" onclick="logoutConfirmation()"><i id='logoutIcon' class="fas fa-sign-out-alt lgout">Logout</i></a>
</div>

<!-- <a href="#"   title="Logout" onclick="logoutConfirmation()"><i id='logoutIcon' class="fas fa-sign-out-alt lgout" style="color: red;"></i></a> -->

<div class="green-bg">
  <div class="scholName">
    <img class="scholNLogo" src="rsuLogo.png" alt="Hello to the world">
    <h1>Romblon State University</h1> <h1>-Cajidiocan Campus</h1>
    
  </div> 

</div>

<div class="titleSys">
  <h4>Classroom Utilization Management System (I.T. Dep.)</h4>
</div>



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
