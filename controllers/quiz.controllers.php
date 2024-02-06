<?php

class QuizController extends QuizModel {

    public function checkAnswer($questionId) {
        return $this->getCorrectAnswer($questionId);
    }
}