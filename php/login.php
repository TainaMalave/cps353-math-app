<?php
// include the db config and create the db connection.
include ('config.php');

// Starts a session to hold/check user login information
session_start();

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

<div class="container">
    <div class="title">
        <h1>Trivia Game</h1>
    </div>

    <div class="sub-title">
        <h3>Can you beat the clock?</h3>
    </div>

    <form action="" method="POST">
        <div class="login-form">
            <div class="username">
                <input name="username" type="text" placeholder="enter username...">
            </div>

            <div class="password">
                <input name="password" type="password" placeholder="enter password...">
            </div>

            <div class="reset-password">
                <a href="#">Forgot Your Password?</a>
            </div>
        </div>
        <button class="login-btn" type="submit">LOGIN</button>
    </form>
    <div class="create-account">
        <a href="register.php">Don't have an account? Sign up!</a>
    </div>
</div>
