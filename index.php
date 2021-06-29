<?PHP
    
require('../vendor/autoload.php');

use Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();
$gather = $response->gather([
  'action' => 'gather.php',
  'method' => 'POST'
]);
$gather->say('Welcome, you have reached a Twilio voice application by Darryl Martin. If you know your destination, please dial it now, otherwise, wait for the menu.');

$gather->pause(['length' => 2]);

$gather->say('Main Menu: To speak directly to Darryl, press one. To send him a voice to text message, press two. For more of Darryl\'s telephone application projects, press three. Return to the previous menu at any time by pressing star. For the main menu, press pound.');

$gather->pause(['length' => 10]);

$response->say('I did not receive a response. Please try again.');

$response->redirect('index.php');

echo $response;