<?PHP
    
require('../vendor/autoload.php');
use \Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();
$gather = $response->gather([
  'action' => 'search.php',
  'method' => 'post',
  'input'  => 'speech'
]);

$gather->say('Please tell me the word or phrase you want to find.');

$response->say('I\'m sorry. I didn\'t hear anything. Please try again.');

$response->redirect('wikipediaMain.php');

echo $response;
