<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_REQUEST['Caller'];
$user = new User($number);
$gather = $response->gather([
  'action' => 'text_split.php',
  'method' => 'post'
]);

if(!$user->hasAccess()){
  $gather->say('You do not currently have access to this service. Please add funds to your account to continue.', [
    'voice' => $user->voice,
    'language' => $user->language
  ]);
  $response->redirect('../welcome.php');
}else{
  $gather->say('To send a message, press 1. To check your messages, press 2.', [
    'voice' => $user->voice,
    'language' => $user->language
  ]);
}
echo $response;