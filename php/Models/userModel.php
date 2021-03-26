<?php
include ('Model.php');

class User extends Model
{
	
	// Instantiate the title, description and answers publicly so they can be used in other files without have to reinstantiate
    public $id;
    public $username;

    public function __construct($id, $username)
    {
		
		// Set the public variable values for the newly created class
        $this->id = $id;
        $this->username = $username;
    }

    public static function getUserByID($id) {
        $record = static::_getRecord("SELECT * FROM users WHERE id = $id");

        $user = new User($record["id"], $record["username"]);

        return $user;
    }

    public static function getUserByUsername($username) {
        $record = static::_getRecord("SELECT * FROM users WHERE username = '$username'");

        $user = new User($record["id"], $record["username"]);

        return $user;
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
