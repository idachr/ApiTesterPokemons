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
$questions = $quizView->fetchQuestions(); ?>

<main>
    <div>
        <h1>Quiz</h1>
        <?php foreach ($questions as $question) { ?>
            <div class="question-box">
                <form class="quizForm" data-question-id="<?php echo $question['id']; ?>">
                    <h3><?php echo $question['question']; ?></h3>
                    <?php
                    $answers = $quizView->fetchAnswers($question['id']);
                    foreach ($answers as $answer) { ?>
                        <label for="answer"><?php echo $answer['answer']; ?></label>
                        <input type="radio" name="submittet_answer" value="<?php echo $answer['id']; ?>" data-is-correct="<?php echo $answer['is_correct']; ?>">
                    <?php } ?><br><br>

                    <span data-answer-id="<?php echo $question['id']; ?>"></span>

                    <button class="all-btn primary-btn" type="button" onclick="checkAnswer(this, <?php echo $question['id']; ?>)">Check answer</button>
                </form>

            </div>
        <?php } ?>
    </div>
</main>

<script>
    function checkAnswer(button, question_id) {
        var form = button.closest('.quizForm');
        var selectedAnswer = form.querySelector('input[name="submittet_answer"]:checked');
        var isCorrect = selectedAnswer ? selectedAnswer.dataset.isCorrect : null;

        console.log(isCorrect);

        let text = "";
        if (isCorrect == 0) {
            text = "Wrong answer!"
        } else {
            text = "Correct answer!"
        }

        document.querySelector(`[data-answer-id="${question_id}"]`).innerHTML = text;

    }
</script>