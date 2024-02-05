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
                <form id="quizForm">
                    <h3><?php echo $question['question']; ?></h3>

                    <?php
                    $answers = $quizView->fetchAnswers($question['id']);
                    foreach ($answers as $answer) { ?>

                        <label for="answer"><?php echo $answer['answer']; ?></label>
                        <input type="radio" name="submittet_answer" id="submittet_answer">

                    <?php } ?>
                    <button class="all-btn primary-btn" type="submit">Check answer</button>
                </form>

                <div id="answer-display">
                </div>
            </div>
        <?php } ?>
    </div>
</main>

<?php
require_once "../parts/footer.php";
?>