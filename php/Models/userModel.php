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

    public static function getUserByID($id) {
        $record = static::_getRecord("SELECT * FROM users WHERE id = $id");

        $user = new User($record["id"], $record["username"], $record["picture"]);

        return $user;
    }

    public static function getUserByUsername($username) {
        $record = static::_getRecord("SELECT * FROM users WHERE username = '$username'");

        $user = new User($record["id"], $record["username"], $record["picture"]);

        return $user;
    }

    public static function getTeacherInfos() { 
        $records = static::_getRecords("SELECT * FROM users WHERE is_teacher = 1");
        return $records;
    }

    /* Student Functions */
    public static function getStudentInfos() { 
        $records = static::_getRecords("SELECT * FROM users WHERE is_teacher = 0");
        return $records;
    }

    public static function getStudentCount() {
        $record = static::_getRecord("SELECT COUNT(1) AS student_count FROM users WHERE is_teacher = 0");

        return $record["student_count"];
    }

    public static function getStudentAverages() {
        $records = static::_getRecords("SELECT SUM(score)/COUNT(1) AS student_avg,users.username,users.id,users.email FROM scoreboard LEFT JOIN users ON scoreboard.u_id = users.id GROUP BY u_id");

        return $records;
    }

    public static function getClassAverage() {
        $record = static::_getRecord("SELECT SUM(score)/COUNT(1) AS student_avg FROM scoreboard");

        return $record["student_avg"];
    }

    public static function getCurrentUser() {
        return static::getUserByUsername($_SESSION['login_user']);
    }

    public function addScore($correct, $wrong) {
        $total = $correct + $wrong;
        $score = ($correct/$total) * 100;

        static::runQuery("INSERT INTO scoreboard (u_id, score) VALUES ($this->id, $score)");
    }
}
