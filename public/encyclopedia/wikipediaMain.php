<?PHP
    
require('../vendor/autoload.php');
use \Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();
$gather = $response->gather([
  'action' => 'wiki.php',
  'method' => 'post',
  'input'  => 'speech'
]);

$gather->say('Please tell me the word or phrase you want to find.', ['voice' => 'Polly.Matthew']);

$response->say('I\'m sorry. I didn\'t hear anything. Please try again.',['voice' => 'Polly.Matthew']);

$response->redirect('wikipediaMain.php');

echo $response;
