<?php
// include the db config and create the db connection
include ('config.php');

//create variables to track the added question and alert error
$addedQuestion = false;
$questionAlert = false;

// instantiate a new DB class
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

// Checks to see if the question form submission button was clicked, and if so, continue
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Instantiate and set the question and correct answer variable
    $question = mysqli_real_escape_string($db->connection, $_POST['question']);
    $correctAnswer = mysqli_real_escape_string($db->connection, $_POST['correct-answer']);

    // Grab the wrong answers from the form and submit the into the database.
    $wrongAnswers = array_map(function($wrongAnswer) use($db)
    {
        return mysqli_real_escape_string($db->connection, $wrongAnswer);
    }, $_POST['wrong-answer']);

    // SQL that selects the count to check if there are any questions in the table already
    $checkSql = 'SELECT COUNT(*) AS count FROM questions WHERE q_title = "' . $question . '"';

    // Run the above sql with the db connection 
    $checkResult = mysqli_query($db->connection, $checkSql);

    // Get the number from the sql result
    $count = mysqli_fetch_array($checkResult);

    // if there are no results, then the question will be added to the database table.
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
    else // if question already exists, show an alert.
    {
        $questionAlert = true;
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
                    <div class="alert-good">
                    <?php if($addedQuestion) : ?>
                        <p><span>Success!</span> Question was added to the DB.</p>
                    <?php endif; ?>
                    </div>

                    <div class="alert-bad">
                        <?php if($questionAlert) : ?>
                            <p>That question was already added to the database!</p>
                        <?php endif; ?>
                    </div>

                    <div class="form-instructions">
                        <span>Submit a question.</span>
                    </div>

                    <div class="submit-question">
                        <input name="question" type="text" placeholder="Enter your question...">
                        <br>
                        <input name="correct-answer" type="text" placeholder="What is the correct answer?">
                    </div>

                    <div class="create-answer-input">
                        <input type="button" value="Create New Answer Input" onClick="createInput();" />
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
            answerInputWrapper.innerHTML = "<input type='text' name='wrong-answer[]' placeholder='Enter a new answer'>";
            document.getElementById("submit-answers").appendChild(answerInputWrapper);
        }
    </script>
</body>
</html>