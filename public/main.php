<?PHP
    
require('../vendor/autoload.php');
use \Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();
$gather = $response->gather([
  'action' => 'search.php',
  'method' => 'post',
  'input'  => 'speech'
]);

$gather->say('What subject do you want information on today? Please pronounce your search words clearly, but normally, so that I can understand.');

$response->say('You don\'t seem to have said anything. Please try again.');

$response->redirect('main.php');

echo $response;
