<?php
include ('models/questionModel.php');

class DB
{
    protected $host = 'localhost';
    protected $dbname = 'trivia-game';
    protected $username = 'root';
    protected $password = '';
    public $connection;

    public function __construct()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
    }

    public function getQuestions()
    {
        $questions = [];
        $sql = 'SELECT * FROM questions LEFT JOIN answers ON questions.id = answers.q_id';
        $result = mysqli_query($this->connection, $sql);
        if ($result)
        {
            $count = mysqli_num_rows($result);
            if ($count)
            {
                $lastID = null;
                $question = null;
                while ($row = $result->fetch_assoc())
                {
                    if ($lastID != $row['q_id'])
                    {
                        if (isset($question))
                        {
                            array_push($questions, $question);
                        }
                        $question = new Question($row['q_title'], $row['q_text']);
                        $lastID = $row['q_id'];
                    }
                    $answer = new Answer($row['a_text'], $row['is_correct']);
                    $question->addAnswer($answer);
                }
                if (isset($question))
                {
                    array_push($questions, $question);
                }
            }
        }
        shuffle($questions);
        return $questions;
    }
}
