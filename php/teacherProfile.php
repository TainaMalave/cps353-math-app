<?php
    include('Models/userModel.php');

    $currentUser = User::getCurrentUser();
    $studentCount = User::getStudentCount();
    $studentInfo = User::getStudentInfos();

    /* If the form submit button was clicked, then continue. */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        /* Gather the information needed from the submission form */
        $name = $_POST['studentName'];
        $mailTo = $_POST['student-email'];
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
    <title>Teacher Profile</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
       <div class="profile-content">
        <div class="name">
            <h3>Welcome Back, <?php echo $currentUser->username ?>.</h3>
        </div>

            <div class="picture">
            <img src="../user_pics/<?php echo $currentUser->picture ?>" alt="teacher pic">
            </div>

            <div class="student-count">
                <h3>The Number of Students Enrolled: </h3>
                <h4><?php echo $studentCount ?></h4>
            </div>

            <div class="class-average">
                <h3>The Class Average is: </h1>
                <h4><?php echo User::getClassAverage() ?></h4>
            </div>

            <div class="average-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">ID #</th>
                        <th scope="col">Username</th>
                        <th scope="col">Average Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (User::getStudentAverages() as $student): ?>
                        <tr>
                            <th scope="row"><?php echo $student["id"]; ?></th>
                            <td><?php echo $student["username"]; ?></td>
                            <td><?php echo $student["student_avg"]; ?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    </table>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">
            <h3>Message A Student</h3>
            <form action="" method="POST">
                <label for="name">Student's Name</label>
                <input id="studentName" type="text" name="studentName" placeholder="Student's Name...">

                <label for="email">Student's Email</label>
                <select id="student-email" name="student-email">
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

            <div class="formBtnDiv">
                <a href="form.php" class="formBtn">Add Questions</a>
            </div>
       </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>