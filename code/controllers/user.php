<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/code/';
$file =  'models/user.php';
require_once $path.$file;


class UserController{
    private $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function createUser($name,$score){
        $this->user->create($name,$score);
    }

    public function getAllUsers(){
        return $this->user->getAll();
    }
    public function getUserByName($name){
        return $this->user->getUserByName($name);
    }

}