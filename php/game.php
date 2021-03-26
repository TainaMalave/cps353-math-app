<?php
// include the db config and create the db connection.
include('config.php');

// Runs a sql query to get all questions with their respective answers (See config.php)
$db = DB::getDB();
$questions = $db->getQuestions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia Game</title>

    <!-- FontAweome CDN Link for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="quiz-box">
        <header>
            <div class="title">Trivia Game</div>
            <div class="timer">
                <div class="timer-text">Time Left:</div>
                <div class="timer-seconds">30</div>
            </div>
        </header>

        <section>
            <div class="question">
                <span id="question"></span>
            </div>

            <div class="answer-list">
                <div id="answers">
                    
                </div>
                
            </div>
        </section>

        <footer>
            <button id="nextBtn"value="Next">Next</button>
        </footer>
    </div>
    
    <script type="text/javascript">
        var questions = <?php echo json_encode($questions); ?>;
    </script>
    <script type="text/javascript" src="../script.js"></script>
</body>
</html>
