<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/code/';
require_once $path . '_db/db.php';

class Exercise {
    private $db;

    public function __construct() {
        $this->db = getConnexion();
    }

    public function generate($operation, $count) {
        $exercises = [];
        for ($i = 0; $i < $count; $i++) {
            $num1 = rand(1, 10);
            $num2 = rand(1, 10);
            $question = "";
            $correct_answer = "";
            $missing_part = rand(1, 3); 

            switch ($operation) {
                case 'addition':
                    $result = $num1 + $num2;
                    break;
                case 'subtraction':
                    $result = $num1 - $num2;
                    break;
                case 'multiplication':
                    $result = $num1 * $num2;
                    break;
                case 'division':
                    $num1 = $num2 * rand(1, 10);
                    $result = $num1 / $num2;
                    break;
                default:
                    throw new Exception("Opération non valide.");
            }

            switch ($missing_part) {
                case 1:
                    $question = "? " . $this->getSymbol($operation) . " $num2 = $result";
                    $correct_answer = $num1;
                    break;
                case 2:
                    $question = "$num1 " . $this->getSymbol($operation) . " ? = $result";
                    $correct_answer = $num2;
                    break;
                case 3:
                    $question = "$num1 " . $this->getSymbol($operation) . " $num2 = ?";
                    $correct_answer = $result;
                    break;
            }

            $exercises[] = [
                'question' => $question,
                'correct_answer' => $correct_answer
            ];
        }
        return $exercises;
    }

    private function getSymbol($operation) {
        switch ($operation) {
            case 'addition':
                return '+';
            case 'subtraction':
                return '-';
            case 'multiplication':
                return '*';
            case 'division':
                return '/';
            default:
                return '';
        }
    }

    public function checkAnswer($userName, $userAnswer) {
        $stmt = $this->db->prepare("SELECT correct_answer FROM exercises WHERE name = ? AND question = ?");
        $stmt->bind_param("ss", $userName, $userAnswer['question']);
        $stmt->execute();
        $stmt->bind_result($correctAnswer);
        $stmt->fetch();
        $stmt->close();
        return $correctAnswer == $userAnswer['answer'];
    }
}
?>