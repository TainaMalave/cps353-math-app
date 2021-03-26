<?php
// include the db config and create the db connection.
include ('config.php');

// Instantiates a new DB class (See config.php)
$db = new DB();

// Checks to see if the register form submission button was clicked, and if so, continue
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		/* 
		Instantiates and sets the username and password. 
		mysqli_real_escape_string escapes special characters in a string for use in an SQL statement (Helps prevent sql injection attacks)
		md5 hashes the password so when stored does not contain any plain text passwords for security
	*/
    $username = mysqli_real_escape_string($db->connection, $_POST['username']);
    $password = md5(mysqli_real_escape_string($db->connection, $_POST['password']));
	
	/*
		Selects the count (just the number of rows) as the name "count" from the users where the username is equal to the escaped string above
		
		Looking for a 0 from this query
	*/
    $checkSql = 'SELECT COUNT(*) AS count FROM users WHERE username = "' . $username . '"';
	
	// Runs the above sql query
    $checkResult = mysqli_query($db->connection, $checkSql);
	
	/* 
		Gets an array of values from the result
		mysqli_num_rows was not used here since we arent looking
		for just the number of rows but only the first and only 
		value in the array. 
	*/
    $count = mysqli_fetch_array($checkResult);

    // Gets the first value in the count array and checking to see if the username exists already. If no results exist, then continue
    if ($count[0] == 0)
    {
		
		// Inserts the new user with the escaped username and hashed password into the database
        $sql = 'INSERT INTO users (username, password) VALUES ("' . $username . '", "' . $password . '")';
		
		// Run the above query
        $result = mysqli_query($db->connection, $sql);
		
		//If there is an error creating the account, then print out the error
		if($db->connection->error) {
			die($db->connection->error);
		}
        
		// Sets the session variable "login_user" to the escaped username
		$_SESSION['login_user'] = $username;

        // If name doesn't exist, login the user and take them to the game
        header('location: game.php');
    }
    else // otherwise
    {
		// Print out that the username already exists and instruct them to choose a new username
        echo 'That username already exists. Please try a different username';
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
        <div class="register-form">
            <div class="username">
                <label for="username">Enter a Username</label>
                <input name="username" type="text" placeholder="enter username...">
            </div>

            <div class="password">
                <label for="password">Enter a passward</label>
                <input name="password" type="password" placeholder="enter password...">
            </div>
        </div>
        <button class="register-btn" type="submit">REGISTER</button>
    </form>
    <div class="login-page">
        <a href="login.php">Already have an account? Login!</a>
    </div>
</div>
