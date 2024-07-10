<?php
require_once '../_config/config.php';
// Connexion à la base de données
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Vérification de la connexion
if ($db->connect_error) {
    die("Connexion échouée : " . $db->connect_error);
}
else{
    echo 'Connecté';
    $db->set_charset('utf8');
}
