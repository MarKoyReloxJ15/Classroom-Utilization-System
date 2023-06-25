<!DOCTYPE html>
<html>
<head>
    <title>Options</title>
    <style>
        body {
            background-color: yellow;
            font-family: Arial, sans-serif;
        }
        
        h2 {
            color: green;
        }
        
        form {
            background-color: white;
            width: 300px;
            padding: 20px;
            border-radius: 5px;
            margin: 0 auto;
            text-align: center; /* Center align the form content */
        }
        
        input[type="radio"] {
            margin-bottom: 10px;
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
    <h2>Select an option</h2>
    <form method="POST" action="redirect.php">
        <input type="radio" name="option" value="option1"> Admin<br>
        <input type="radio" name="option" value="option2"> Faculty<br>
        <input type="radio" name="option" value="option3"> Student<br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
