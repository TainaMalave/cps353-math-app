<?php
include ('Model.php');

class User extends Model
{
	
	// Instantiate the title, description and answers publicly so they can be used in other files without have to reinstantiate
    public $id;
    public $username;
    public $picture;

    public function __construct($id, $username, $picture)
    {
		
		// Set the public variable values for the newly created class
        $this->id = $id;
        $this->username = $username;
        $this->picture = $picture;
    }

    // A function to get the user by their id. Requires an id parameter
    public static function getUserByID($id) {
        // Call get record function and select all from the users table where the id matches the parameter. 
        $record = static::_getRecord("SELECT * FROM users WHERE id = $id");

         // create a new user object and store it in the user variable
        $user = new User($record["id"], $record["username"], $record["picture"]);

        return $user;
    }

    // get a user by their username.
    public static function getUserByUsername($username) {
        // call get record and select all from the users table where the username matches the  username given
        $record = static::_getRecord("SELECT * FROM users WHERE username = '$username'");

        // create a new user object and store it in the user variable
        $user = new User($record["id"], $record["username"], $record["picture"]);

        return $user;
    }

    // A function to get information on the teacher
    public static function getTeacherInfos() { 
        // call get records but this time, look for the all users from the user table where is_teacher is set to 1
        $records = static::_getRecords("SELECT * FROM users WHERE is_teacher = 1");
        return $records;
    }

    /* Student Functions */
    public static function getStudentInfos() { 
        // get the students info. Call get records and then select all the users where is_teacher is set to 0
        $records = static::_getRecords("SELECT * FROM users WHERE is_teacher = 0");
        return $records;
    }

    public static function getStudentCount() {
        // create a variable called student_count and get the count from the users table where is_teacher is 0 
        $record = static::_getRecord("SELECT COUNT(1) AS student_count FROM users WHERE is_teacher = 0");

        // this will return the number of students in the database.
        return $record["student_count"];
    }

    public static function getStudentAverages() {
        // Grabing all of the scores from the students and calculating their scores and averages
        $records = static::_getRecords("SELECT SUM(score)/COUNT(1) AS student_avg,users.username,users.id,users.email FROM scoreboard LEFT JOIN users ON scoreboard.u_id = users.id GROUP BY u_id");
        return $records;
    }

    public static function getStudentAverage($id) {
        // grab the scores from a particular user based on their id and then calculate that student's average.
        $record = static::_getRecord("SELECT SUM(score)/COUNT(1) AS student_avg,users.id FROM scoreboard LEFT JOIN users ON scoreboard.u_id = users.id WHERE users.id = $id GROUP BY u_id");
        return $record["student_avg"];
    }

    public static function getClassAverage() {
        /* 
            Get the sum from all of the users in scoreboard and calculate the total average and then return it as student_avg.
            This is how the class average is calculated
        */
        $record = static::_getRecord("SELECT SUM(score)/COUNT(1) AS student_avg FROM scoreboard");

        return $record["student_avg"];
    }

    public static function getCurrentUser() {
        // get the current user that is logged in
        return static::getUserByUsername($_SESSION['login_user']);
    }

    // calculate the score of the user
    public function addScore($correct, $wrong) {
        // add the number of correct and wrong together and store it as total
        $total = $correct + $wrong;
        // take the number correct and divide it by the total and then multiply it by 100
        $score = ($correct/$total) * 100;

        // run query function to insert the scores into the scoreboard table 
        static::runQuery("INSERT INTO scoreboard (u_id, score) VALUES ($this->id, $score)");
    }
}
