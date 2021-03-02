// Get the next button by the id defined in html
var nextBtn = document.getElementById("nextBtn");

// Get the question header by the id defined in html
var questionHeader = document.getElementById("question");

// Get the answer div container by the id defined in html
var answers = document.getElementById("answers");

// Instantiate a index variable to increment the current question
var index = 0;

// Instantiate a variable for the number of questions correct
var questionsCorrect = 0;

// This function displays a question in a specific index in the questions array (See line 9 in game.php)
function displayQuestion(index) {
	
	// If we are past the first question, continue
    if (index > 0){
		// Get the html element with a query selector of input with a type of radio which is also checked
        var answer = document.querySelector('input[type="radio"]:checked');
		
		// Assign a true or false if the isCorrect value is set on the checkbox answer input
        var isCorrect = answer.dataset.isCorrect == "1";

		// If the question was answered correctly, increment the number of questions correct
        if (isCorrect) {
            questionsCorrect++;
        }
    }
	
	// If we are at the end of the all the questions, continue
    if (index >= questions.length) {
		/* 
			Set the url to the results page with GET parameters to tell the page how many questions were
			correct and how many were wrong (sends only numbers)
		*/
        var url = "results.php?correct=" + questionsCorrect + "&wrong=" + (questions.length - questionsCorrect);

		// Redirect the user to the above url
        window.location.href=url;
    }else { // Otherwise
		// Get the question at the specified index and assign it to a variable
        var question = questions[index];
		
		// Set the question header text to the current question title
        questionHeader.innerHTML = question.title;

		// Empty out the previous answer html
        answers.innerHTML = "";

		// Loop though each of the new questions answers
        for (var i = 0; i < question.answers.length; i++) {
			
			// Get the answer at the loop index from the questions answer array
            var answer = question.answers[i];

			// Create a new empty div for the answer
            var answerWrapper = document.createElement("div");
			
			// Create a new empty input
            var answerInput = document.createElement("input");
			
			// Set the answer's isCorrect value to the value from the array
            answerInput.dataset.isCorrect = answer.is_correct;
			
			// Set the input type to Radio
            answerInput.type = "radio";
			
			// Set the input name to answer
            answerInput.name = "answer";
			
			// Set the inputs value to the answer text
            answerInput.value = answer.text;

			// Create a label for the answer div and input
            var answerLabel = document.createElement("label");
			
			// Set the answer labels text to the answer text
            answerLabel.innerHTML = answer.text;

			// Add the answer input to the answer div
            answerWrapper.appendChild(answerInput);
			
			// Add the label to the answer div
            answerWrapper.appendChild(answerLabel);
			
			// Add the answer div to the answers div (Line 28 in game.php)
            answers.appendChild(answerWrapper);
        }
    }
}

// Display the first question from the questions array
displayQuestion(0);


// When you click the next button on the game.php page, increase the index and display the next question
nextBtn.onclick = function () {
    index++;
    displayQuestion(index);
};
