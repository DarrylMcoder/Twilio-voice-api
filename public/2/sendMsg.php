<?PHP
    
require('../../vendor/autoload.php');
require('../libs/textlocal.class.php');

use Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();

$response->say('Your message has been successfully sent.');

$response->redirect('../index.php');

echo $response;
