<?php

class Answer
{
    public $text;
    public $is_correct;

    public function __construct($text, $is_correct)
    {
        $this->text = $text;
        $this->is_correct = $is_correct;
    }
}
