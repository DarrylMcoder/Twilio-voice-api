<?PHP
    
require('../vendor/autoload.php');

$response = new Twilio\TwiML\VoiceResponse();
$gather = $response->gather([
  'action' => 'gather.php',
  'method' => 'GET'
]);
$gather->say('Welcome, you have reached a Twilio test application by Darryl Martin. If you know your destination, please dial it now, otherwise, wait for the menu.');

$gather->say('To speak directly to Darryl, press one. To send him a voice to text message, press two. For more of Darryl\'s telephone application projects, press three. Return to the previous menu at any time by pressing star. For the main menu, press pound.');