<?php
include('php/config.php');
$db = new DB();
$questions = $db->getQuestions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia Game</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="game-content">
            <div class="question">
                <h2 id="question">Who was the president that gave the "I had a dream speach"?</h2>
            </div>
            <div id="answers">
                <div>
                    <input type="radio" id="correct" name="president" value="Martin Luther King JR">
                    <label for="male">Martin Luther King JR</label>
                </div>
                <div>
                    <input type="radio" id="" name="president" value="Trump">
                    <label for="male">Trump</label>
                </div>
                <div>
                    <input type="radio" id="" name="president" value="George Washington">
                    <label for="male">George Washington</label>
                </div>
                <div>
                    <input type="radio" id="" name="president" value="Bill Clinton">
                    <label for="male">Bill Clinton</label>
                </div>
            </div>
            <div class="nextBtn">
                <button id="nextBtn"value="Next">Next</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var questions = <?php echo json_encode($questions); ?>;
    </script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
