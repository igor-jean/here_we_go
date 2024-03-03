<?php

use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Protobuf\Internal\InputStream;

class TextToSpeechModel {
    public static function generateAudio($text) {
        $client = new TextToSpeechClient();
        
        $voice = (new VoiceSelectionParams())
            ->setLanguageCode('fr-FR')
            ->setName('fr-FR-Wavenet-A');
        $audioConfig = (new AudioConfig())
            ->setAudioEncoding(AudioEncoding::MP3);

        $inputText = (new SynthesisInput())->setText($text);
        $response = $client->synthesizeSpeech($inputText, $voice, $audioConfig);

        $audioContent = $response->getAudioContent();
        
        return base64_encode($audioContent);
    }
}
