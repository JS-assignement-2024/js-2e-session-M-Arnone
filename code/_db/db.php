<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/code/';
$file =  '_config/config.php';
require_once $path.$file;
// Connexion à la base de données
function getConnexion(){
    $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // Vérification de la connexion
    if ($db->connect_error) 
            die("Connexion échouée : " . $db->connect_error);
    return $db;
}
