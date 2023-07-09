
<?php
include('rsuHeader.php');
?>


<html>

<head>
    <title>Options</title>
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

            border-radius: 2vh;
        } */

        /* body {
            position: relative;


        } */

        /* body::before {
            content: "";
            background-image: url(rsuLogo.png);
            width: 90%;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            opacity: 0.2;
            position: absolute;
            top: 20%;
            left: 4.5%;
            right: 0;
            bottom: 0;

        } */

        form {
            
            
            position: relative;
            background-color: rgb(250,248,245,0.4);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            width: 300px;
            padding: 20px;
            border-radius: 5px;
            margin: 0 auto;
            margin-top: 2%;
            text-align: center;
            font-size: 27px;
            /* width: 80%; */
            /* Center align the form content */
        }

        input[type="radio"] {
            margin-bottom: 10px;
            font-weight: bold;
          
        }

        input[type="submit"] {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: darkgreen;
        }
    </style>
</head>

<body>
    <!-- <div class="scholNameCont">
        <div class="scholName">
            <img class="scholNLogo" src="rsuLogo.png">
            <h1>Romblon State University-Cajidiocan Campus</h1>
        </div> -->

    </div>

    <form method="POST" action="redirect.php">
        <h2>Select an option</h2>
        <input type="radio" name="option" value="option1" required> Admin<br>
        <input type="radio" name="option" value="option2" required> Faculty<br>
        <input type="radio" name="option" value="option3" required > Student<br><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>