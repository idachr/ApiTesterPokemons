<?php
require_once "../controllers/quiz.controllers.php";

$quizController = new QuizController();

if (isset($_GET['submittet_answer'])) {
    $submittet_answer = $_GET['submittet_answer'];

    //$is_correct = $quizController->checkAnswer($submittet_answer);

    if (empty($flavors)) {
        echo json_encode(["error" => "No flavors found."]);
    } else {
        echo json_encode(["flavors" => $flavors]);
    }    

} else {
    echo "Invalid request.";
}
?>
