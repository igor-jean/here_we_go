<?php
require_once '../vendor/autoload.php';

// Inclure le modèle pour générer l'audio
require_once 'TextToSpeechModel.php';

// Récupérer le texte envoyé depuis la requête POST
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Vérifier si le texte a été correctement reçu
if(isset($input['texte'])) {
    // Générer l'audio
    $audio = TextToSpeechModel::generateAudio($input['texte']);

    // Construire la réponse au format JSON
    $response = ['success' => true, 'audio' => 'data:audio/mpeg;base64,' . $audio];
} else {
    $response = ['success' => false, 'error' => 'Le texte n\'a pas été correctement reçu.'];
}

// Envoyer la réponse en tant que JSON avec l'en-tête approprié
header('Content-Type: application/json');
echo json_encode($response);
?>
