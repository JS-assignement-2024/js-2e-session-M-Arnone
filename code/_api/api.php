<?php

// Introduire une temporisation de 5 secondes
$sleep = $_GET['sleep'] ?? 0;
sleep($sleep);

// Indiquer au navigateur que la réponse est de type JSON
header('Content-Type: application/json');

if (isset($_GET['error'])) {
    
    // Optionnel : définir le code de réponse HTTP approprié pour une erreur
    // Par exemple, 400 pour une requête incorrecte
    http_response_code(400);
    
    // Préparer un message d'erreur
    $response = [
        'status' => "error",
        'message' => "Une erreur a été demandée après $sleep secondes."
    ];

    // Envoyer la réponse JSON
    echo json_encode($response);
    
    // Arrêter l'exécution du script pour ne pas poursuivre avec d'autres traitements
    exit;
}

// Créer un tableau associatif pour la réponse JSON
$response = [
    'status' => "success",
    'message' => "Voici une réponse avec une temporisation de $sleep secondes."
];

// Convertir le tableau associatif en JSON et l'envoyer
echo json_encode($response);

?>
