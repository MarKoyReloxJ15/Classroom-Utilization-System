<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

    .lgout{
      position: absolute;
      top: 2%;
      right: 0;
    }
  .green-bg {
  background-color: green;
  /* margin-left: 5%;
  margin-right: 5%;
  width: 90%; 
  margin-top: 1.5%;
   border-radius: 2vh;
  margin-bottom: 2%; */
}

.scholName {
  height: 10vh; /* Set the height to 10% of the viewport height */
  display: flex;
  justify-content: center;
  align-items: center;
}

.scholNLogo {
  height: 50px; /* Adjust the height as needed */
  margin-right: 5px; /* Add some spacing between the image and text */
}

.rsh1 {
  margin-bottom: 0; /* Remove any bottom margin */
  font-size: 22px; /* Default font size */
  color: white;
}

/* Media queries for responsive font sizes */
@media screen and (max-width: 576px) {
  .rsh1 {
    font-size: 17px; /* Adjust the font size for screens up to 576px */
  }
}

@media screen and (max-width: 400px) {
  .rsh1 {
    font-size: 15px; /* Adjust the font size for screens up to 400px */
  }
}

@media screen and (max-width: 300px) {
 .rsh1 {
    font-size: 12px; /* Adjust the font size for screens up to 300px */
  }
}


    </style>

</head>
<body>
    

<div class="container-fluid green-bg">
  <div class="row justify-content-center">
    <div class="col-sm-12 col-md-6 scholNameCont">
      <div class="scholName d-flex align-items-center">
        <img class="scholNLogo" src="rsuLogo.png" alt="Hello to the world">
        <h1 class="ml-3 mb-0 font-size-responsive rsh1">Romblon State University-Cajidiocan Campus </h1> 
      </div>
    </div>
   
  </div>

 
</div>

<a href="../index.php" title="Logout"><i class="fa fa-sign-out lgout" style="font-size:6vh;color:red"></i></a>




</body>
</html>