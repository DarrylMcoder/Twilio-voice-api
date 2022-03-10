<?PHP
    
require('../vendor/autoload.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$gather = $response->gather([
  'action' => 'menu.php',
  'method' => 'post'
]);

$gather->say('Thank you for calling The Encyclopedia. To use the encyclopedia, press one, for your account, press two, and for more information on the encyclopedia service, press eight.', [
'voice' => 'Polly.Matthew'
]);

$gather->pause(['length' => 10]);

$response->redirect('wikipediaMain.php');

echo $response;