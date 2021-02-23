<?php
include ('answerModel.php');

class Question
{
    public $title;
    public $text;
    public $answers;

    public function __construct($title, $text)
    {
        $this->title = $title;
        $this->text = $text;
        $this->answers = [];
    }

    public function addAnswer($answer)
    {
        array_push($this->answers, $answer);
    }

}
