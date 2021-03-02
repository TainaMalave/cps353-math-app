<?php
include ('models/questionModel.php');

class DB
{
	/* Instantiate SQL connection variables and set them as protected so they stay local
		to the class. Connection is public so it can be used in other files.
	*/
    protected $host = 'localhost';
    protected $dbname = 'trivia-game';
    protected $username = 'root';
    protected $password = '';
    public $connection;

    public function __construct()
    {
		// Set the public connection variable to the new mysql connection
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
    }

    public function getQuestions()
    {
		//Create a questions array
        $questions = [];
		
		/*
			Selects all questions with their respective answers by their relational ids. Questions has an id and answers contains a question id that
			relates to the question. 
		*/
        $sql = 'SELECT * FROM questions LEFT JOIN answers ON questions.id = answers.q_id';
		
		// Gets the table result from the above sql
        $result = mysqli_query($this->connection, $sql);
		
		// if the result contains data then continue
        if ($result)
        {
			// Give back the number of results returned
            $count = mysqli_num_rows($result);
			
			// if the count is not null/greater than 0, then continue
            if ($count)
            {
				// Instantiate the last id and question for later use in the while loop 
                $lastID = null;
                $question = null;
				
				// Loops through each row from the sql result and sets it to a variable.
                while ($row = $result->fetch_assoc())
                {
					// If the last id does not equal the answers question id ...
                    if ($lastID != $row['q_id'])
                    {
						// if the question has a value, then push it to the questions array
                        if (isset($question))
                        {
                            array_push($questions, $question);
                        }
						
						// Set the question equal to a new question class and instantiates the title of the question and sets the description text. (See Models/questionModel.php)
                        $question = new Question($row['q_title'], $row['q_text']);
						
						// Sets the last id to the current question id
                        $lastID = $row['q_id'];
                    }
                    $answer = new Answer($row['a_text'], $row['is_correct']);
                    $question->addAnswer($answer);
                }
				
				// If the question has a value still, push it to the questions array
                if (isset($question))
                {
                    array_push($questions, $question);
                }
            }
        }
		// Randomize the questions array
        shuffle($questions);
		
		// Returns an array of questions
        return $questions;
    }
}
