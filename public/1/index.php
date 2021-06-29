<?PHP

$from = $_POST['from'];
    
require('../../vendor/autoload.php');

use Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();

$response->say('You are being transfered to Darryl Martin\'s personal number. Please wait.');

$response->dial('+15195899829',[
  'callId' => $from,
]);

$response->hangup();

echo $response;