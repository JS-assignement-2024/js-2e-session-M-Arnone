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

    public function addScore($userId, $score,$numquest) {
        $stmt = $this->db->prepare("INSERT INTO scores (user_id, score,num_exercises) VALUES (?,?,?)");
        $stmt->bind_param("iii", $userId, $score,$numquest);
        $stmt->execute();
        $stmt->close();
    }

  

    public function getTopScores($limit = 10) {
        // Préparer la requête SQL pour calculer la moyenne des scores normalisée sur 20
        $stmt = $this->db->prepare("
            SELECT users.name,
                   -- Calculer la moyenne des scores pour chaque utilisateur
                   -- Normaliser sur une échelle de 20
                   AVG(scores.score / scores.num_exercises) * ? AS normalized_score
            FROM scores
            JOIN users ON scores.user_id = users.id
            GROUP BY users.id
            ORDER BY normalized_score DESC
            LIMIT ?
        ");
        
        // La valeur 20 pour la normalisation
        $normalizationFactor = 20;
        $stmt->bind_param("ii", $normalizationFactor, $limit);
        $stmt->execute();
        
        // Obtenir les résultats
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