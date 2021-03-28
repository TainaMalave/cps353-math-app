<?php
include ('config.php');

$addedQuestion = false;

$db = new DB();

function runQuery($db, $sql) {
    $result = mysqli_query($db->connection, $sql);
		
    //If there is an error creating the account, then print out the error
    if($db->connection->error) {
        die($db->connection->error);
    }
}

function insertQuery($db, $sql){
    runQuery($db, $sql);
    return $db->connection->insert_id;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $question = mysqli_real_escape_string($db->connection, $_POST['question']);
    $correctAnswer = mysqli_real_escape_string($db->connection, $_POST['correct-answer']);

    $wrongAnswers = array_map(function($wrongAnswer) use($db)
    {
        return mysqli_real_escape_string($db->connection, $wrongAnswer);
    }, $_POST['wrong-answer']);

    $checkSql = 'SELECT COUNT(*) AS count FROM questions WHERE q_title = "' . $question . '"';

    $checkResult = mysqli_query($db->connection, $checkSql);

    $count = mysqli_fetch_array($checkResult);

    if ($count[0] == 0)
    {
		$addedQuestion = true;
        // Grabbing the last ID
        $questionID = insertQuery($db, 'INSERT INTO questions (q_title) VALUES ("' . $question . '")');

        runQuery($db, 'INSERT INTO answers (q_id, a_text, is_correct) VALUES (' . $questionID . ', "' . $correctAnswer .'", 1)');

        foreach ($wrongAnswers as $wrongAnswer) {

           runQuery($db, 'INSERT INTO answers (q_id, a_text, is_correct) VALUES (' . $questionID . ', "' . $wrongAnswer .'", 0)');
        }

    }
    else // otherwise
    {
		// Print out that the username already exists and instruct them to choose a new username
        echo 'That question has already been added to the database.';
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

    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Whole Wrapper -->
    <div class="info-box">
        <div class="info-title">
            <span>Smart Study</span>
        </div>

        <!-- Submit a question form -->
        <div class="form-container">
            <form action="" method="POST">
                <div class="qa-form-info">
                    <!-- Question was submitted confirmation -->
                    <?php if($addedQuestion) : ?>
                        <p>Question was added to the DB.</p>
                    <?php endif; ?>

                    <div class="form-instructions">
                        <span>Submit a question.</span>
                    </div>

                    <div class="submit-question">
                        <input name="question" type="text" placeholder="enter your question...">
                        <br>
                        <input name="correct-answer" type="text" placeholder="what is the correct answer">
                    </div>

                    <div class="create-answer-input">
                        <input type="button" value="Create Input" onClick="createInput();" />
                    </div>
                    
                    <!-- Div where new answer inputs go -->
                    <div id="submit-answers"></div>
                    
                </div>
                <button class="submit-qa-btn" type="submit">Submit Question</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function createInput(){
            var answerInputWrapper = document.createElement('div');
            answerInputWrapper.innerHTML = "<input type='text' name='wrong-answer[]' placeholder='enter a new answer'>";
            document.getElementById("submit-answers").appendChild(answerInputWrapper);
        }
    </script>
</body>
</html>