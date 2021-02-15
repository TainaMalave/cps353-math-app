<?php
    // include the db config and create the db connection.
    include('config.php');
    $db = new DB();

    //checking for post form action.
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = mysqli_real_escape_string($db->connection, $_POST['username']);
        $password = md5(mysqli_real_escape_string($db->connection, $_POST['password']));
        $checkSql = 'SELECT COUNT(*) AS count FROM users WHERE username = "'. $username .'"';
        $checkResult = mysqli_query($db->connection, $checkSql);
        $count = mysqli_fetch_array($checkResult);

        //checking to see if the username exists already.
        if($count[0] == 0) 
        {
            $sql = 'INSERT INTO users (username, password) VALUES ("'. $username .'", "'. $password .'")';
            $result = mysqli_query($db->connection, $sql);
            echo $db->connection->error;
        } else
        {
            echo 'Choose a new name hoe';
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
        <div class="register-form">
            <div class="username">
                <label for="username">Enter a Username</label>
                <input name="username" type="text" placeholder="enter username...">
            </div>

            <div class="password">
                <label for="password">Enter a passward</label>
                <input name="password" type="password" placeholder="enter password...">
            </div>
        </div>
        <button class="register-btn" type="submit">REGISTER</button>
    </form>
    <div class="login-page">
        <a href="login.php">Already have an account? Login!</a>        
    </div>
</div>