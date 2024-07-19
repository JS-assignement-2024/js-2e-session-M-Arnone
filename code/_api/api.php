<?php
header('Content-Type: application/json');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT'].'/code/';
require_once $path . 'controllers/user.php';
// Indiquer au navigateur que la réponse est de type JSON
$method = $_SERVER['REQUEST_METHOD'];

$database = new Database();
$user = new User($database);
$userController = new UserController($user);

if ($method == 'POST') {
    $data = json_decode(file_get_contents('php://input'),true);
    if(isset($data['type'])){
        $type = $data['type'];
        
        switch($type){
            case 'inscription':
                if(isset($data['name']) && !empty($data['name'])) {
                    $name = $data['name'];
                    $existingUser = $userController->getUserByName($name);
                    if ($existingUser) {
                        $response = [
                            'status' => 'success',
                            'message' => 'Utilisateur déjà inscrit',
                            'user' => $name
                        ];
                    } else {
                        $userController->createUser($name);
                        $response = [
                            'status' => 'success',
                            'message' => 'Utilisateur inscrit',
                            'user' => $name
                        ];
                    }
                }
                else {
                        http_response_code(400);
                        $response = [
                            'status' => 'error',
                            'message' => 'Erreur concernant le nom d\'utilisateur'
                        ];
                } 
            break;
            
            case 'savescore':
                if (isset($data['name']) && isset($data['score'])) {
                    $name = $data['name'];
                    $score = $data['score'];
                    $userController->addScore($name,$score);
                    $response = [
                        'status' => 'success',
                        'message' => 'Score sauvegardé',
                    ];
                } else {
                    http_response_code(400);
                    $response = [
                        'status' => 'error',
                        'message' => 'Données manquantes pour save score'
                    ];
                }
            break; 
            default:
            
            http_response_code(400);
                $response = [
                    'status' => 'error',
                    'message' => 'Type de requête invalide'
                ];
            break;

        }
    }
    else {
        http_response_code(400);
        $response = [
            'status' => 'error',
            'message' => 'Type de requête manquant'
        ];
    }
}
else{
    http_response_code(405);
    $response = [
        'status' => 'Erreur',
        'message' => 'Méthode invalide !=POST'
    ];
}
echo json_encode($response);
exit;
?>
