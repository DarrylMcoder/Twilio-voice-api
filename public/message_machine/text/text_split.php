<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();
$number = $_POST['Caller'];
$user = new User($number);

switch($_POST['Digits']){
  case 1:
    header('Location: number.php');
    break;
    
  case 2:
    header('Location: read_message.php');
    break;
    
  case '*':
    header('Location: ../welcome.php');
    break;
    
  case '#':
    header('Location: ../welcome.php');
    break;
    
  default:
    $response->say('The number you entered was not valid.', [
      'voice' => $user->voice,
      'language' => $user->language
    ]);
}
echo $response;