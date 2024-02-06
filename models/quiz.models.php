<?php

class QuizModel extends Dbh {
    protected function getQuestions() {
        $stmt = parent::connect()->prepare('SELECT * FROM quiz_questions;');
    
        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../views/private/quiz.views.php?error=stmtfailed");
            exit();
        }
    
        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header("Location: ../views/private/quiz.views.php?error=questionnotfound");
            exit();
        }
    
        $faqData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    
        return $faqData;
    }

    protected function getAnswers($questionId) {
        $stmt = parent::connect()->prepare('SELECT * FROM quiz_answers WHERE question_id = ?;');
    
        if (!$stmt->execute(array($questionId))) {
            $stmt = null;
            header("Location: ../views/private/quiz.views.php?error=stmtfailed");
            exit();
        }
    
        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header("Location: ../views/private/quiz.views.php?error=answernotfound");
            exit();
        }
    
        $answerData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    
        return $answerData;
    }

    protected function getCorrectAnswer($questionId) {
        $stmt = parent::connect()->prepare('SELECT answer FROM quiz_answers WHERE question_id = ? AND is_correct = 1;');

        if (!$stmt->execute(array($questionId))) {
            $stmt = null;
            header("Location: ../views/private/quiz.views.php?error=stmtfailed");
            exit();
        }

        $correctAnswer = $stmt->fetch(PDO::FETCH_ASSOC)['answer'];

        $stmt = null;

        return $correctAnswer;
    }
}