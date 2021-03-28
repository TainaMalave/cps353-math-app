<?php
// include the db config and create the db connection.
include ('config.php');

// Instantiates a new DB class (See config.php)
$test = new DB();

// Checks to see if the login form submission button was clicked, and if so, continue
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	/* 
		Instantiates and sets the username and password. 
		mysqli_real_escape_string escapes special characters in a string for use in an SQL statement (Helps prevent sql injection attacks)
		md5 hashes the password so when stored does not contain any plain text passwords for security
	*/
    $username = mysqli_real_escape_string($test->connection, $_POST['username']);
    $password = md5(mysqli_real_escape_string($test->connection, $_POST['password']));

	// SQL that selects the ids from users where the username is equal to the escaped username and the password matches the md5 hash
    $sql = 'SELECT id FROM users WHERE username = "' . $username . '" AND password = "' . $password . '"';
	
	// Run the above sql with the db class connection
    $result = mysqli_query($test->connection, $sql);
	
	// Get the number of rows from the sql result
    $count = mysqli_num_rows($result);

	// If the sql returns a SINGLE record (we only want to know if one user came back. If more did, theres duplicate data), then continue logging in
    if ($count == 1)
    {
		// Sets the session variable "login_user" to the escaped username
        $_SESSION['login_user'] = $username;
		
		// Redirects the user to the actual game
        header('location: game.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Study | Login</title>

    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Whole wrapper -->
    <div class="info-box">
        <div class="info-title">
            <span>Smart Study</span>
        </div>
        <!-- Login Page Form -->
        <div class="form-container">
            <form action="" method="POST">
                <div class="login-form-info">
                    <div class="form-instructions">
                        <span>Login To Your Account.</span>
                    </div>
                    <div class="username">
                        <input name="username" type="text" placeholder="enter username...">
                    </div>

                    <div class="password">
                        <input name="password" type="password" placeholder="enter password...">
                    </div>
                </div>

                <!-- Link to Reset Password. -->
                <div class="reset-password">
                    <a href="#">Forget Your Password?</a>
                </div>

                <!-- Login to account -->
                <div id="login-pg-btn" class="buttons">
                    <button class="login" type="submit">LOGIN</button>
                </div>

                <!-- <div class="create-account">
                    <a href="register.php">Don't have an account? Sign up!</a>
                </div> -->
            </form>
        </div>
    </div>  
</body>
</html>
