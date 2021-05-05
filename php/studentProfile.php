<?php
    include('Models/userModel.php');

    $currentUser = User::getCurrentUser();
    $studentInfo = User::getTeacherInfos();

    //$topTenUsers = Scoreboard::getTopTen();

    /* If the form submit button was clicked, then continue. */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        /* Gather the information needed from the submission form */
        $name = $_POST['teacherName'];
        $mailTo = $_POST['teacher-email'];
        $subject = 'SmartStudy: New Message';
        $message = 'Hello ' . $name . ', ' . $_POST['message'];
        $header = 'From: tymalave@gmail.com' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-type: text/html; charset=utf-8'; 

        /* If the fields are correct and the message sent then echo the following */
        if(mail($mailTo, $subject, $message, $header))
            echo "Email sent";
        else
            echo "Email sending failed";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="../css/teacherprofile.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
       <div class="profile-content">
        <div class="name">
            <h3>Welcome Back, <?php echo $currentUser->username ?>.</h3>
        </div>

            <div class="picture">
            <img src="../user_pics/<?php echo $currentUser->picture ?>" alt="student pic">
            </div>

            <div class="assigned-teacher">
                <h3>Your Assigned Teacher is: </h3>
                <?php foreach (User::getTeacherInfos() as $teacher): ?>
                    <h4><?php echo $teacher["username"]; ?></h4>
                <?php endforeach;?>
            </div>


            <div class="student-average">
                <h3>Your Overall Average is: </h1>
                
               <?php echo User::getStudentAverage($currentUser->id); ?>
            </div>


            <!-- Contact Form -->
            <div class="contact-form">
            <h3>Message A Teacher</h3>
            <form action="" method="POST">
                <label for="name">Teacher's Name</label>
                <input id="teacherName" type="text" name="teacherName" placeholder="Student's Name...">

                <label for="email">Teacher's Email</label>
                <select id="teacher-email" name="teacher-email">
                    <option value="">Choose Email</option>
                    <?php foreach (User::getStudentInfos() as $student): ?>
                        <option name="email" value="<?php echo $student["email"]; ?>"><?php echo $student["email"]; ?></option>
                    <?php endforeach;?>    
                </select>

                <label for="subject-label">Subject</label>
                <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>

                <input type="submit" value="Submit">
            </form>
            </div>

            <div class="buttons">
                <div class="leaderboard-btn">
                    <a href="leaderboard.php" class="leaderboardBtn">See Leaderboard</a>
                </div>

                <div class="quiz-btn">
                    <a href="game.php" class="playAgainBtn">Take Quiz</a>
                </div>
            </div>
       </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>