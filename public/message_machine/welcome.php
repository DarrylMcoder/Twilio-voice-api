<?PHP
    
require('../../vendor/autoload.php');
require('User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_POST['Caller'];
$user = new User($number);
$gather = $response->gather([
  'action' => 'welcome_split.php'
]);

$gather->say('Thank you for calling your Email Machine.', [
  'voice' => $user->voice,
  'language' => $user->language
]);
if($user->isNew()){
  $gather->say('Have you ever wished you could send text, email, or WhatsApp messages on your home phone? The Email Machine is a telephone service designed to make this possible.',[
    'voice' => $user->voice,
    'language' => $user->language
  ]);
}

$gather->say('For text messaging, press 1. For email, press 2. For WhatsApp, press 3. For your account, press 7. For more information about the Email Machine, press 8. You can return to the previous menu at any time by pressing star, or return to the main menu by pressing pound.', [
  'voice' => $user->voice,
  'language' => $user->language
]);

echo $response;