<?php
// Initialize the session. 
session_start();
 
// Check if the user is logged in, if not then redirect him to welcome page. This way only logged in users can post adverts
if($_SESSION["loggedin"] !== true){ 
    header("location: login.php");
    exit;
}

$name = $price = "";
$name_err = $price_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate item name
        if(empty(trim($_POST["name"]))){
            $name_err = "Name entry cannot be blank.";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>registration form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; margin:0 auto ;}
    </style>
</head>
<body>

    <div class="navcontainer">
        <nav>
            <a href="login.php">Log in</a>
            <a href="register.php">Register</a>
            <a class="site-logo" href="index.php"><span class="logo"></span>MarketPlace</span></a>
        </nav>
    </div>
    <div class="wrapper">
        <h2>Place your advertisement</h2>
        <p>Fill in your advertisement specifications here</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> <!-- $_server php_self means that the user stays on the registration page rather'
    than get redirected. Added benefit of this is that you can display errors on the page itself. -->
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>"> <!-- Example of where an error message would display,  -->
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Price</label>
                <input type="number" name="price" class="form-control" value="<?php echo $price; ?>">
                <span class="help-block"><?php echo $price_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
    <footer class="sub-footer">
            <a href="#">About</a>
            <a href="#">Our team</a>
            <a href="#">Work with us</a>
            <a href="#">Become a partner</a>
            <a href="#">F.A.Q.</a>
            <a href="#">Contact us</a>
        </footer>  
</body>
</html>