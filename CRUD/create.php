<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $acadRank = $advisory = "";
$name_err = $acadRank_err = $advisory_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    //validate academic rank
    $input_acadRank = trim($_POST["acadRank"]);
    if (empty($input_acadRank)) {
        $acadRank_err = "Please enter a academic rank.";
    } elseif (!preg_match("/^[a-zA-Z0-9\s\-_@#$%^&*()]+$/", $input_acadRank)) {
        $acadRank_err = "Please enter a valid acadRank.";
    } else {
        $acadRank = $input_acadRank;
    }


    //validate advisory
    $input_advisory = trim($_POST["advisory"]);
    if (empty($input_advisory)) {
        $advisory_err = "Please enter advisory.";
    } elseif (!preg_match("/^[a-zA-Z0-9\s\-_@#$%^&*()]+$/", $input_advisory)) {
        $advisory_err = "Please enter a valid acadRank.";
    } else {
        $advisory = $input_advisory;
    }


    // Validate email
    // $input_email = trim($_POST["email"]);
    // if (empty($input_email)) {
    //     $email_err = "Please enter an email address.";
    // } elseif (!filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
    //     $email_err = "Please enter a valid email address.";
    // } else {
    //     $email = $input_email;
    // }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($acadRank_err) && empty($advisory_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO it_faculty (Name,Academic_Rank,Advisory) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_acadRank, $param_advisory);

            // Set parameters
            $param_name = $name;
            $param_acadRank = $acadRank;
            $param_advisory = $advisory;
           

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($acadRank_err)) ? 'has-error' : ''; ?>">
                            <label>Academic_Rank</label>
                            <input type="text" name="acadRank" class="form-control" value="<?php echo $acadRank; ?>">
                            <span class="help-block"><?php echo $acadRank_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($advisory_err)) ? 'has-error' : ''; ?>">
                            <label>Advisory</label>
                            <input type="text" name="advisory" class="form-control" value="<?php echo $advisory; ?>">
                            <span class="help-block"><?php echo $advisory_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
