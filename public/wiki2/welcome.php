<?PHP
    
require('../../vendor/autoload.php');
require('User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_GET['Caller'];
$user = new User($number);
$gather = $response->gather([
  'action' => 'welcome_split.php'
]);

$gather->say('Thank you for calling the Telepedia.', [
  'voice' => $user->voice,
  'language' => $user->language
]);
if($user->isNew()){
  $gather->say('The Telepedia is a telephone service designed to provide access to Wikipedia over the phone.',[
    'voice' => $user->voice,
    'language' => $user->language
  ]);
}

$gather->say('To search Wikipedia, press 1. For your account, press 7. For more information about the Telepedia, press 8. You can return to the previous menu at any time by pressing star, or return to the main menu by pressing pound.', [
  'voice' => $user->voice,
  'language' => $user->language
]);

echo $response;