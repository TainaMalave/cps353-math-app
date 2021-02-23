var nextBtn = document.getElementById("nextBtn");
var questionHeader = document.getElementById("question");
var answers = document.getElementById("answers");
var index = 0;
var questionsCorrect = 0;

function displayQuestion(index) {
    if (index > 0){
        var answer = document.querySelector('input[type="radio"]:checked');
        var isCorrect = answer.dataset.isCorrect == "1";

        if (isCorrect) {
            questionsCorrect++;
        }
    }
    if (index >= questions.length) {
        var url = "results.php?correct=" + questionsCorrect + "&wrong=" + (questions.length - questionsCorrect);

        window.location.href=url;
    }else {
        var question = questions[index];
        questionHeader.innerHTML = question.title;

        answers.innerHTML = "";

        for (var i = 0; i < question.answers.length; i++) {
            var answer = question.answers[i];

            var answerWrapper = document.createElement("div");
            var answerInput = document.createElement("input");
            answerInput.dataset.isCorrect = answer.is_correct;
            answerInput.type = "radio";
            answerInput.name = "answer";
            answerInput.value = answer.text;

            var answerLabel = document.createElement("label");
            answerLabel.innerHTML = answer.text;

            answerWrapper.appendChild(answerInput);
            answerWrapper.appendChild(answerLabel);
            answers.appendChild(answerWrapper);
        }
    }
    //console.log(question);
}

displayQuestion(0);

nextBtn.onclick = function () {
    index++;
    displayQuestion(index);
};
