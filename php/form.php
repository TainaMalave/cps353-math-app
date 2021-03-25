<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Q/A Form</title>
</head>
<body>
    <form action="" method="POST">
        <div class="q-form">
            <div class="submit-question">
                <input name="question" type="text" placeholder="enter your question...">
            </div>

            <div class="submit-answer-button">
                <input type="button" value="Create Input" onClick="createInput();" />
            </div>

            <div id="submit-answers">New input goes here</div>
    </form>
    <script type="text/javascript">
        function createInput(){
            var answerInputWrapper = document.createElement('div');
            var correctAnswer = document.createElement('div');
            answerInputWrapper.innerHTML = "<input type='text' id='newInputBox'>";
            correctAnswer.innerHTML = "<input type='radio' name='correctAnswer'>";
            document.getElementById("submit-answers").appendChild(answerInputWrapper);
            document.getElementById("submit-answers").appendChild(correctAnswer);
        }
    </script>
</body>
</html>