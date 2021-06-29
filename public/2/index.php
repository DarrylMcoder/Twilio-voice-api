<?PHP
    
require('../../vendor/autoload.php');

use Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();

$response->say('Please record your message after the beep, then press pound to continue.');

$response->record([
  'action'      => 'sendMsg.php',
  'finishOnKey' => '#',
  'playBeep'    => true,
  'maxLength'   => 30,
  'recordingStatusCallback' => 'callback.php',
]);

echo $response;