<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_REQUEST['Caller'];
$user = new User($number);

$response->say("Please record the word or phrase you want to know more about.",[
  'voice' => $user->voice,
  'language' => $user->language
]);

$gather = $response->gather([
  'action' => 'search.php',
  'input'  => 'speech'
]);

$response->say('Sorry, I didn\'t get that.',[
  'voice' => $user->voice,
  'language' => $user->language
]);
echo $response;