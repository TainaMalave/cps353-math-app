<?php
include ('userModel.php');

class Scoreboard extends Model
{
	
	// Instantiate the title, description and answers publicly so they can be used in other files without have to reinstantiate
    public $user;
    public $score;
    public $date;

    public function __construct($user, $score, $date)
    {
		
		// Set the public variable values for the newly created class
        $this->user = $user;
        $this->score = $score;
        $this->date = $date;
    }

    // Grab the top ten users from the database
    public static function getTopTen() {
        // select all from the scoreboard table and order them by their score, but limit it to only 10 users
        $records = static::_getRecords("SELECT * FROM scoreboard ORDER BY score DESC LIMIT 10");

        $models = [];

        // loop through the records var as record and create a new user with id, score and the date
        foreach($records as $record) {
            $model = new Scoreboard(User::getUserByID($record["u_id"]), $record["score"], $record["date"]);
            array_push($models, $model);
        }

        return $models;
    }

    // grab the username from the uer
    public function getName() {
        return @$this->user->username;
    }

    // get the score
    public function getScore() {
        return @$this->score;
    }
}
