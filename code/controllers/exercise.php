<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/code/';
require_once $path . 'models/exercise.php';

class ExerciseController {
    private $exercise;

    public function __construct() {
        $this->exercise = new Exercise();
    }

    public function generateExercises($operation, $count) {
        return $this->exercise->generate($operation, $count);
    }

    public function checkAnswers($userName, $userAnswers) {
        $correctAnswers = [];
        foreach ($userAnswers as $answer) {
            $correctAnswers[] = $this->exercise->checkAnswer($userName, $answer);
        }
        return $correctAnswers;
    }
}
?>