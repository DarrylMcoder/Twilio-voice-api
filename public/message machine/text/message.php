<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();
$number = $_POST['Caller'];
$user = new User($number);
$number = $_POST['Digits'];

$response->say('Please record your message then press pound to continue.',[
  'voice' => $user->voice,
  'language' => $user->language
]);
$gather = $response->gather([
  'action' => "confirm_send.php?number=$number",
  'method' => 'post',
  'input'  => 'speech'
]);