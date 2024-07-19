<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/code/';
$file =  '_config/config.php';
require_once $path.$file;
class Database {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->db->connect_error) {
            die("Connexion échouée : " . $this->db->connect_error);
        }
    }

    public function getConnexion() {
        return $this->db;
    }

    public function __destruct() {
        if ($this->db) {
            $this->db->close();
        }
    }
}
