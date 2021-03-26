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

    public static function getTopTen() {
        $records = static::_getRecords("SELECT * FROM scoreboard ORDER BY score DESC LIMIT 10");

        $models = [];

        foreach($records as $record) {
            $model = new Scoreboard(User::getUserByID($record["u_id"]), $record["score"], $record["date"]);
            array_push($models, $model);
        }

        return $models;
    }

    public function getName() {
        return @$this->user->username;
    }

    public function getScore() {
        return @$this->score;
    }


}
