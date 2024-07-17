<?php
header('Content-Type: application/json');
$path = $_SERVER['DOCUMENT_ROOT'].'/code/';
$file =  'controllers/user.php';
require_once $path.$file;
// Indiquer au navigateur que la réponse est de type JSON
$method = $_SERVER['REQUEST_METHOD'];
$user = new UserController();
if ($method == 'POST') {
    $data = json_decode(file_get_contents('php://input'),true);
    if(isset($data['name']) && !empty($data['name'])) {
    $name = $data['name'];
    $score = isset($data['score']) ? $data['score'] : 0;
    $user->createUser($name,$score);

    $response = [
        'status' => 'success',
        'message' => 'Utilisateur inscrit'
    ];
    echo json_encode($response);
    exit;
    }
    else{
        // Optionnel : définir le code de réponse HTTP approprié pour une erreur
        // Par exemple, 400 pour une requête incorrecte
        http_response_code(400);
    
        // Préparer un message d'erreur
        $response = [
            'status' => 'error',
            'message' => 'Erreur concernant le nom d\'utilisateur'
        ];
        echo json_encode($response);
        exit;
    }
}
else{
    http_response_code(405);
    $response = [
        'status' => 'error',
        'message' => 'Invalid request method'
    ];
    echo json_encode($response);
    exit;
}
// Convertir le tableau associatif en JSON et l'envoyer
?>
