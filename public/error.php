<?PHP
    
require('../vendor/autoload.php');

use Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();

$response->say('I\'m sorry, I did not recognize your response. Please enter valid input.');

$response->redirect('index.php');