<?php
require_once "../controllers/quiz.controllers.php";

$quizController = new QuizController();

if (isset($_POST['submit_answer'])) {
    $questionId = $_POST['questionId'];
    $submittedAnswerId = $_POST['submittet_answer'];

    $correctAnswer = $quizController->checkAnswer($questionId);

    $response = [];

    if ($submittedAnswerId == $correctAnswer) {
        $response['message'] = 'Correct!';
        $response['class'] = 'correct-answer';
    } else {
        $response['message'] = 'Wrong! The correct answer is: ' . $correctAnswer;
        $response['class'] = 'wrong-answer';
    }

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
?>

