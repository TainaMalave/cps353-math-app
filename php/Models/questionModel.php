<?php
include ('answerModel.php');

class Question
{
	
	// Instantiate the title, description and answers publicly so they can be used in other files without have to reinstantiate
    public $title;
    public $text;
    public $answers;

    public function __construct($title, $text)
    {
		
		// Set the public variable values for the newly created class
        $this->title = $title;
        $this->text = $text;
        $this->answers = [];
    }

    public function addAnswer($answer)
    {
		// Pushes the passed in answers to the local answers array
        array_push($this->answers, $answer);
    }

}
