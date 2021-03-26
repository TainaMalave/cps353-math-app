<?php
include ('config.php');
session_start();
$db = new DB();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $question = mysqli_real_escape_string($db->connection, $_POST['question']);
    $q_text = mysqli_real_escape_string($db->connection, $_POST['q_text']);

    $checkSql = 'SELECT COUNT(*) AS count FROM questions WHERE q_title = "' . $question . '"';

    $checkResult = mysqli_query($db->connection, $checkSql);

    $count = mysqli_fetch_array($checkResult);

    if ($count[0] == 0)
    {
		
		// Inserts the new user with the escaped username and hashed password into the database
        $sql = 'INSERT INTO questions (q_title, q_text) VALUES ("' . $question . '", "' . $q_text . '")';
		
		// Run the above query
        $result = mysqli_query($db->connection, $sql);
		
		//If there is an error creating the account, then print out the error
		if($db->connection->error) {
			die($db->connection->error);
		}
    
    }
    else // otherwise
    {
		// Print out that the username already exists and instruct them to choose a new username
        echo 'That username already exists. Please try a different username';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Q/A Form</title>
</head>
<body>
    <form action="" method="POST">
        <div class="q-form">
            <div class="submit-question">
                <input name="question" type="text" placeholder="enter your question...">
                <input name="q_text" type="text" placeholder="what is the right answer?">
            </div>

            <div class="submit-answer-button">
                <input type="button" value="Create Input" onClick="createInput();" />
            </div>

            <div id="submit-answers">New input goes here</div>
        </div>
        <button class="submit-btn" type="submit">Submit Question</button>
    </form>

    <script type="text/javascript">
        function createInput(){
            var answerInputWrapper = document.createElement('div');
            var correctAnswer = document.createElement('div');
            answerInputWrapper.innerHTML = "<input type='text' id='newInputBox'>";
            correctAnswer.innerHTML = "<input type='radio' name='correctAnswer'>";
            document.getElementById("submit-answers").appendChild(answerInputWrapper);
            document.getElementById("submit-answers").appendChild(correctAnswer);
        }
    </script>
</body>
</html>