<?php
// Initialize the session. 
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ //loggedin is set later on in the script, this is just a check to see if user has logged in already
    header("location: welcome.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = '';

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your username.";
    } else {
        $username = (trim($_POST["username"]));
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    if($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $param_username);

        // Set parameters
        $param_username = $username;

        // Attempt to execute prepared statement
        if($stmt->execute()){
        $stmt->store_result();
        
        // Check if username exists, if yes then verify password
            if($stmt->num_rows ==1){
           // Bind result variables
            $stmt->bind_result($id, $username, $hashed_password);
            if($stmt->fetch()){
                if(password_verify($password, $hashed_password)){
            // Password is correct, so start a new session
                session_start();
            // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;
                    
            // Redirect user to welcome page
            header("location: welcome.php");
                } else {
                // Display an error message if password is not valid
                $password_err = "The password you entered was not valid.";
                }
            }
            } else {
            // Display an error message if username doesn't exist
            $username_err = "No account found with that username.";   
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
        // Close statement
        $stmt->close();
    }
    $mysqli->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; margin:0 auto; }
    </style>
</head>
<body>
    <div class="sub-page">
<div class="navcontainer">
        <nav>
            <a href="login.php">Log in</a>
            <a href="register.php">Register</a>
            <a class="site-logo" href="index.php"><span class="logo"></span>MarketPlace</span></a>
        </nav>
    </div>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
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
        </div>
</body>
</html>