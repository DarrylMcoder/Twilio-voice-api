<?PHP
    
require('../../vendor/autoload.php');
require('User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();
$number = $_GET['Caller'];
$user = new User($number);

switch($_REQUEST['Digits']){
  case 1:
    header('Location: search/input.php');
    break;
    
  case 7: 
    header('Location: account/acount.php');
    break;
    
  case 8:
    $response->say('About', [
      'voice' => $user->voice,
      'language' => $user->language
    ]);
    break;
    
  case '*':
    header('Location: welcome.php');
    break;
        
  case '#':
    header('Location: welcome.php');
    break;
    
  default:
    $response->say('The number you entered was not valid.', [
      'voice' => $user->voice,
      'language' => $user->language
    ]);
}
echo $response;