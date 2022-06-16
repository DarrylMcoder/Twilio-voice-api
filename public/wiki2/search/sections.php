<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_REQUEST['Caller'];
$user = new User($number);
switch($_REQUEST['Digits']){
  case '*':
    $response->redirect('input.php');
    break;
  case '#':
    $response->redirect('../welcome.php');
    break;
  default:
    $response->say('The number you entered was not valid.', [
      'voice' => $user->voice,
      'language' => $user->language
    ]);
    $response->redirect('input.php');
}
echo $response;