<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Trivia Game</title>

        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <div class="container">
            <div class="result-content">
                <div class="results-header">
                    <h1>Your Results</h1>
                </div>

                <div class="results">
                    <h2>You got this many correct and wrong:</h2>
                    <h3>Correct: <?php echo $_GET['correct'] ?> </h3>
                    <h3>Wrong: <?php echo $_GET['wrong'] ?>  </h3>
                </div>
            </div>
        </div>

    </body>
</html>
