<?php

class Answer
{
	
	// Instantiate the title and the is correct boolean publicly so they can be used in other files without have to reinstantiate
    public $text;
    public $is_correct;

    public function __construct($text, $is_correct)
    {
		// Set the public variable values for the newly created class
        $this->text = $text;
        $this->is_correct = $is_correct;
    }
}
