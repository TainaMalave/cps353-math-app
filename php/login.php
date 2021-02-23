<?php
include ('config.php');
session_start();
$test = new DB();
echo "<pre>";
print_r($test->getQuestions());
echo "</pre>";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = mysqli_real_escape_string($test->connection, $_POST['username']);
    $password = md5(mysqli_real_escape_string($test->connection, $_POST['password']));

    $sql = 'SELECT id FROM users WHERE username = "' . $username . '" AND password = "' . $password . '"';
    $result = mysqli_query($test->connection, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1)
    {
        $_SESSION['login_user'] = $username;
        header('location: game.php');
    }
}
?>

<div class="container">
    <div class="title">
        <h1>Trivia Game</h1>
    </div>

    <div class="sub-title">
        <h3>Can you beat the clock?</h3>
    </div>

    <form action="" method="POST">
        <div class="login-form">
            <div class="username">
                <input name="username" type="text" placeholder="enter username...">
            </div>

            <div class="password">
                <input name="password" type="password" placeholder="enter password...">
            </div>

            <div class="reset-password">
                <a href="#">Forgot Your Password?</a>
            </div>
        </div>
        <button class="login-btn" type="submit">LOGIN</button>
    </form>
    <div class="create-account">
        <a href="register.php">Don't have an account? Sign up!</a>
    </div>
</div>
