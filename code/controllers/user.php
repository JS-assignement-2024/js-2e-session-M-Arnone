<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/code/';
$file =  'models/user.php';
require_once $path.$file;


class UserController{
    private $user;
    public function __construct(User $us){
        $this->user = $us;
    }

    public function createUser($name, $score = 0) {
        $this->user->create($name);
        $user = $this->user->getUserByName($name);
        if ($user) {
            $userId = $user['id'];
            $this->user->addScore($userId, $score);
        } else {
            error_log('Utilisateur non trouvé après création');
        }
    }
    public function getUserByName($name) {
        return $this->user->getUserByName($name);
    }
    public function addScore($name,$score){
         $user = $this->user->getUserByName($name);
        if ($user) {
            $userId = $user['id'];
            $this->user->addScore($userId, $score);
        } else {
            error_log('Utilisateur non trouvé pour l\'ajout du score');
        }
    }
}