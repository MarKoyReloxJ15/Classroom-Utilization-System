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
.logoutDiv{
  position: relative;
  background-color: green;
  height: 1vw;
  margin-bottom: 0;
  
}

.lgout {
 float: right;
 position: absolute;
 font-size: 3vw; 
 right: 0.5;
 padding: 0;
 color: red;
 z-index: 20;
 
  
}

.lgout:hover{
  color: #bc544b;
  cursor: pointer;
  -webkit-transition: color 2s ease-out;
  -moz-transition: color 2s ease-out;
  -o-transition: color 2s ease-out;
  transition:  color 2s ease-out;

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
        /* .lgout {
          top: 0.6%;
        font-size: 200%;
      } */

         


          }
       

@media only screen and (max-width: 400px){
           
      .scholNLogo {
      height: 5%;
    
    }

    .lgout{
      border-radius: 1vw;  
      border:1px solid black;   
      background-color:rgb(255, 0, 0, 0.9);
      color: #1434A4;
      padding: 0.3vw;
    }
          }
       




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
