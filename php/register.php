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
    $email = $_POST['email'];
    $password = md5(mysqli_real_escape_string($db->connection, $_POST['password']));
    $isTeacher = $_POST['teacherOrStudent'] == "teacher" ? 1 : 0;
    $picture = $_FILES["fileToUpload"]["tmp_name"];
    $pictureName = rand().".png";
    move_uploaded_file($picture, __DIR__."/../user_pics/".$pictureName);
	
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
        $sql = 'INSERT INTO users (username, email, password, is_teacher, picture) VALUES ("' . $username . '","' . $email . '", "' . $password . '",  '. $isTeacher . ',"' . $pictureName . '")';
		// Run the above query
        $result = mysqli_query($db->connection, $sql);
		
		//If there is an error creating the account, then print out the error
		if($db->connection->error) {
			die($db->connection->error);
		}
        
		// Sets the session variable "login_user" to the escaped username
		$_SESSION['login_user'] = $username;

        // If name doesn't exist, login the user and take them to their profiles based on teacher or student.
        header('location: '. ($isTeacher ? "teacherProfile.php" : "studentProfile.php"));
    }
    else // otherwise
    {
		// Print out that the username already exists and instruct them to choose a new username
       /*  echo 'That username already exists. Please try a different username'; */
        $accountExists = 'That username already exists. Please try a different username';
        echo "<p style='color:white;'>" . $accountExists . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Study | Register</title>

    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Whole wrapper -->
    <div class="info-box">
        <div class="info-title">
            <span>Smart Study</span>
        </div>
        <!-- Register Page Form -->
        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="register-form-info">
                    <div class="form-instructions">
                        <span>Please fill out the information to create an account.</span>
                    </div>
                    <div class="username">
                        <input name="username" type="text" placeholder="enter username...">
                    </div>

                    <div class="email">
                        <input name="email" type="text" placeholder="enter email...">
                    </div>

                    <div class="password">
                        <input name="password" type="password" placeholder="enter password...">
                    </div>

                    <div class="teacherOrStudent">
                        <label for="teacher">Teacher</label>
                        <input type="radio" name="teacherOrStudent" value="teacher" checked>
                        <label for="student">Student</label>
                        <input type="radio" name="teacherOrStudent" value="student">
                    </div>

                    <div class="uploadPicture">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                </div>

                <!-- Register Button -->
                <div id="register-pg-btn" class="buttons">
                    <button class="register" type="submit">REGISTER</button>
                </div>

                <!-- Link to Login page. -->
                <div class="login-page-link">
                    <a href="login.php">Already have an account? <span>Login!</span></a>
                </div>
            </form>
        </div>
    </div>  
</body>
</html>