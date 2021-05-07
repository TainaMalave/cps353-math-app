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
            <div class="title">Smart Study</div>
            <div class="timer">
                <div class="timer-text">Time Left</div>
                <div class="timer-seconds" id="timerText">60</div>
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

            <div id="next-btn-game" class="buttons">
                <button id="nextBtn"value="Next">Next Question</button>
            </div>
        </section>

    </div>
    
    <script type="text/javascript">
        var questions = <?php echo json_encode($questions); ?>;

        /* 
            Create the timer that will count down from 60 seconds
            Once the timer hits 0, submit the questions and display the results.
        */
        var seconds = 60;
        var timer = setInterval(countdown, 1000);
        function countdown() {
            seconds --;
            var timerText = document.getElementById("timerText");
            timerText.innerHTML = seconds;

            if (seconds == 0) {
                for (var i = index; i <= questions.length; i++) {
                    displayQuestion(i);
                }
            }
        }
    </script>
    <script type="text/javascript" src="../script.js"></script>
</body>
</html>
