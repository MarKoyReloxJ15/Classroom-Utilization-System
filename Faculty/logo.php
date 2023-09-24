<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> ayaw pag hilabti masisira buhay mo -->
<style>

   body {
  margin: 0;
  padding: 0;
}

.lgout {
  position: absolute;
  top: 1.6%;
  right: 2%;
  font-size: 500%;
}

.green-bg {
  background-color: green;
  /* padding: 1% 0; */
  position: relative;
}

.scholName {
  display: flex;
  align-items: center;
  padding: 1% 2%;
}

.scholNLogo {

  width: 8%;
  margin-right: 5px;
}


.titleSys {
  background-color: beige;
  text-align: center;
}

.titleSys h4 {
  margin: 0;
   font-size: 2.4vw; 
  
}


.scholName h1 {
  margin: 0;
  font-size: 3.7vw;
  color: white;
  height: 3vh;
  padding-bottom: 7%;
  padding-top: 0;
}

@media only screen and (max-width:800px){
        .lgout {
          top: 0.6%;
        font-size: 200%;
      }

         


          }
       

@media only screen and (max-width: 400px){
           
      .scholNLogo {
      height: 5%;
    
    }
            


          }
       




</style>
</head>
<body>

<div class="green-bg">
  <div class="scholName">
    <img class="scholNLogo" src="rsuLogo.png" alt="Hello to the world">
    <h1>Romblon State University</h1> <h1>-Cajidiocan Campus</h1>
    
  </div>
 

</div>

<div class="titleSys">
  <h4>Classroom Utilization Management System (I.T. Dep.)</h4>
</div>


<a href="#"   title="Logout" onclick="logoutConfirmation()"><i id='logoutIcon' class="fas fa-sign-out-alt lgout" style="color: red;"></i></a>


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
