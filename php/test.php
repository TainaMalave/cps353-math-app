<?php
include ('Models/scoreboardModel.php');

$user = User::getCurrentUser();

$user->addScore(rand(0,12), rand(0,12));

$scoreboards = Scoreboard::getTopTen();

var_dump($scoreboards);