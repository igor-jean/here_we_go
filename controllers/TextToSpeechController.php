<?php


use Models\TextToSpeechModel;

class TextToSpeechController {
    public function generateAudio($text) {
        $audio = TextToSpeechModel::generateAudio($text);
        // Vous pouvez ici retourner l'audio à une vue ou à un autre contrôleur selon vos besoins
        return $audio;
    }
}
