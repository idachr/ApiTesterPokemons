<?php
session_start();
require_once "../parts/header.php";

include "../../classes/dbh.classes.php";
include "../../models/quiz.models.php";

class QuizView extends QuizModel
{

    public function fetchQuestions()
    {
        return $this->getQuestions();
    }

    public function fetchAnswers($questionId)
    {
        return $this->getAnswers($questionId);
    }
}

$quizView = new QuizView();
$questions = $quizView->fetchQuestions();

?>

<main>
    <div>
        <h1>Quiz</h1>
        <?php
        foreach ($questions as $question) { ?>
            <div class="question-box">
                <form class="quizForm" data-question-id="<?php echo $question['id']; ?>">
                    <h3><?php echo $question['question']; ?></h3>

                    <?php
                    $answers = $quizView->fetchAnswers($question['id']);
                    foreach ($answers as $answer) { ?>
                        <label for="answer"><?php echo $answer['answer']; ?></label>
                        <input type="radio" name="submittet_answer" value="<?php echo $answer['id']; ?>">
                    <?php } ?>
                    <button class="all-btn primary-btn" type="submit">Check answer</button>
                </form>
                <span class="correct-answer-message" style="display: none;">The correct answer is: <?php echo $question['correct_answer']; ?></span>
            </div>
        <?php } ?>
    </div>
</main>

<?php
require_once "../parts/footer.php";
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var quizForms = document.querySelectorAll('.quizForm');

        quizForms.forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                displayResults(this);
            });
        });

        function displayResults(form) {
            var questionId = form.getAttribute('data-question-id');
            var submittedAnswer = form.querySelector('input[name="submittet_answer"]:checked').value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);

                    var answerDisplay = document.getElementById('answer-display');
                    var resultMessage = document.createElement('div');
                    resultMessage.textContent = response.message;
                    resultMessage.classList.add(response.class);

                    answerDisplay.innerHTML = '';
                    answerDisplay.appendChild(resultMessage);
                }
            };

            xhr.open('POST', 'http://localhost/ApiPokemon/includes/quiz.inc.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('submit_answer=1&questionId=' + questionId + '&submittet_answer=' + submittedAnswer);
        }
    });
</script>
