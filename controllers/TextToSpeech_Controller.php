<?php


class TextToSpeechController {
    public function generateAudio() {
        try {
            $audio = TextToSpeechModel::generateAudio($text);
            
            // Construire la réponse au format JSON
            $response = ['success' => true, 'audio' => 'data:audio/mpeg;base64,' . $audio];
            
            // Envoyer la réponse en tant que JSON avec l'en-tête approprié
            header('Content-Type: application/json');
            echo json_encode($response);
        } catch(Exception $e) {
            echo "Erreur :".$e->getMessage();
        }

    }
}


