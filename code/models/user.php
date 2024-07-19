<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/code/';
$file =  '_db/db.php';
require_once $path.$file;

class User{
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnexion();
    }

    public function create($name) {
        $stmt = $this->db->prepare("INSERT INTO users (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->close();
    }

    public function addScore($userId, $score) {
        $stmt = $this->db->prepare("INSERT INTO scores (user_id, score) VALUES (?, ?)");
        $stmt->bind_param("ii", $userId, $score);
        $stmt->execute();
        $stmt->close();
    }

    public function getTopScores($limit = 10) {
        $stmt = $this->db->prepare("
            SELECT users.name, MAX(scores.score) as score
            FROM scores
            JOIN users ON scores.user_id = users.id
            GROUP BY users.id
            ORDER BY score DESC
            LIMIT ?
        ");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $scores = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $scores;
    }

    // Méthode pour récupérer un utilisateur par son nom
    public function getUserByName($name) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }
}

?>