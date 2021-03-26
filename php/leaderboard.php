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
</head>
<body>

    <?php foreach($topTenUsers as $topTenUser) : ?>
        <div>
            <?php echo $topTenUser->getName() ?>
            <?php echo $topTenUser->getScore() ?>
        </div>
    <?php endforeach; ?>
    
</body>
</html>