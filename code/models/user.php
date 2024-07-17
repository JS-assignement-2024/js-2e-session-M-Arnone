<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/code/';
$file =  '_db/db.php';
require_once $path.$file;

class User{
    private $db;

    public function __construct(){
        $this->db = getConnexion();

    }

    public function create($name,$score){
        $stmt = $this->db->prepare("INSERT INTO users (name,score) VALUES (?,?)");
        $stmt->bind_param("si", $name, $score);
        $stmt->execute();
        $stmt->close();
    }
    public function getAll() {
        $result = $this->db->query("SELECT * FROM users ORDER BY score DESC LIMIT 10");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>