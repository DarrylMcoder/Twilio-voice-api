<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_POST['Caller'];
$user = new User($number);
$gather = $response->gather([
  'action' => 'message.php'
  'method' => 'post'
]);

$gather->say('Please dial the number you wish to text. ', [
  'voice' => $user->voice;
  'language' => $user->language
]);
echo $response;