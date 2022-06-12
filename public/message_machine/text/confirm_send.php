<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();
$number = $_POST['Caller'];
$user = new User($number);
$number = $_POST['Digits'];
$message = $_POST['SpeechResult'];

$response->say("Your message to $number says: $message. Are you ready to send it? To send press 1. To rerecord your message press 2. To change the destination phone number press 3.",[
  'voice' => $user->voice
  'language' => $user->language
]);
$gather = $response->gather([
  'action' => "send.php?number=$number&message=$message",
  'method' => 'post'
]);