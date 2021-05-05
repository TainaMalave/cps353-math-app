<?php
    include('Models/scoreboardModel.php');

    $topTenUsers = Scoreboard::getTopTen();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard!</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/leaderboard.css">
</head>
<body>

<div class="wrapper">
    <div class="leaderboard-content">
        <div class="title">
            <h1>Top Ten Students</h1>
        </div>
        <div class="leaderboard-table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($topTenUsers as $topTenUser) : ?>
                        <tr>
                        <td><?php echo $topTenUser->getName() ?></td>
                        <td><?php echo $topTenUser->getScore() ?></td>
                        </tr>
                    <?php endforeach; ?>                            
                </tbody>
            </table>
        </div>

        <div class="studentProfile-btn">
            <a href="studentProfile.php" class="studentProfileBtn">Return to Profile</a>
        </div>
    </div>
</div>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>