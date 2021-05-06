<?php
include('Models/userModel.php');
$user = User::getCurrentUser();
$user->addScore($_GET['correct'], $_GET['wrong']);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Trivia Game</title>

        <link rel="stylesheet" href="../css/results.css">
    </head>
    <body>
        <div class="container">
            <div class="result-content">
                <div class="results-header">
                    <h1>Your Results...</h1>
                </div>

                <div class="results">
                    <h2>You got this many correct and wrong:</h2>
                    <h3>Correct: <?php echo $_GET['correct'] /* Prints out the amount of correct answers */ ?> </h3>
                    <h3>Wrong: <?php echo $_GET['wrong'] /* Prints out the amount of wrong answers */ ?>  </h3>
                </div>

                <div class="buttons"> 
                        <a href="leaderboard.php" class="leaderboardBtn">See Leaderboard</a>
                        <a href="studentProfile.php" class="studentProfileBtn">Back to Profile</a>

                </div>
            </div>
        </div>

    </body>
</html>
